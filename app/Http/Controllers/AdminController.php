<?php

namespace App\Controllers\Admin;

use App\Libraries\Options;
use CodeIgniter\Files\File;
use App\Models\BookingsModel;
use App\Libraries\CustomEmail;
use App\Libraries\Permissions;
use App\Models\Admin\AdminModel;
use App\Models\Admin\SettingModel;
use App\Controllers\BaseController;
use App\Models\Admin\AdminRoleModel;
use App\Models\Admin\AdminPermissionModel;
use App\Models\Admin\AdminRolePermissionModel;
use App\Libraries\Template; // Loading Template Library

class AdminController extends BaseController
{
    protected $permission;

    public function __construct()
    {

        if (!extension_loaded('gd')) {
            die('Please install gd extension for PHP');
        }

        helper('text');
        helper('common');
        helper('date');

        $this->permission = new Permissions(); // Loading Permissions Library
        $this->permission->load_permissions(); // Loading Permissions
    }

    public function index()
    {
        return redirect()->to(route_to('admin_login'));
    }

    public function dashboard()
    {
        $data['permission'] = $this->permission;
        $data['title'] = "Dashboard";

        $data['total_admins'] = (new AdminModel())->countAll();
        $data['total_bookings'] = (new BookingsModel())->countAll();
        $data['total_pending_bookings'] = (new BookingsModel())->where('status', 'pending')->countAll();
        $data['total_completed_bookings'] = (new BookingsModel())->where('status', 'completed')->countAll();
        $data['total_payment'] = (new BookingsModel())->selectSum('price', 'total')->where('status', 'completed')->get()->getRow()->total;
        $data['total_pending_payment'] = (new BookingsModel())->selectSum('price', 'total')->where('status', 'pending')->get()->getRow()->total;
        $data['total_refund'] = (new BookingsModel())->selectSum('price', 'refund')->where('status', 'completed')->get()->getRow()->refund;

        return Template::Admin('dashboard', $data);
    }

    public function admins()
    {
        try {
            $this->permission->check_permission('admins', 'view');
        } catch (\Exception $e) {
            if (is_post())
                die($this->api->error($e->getMessage()));

            return redirect()->to(route_to('admin_dashboard') . '?error=' . $e->getMessage());
        }

        $data['permission'] = $this->permission;
        $data['title'] = "Admins";

        $model = new AdminModel();
        $data['admins'] = $model->get_all_admins()->orderBy('id', 'desc')->paginate(10);
        $data['pager'] = $model->pager;

        return Template::Admin('admins/manage', $data);
    }

    public function admin_edit($id)
    {
        try {

            if ($id == $this->session->get('admin_id'))
                return redirect()->to(route_to('admin_profile'));

            try {
                $this->permission->check_permission('admins', 'edit');
            } catch (\Exception $e) {
                if (is_post())
                    die($this->api->error($e->getMessage()));

                return redirect()->to(route_to('admin_dashboard') . '?error=' . $e->getMessage());
            }

            $model = new AdminModel();
            $admin = $model->find($id);

            if (!$admin) {
                // throw exception 404 not found
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }


            $role = new AdminRoleModel();
            $roles = $role->findAll();

            if (!is_post()) {

                $data['permission'] = $this->permission;
                $data['title'] = "Edit Admin";
                $data['admin'] = $admin;
                $data['roles'] = $roles;

                return Template::Admin('admins/edit', $data);
            }


            $this->validation->setRule('role_id', 'role', 'required|trim|strip_tags');
            $this->validation->setRule('status', 'status', 'required|trim|strip_tags|in_list[active,suspended]');
            $this->validation->setRule('full_name', 'full name', 'required|trim|strip_tags|min_length[2]|max_length[100]');
            $this->validation->setRule('full_address', 'full address', 'required|trim|strip_tags|min_length[2]|max_length[500]');
            $this->validation->setRule('phone', 'phone', 'required|trim|strip_tags|min_length[7]|max_length[15]');
            $this->validation->setRule('email', 'email', 'required|valid_email|trim|strip_tags|min_length[2]|max_length[100]');

            if ($img = $this->request->getFile('image')) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $this->validation->setRule('image', 'image', 'uploaded[image]|ext_in[image,png,jpg,jpeg]|max_size[image,5120]');
                }
            }

            if ($this->validation->withRequest($this->request)->run() == false) {
                $errors = '';
                foreach (array_reverse($this->validation->getErrors()) as $error) {
                    $errors .= "<p>{$error}</p>\n";
                }

                die($this->api->error($errors));
            }


            if (!$role->find($this->request->getPost('role_id'))) {
                die($this->api->error('Invalid role'));
            }

            $data = [
                'full_name'     => $this->request->getPost('full_name'),
                'full_address'  => $this->request->getPost('full_address'),
                'phone'         => $this->request->getPost('phone'),
                'email'         => $this->request->getPost('email'),
                'role_id'       => $this->request->getPost('role_id'),
                'status'        => $this->request->getPost('status'),
            ];


            if ($img = $this->request->getFile('image')) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $path = getcwd() . '/public/uploads/admins';
                    $img->move($path, $newName);
                    $imageUpload = new File("{$path}/{$newName}");

                    $thumbnailName = $imageUpload->getBasename('.' . $imageUpload->guessExtension()) . '_thumb.' . $imageUpload->guessExtension();

                    $image = \Config\Services::image('gd');
                    $image->withFile($imageUpload->getPathname())
                        ->fit(150, 150, 'center')
                        ->save("{$path}/{$thumbnailName}");

                    $data['image'] = $imageUpload->getBasename();
                    $data['image_thumb'] = $thumbnailName;
                }
            }


            if ($model->update($id, $data)) {
                die($this->api->success('Admin updated successfully', false, ['reload' => true]));
            } else {
                die($this->api->error('Failed to update admin'));
            }
        } catch (\Exception $e) {
            if (is_post())
                die($this->api->error($e->getMessage()));

            return redirect()->to(route_to('admin_dashboard') . '?error=' . $e->getMessage());
        }
    }

    public function admin_add()
    {
        try {
            try {
                $this->permission->check_permission('admins', 'add');
            } catch (\Exception $e) {
                if (is_post())
                    die($this->api->error($e->getMessage()));

                return redirect()->to(route_to('admin_dashboard') . '?error=' . $e->getMessage());
            }

            $model = new AdminModel();

            $role = new AdminRoleModel();
            $roles = $role->findAll();

            if (!is_post()) {

                $data['permission'] = $this->permission;
                $data['title'] = "Add Admin";
                $data['roles'] = $roles;

                return Template::Admin('admins/new', $data);
            }


            $this->validation->setRule('role_id', 'role', 'required|trim|strip_tags');
            $this->validation->setRule('status', 'status', 'required|trim|strip_tags|in_list[active,suspended]');
            $this->validation->setRule('full_name', 'full name', 'required|trim|strip_tags|min_length[2]|max_length[100]');
            $this->validation->setRule('full_address', 'full address', 'required|trim|strip_tags|min_length[2]|max_length[500]');
            $this->validation->setRule('phone', 'phone', 'required|trim|strip_tags|min_length[7]|max_length[15]');
            $this->validation->setRule('email', 'email', 'required|valid_email|trim|strip_tags|min_length[2]|max_length[100]|is_unique[admins.email]');
            $this->validation->setRule('password', 'password', 'required|trim|min_length[6]|max_length[100]');
            $this->validation->setRule('confirm_password', 'confirm password', 'required|matches[password]');

            $this->validation->setRule('image', 'image', 'uploaded[image]|ext_in[image,png,jpg,jpeg]|max_size[image,5120]');

            if ($this->validation->withRequest($this->request)->run() == false) {
                $errors = '';
                foreach (array_reverse($this->validation->getErrors()) as $error) {
                    $errors .= "<p>{$error}</p>\n";
                }

                die($this->api->error($errors));
            }


            if (!$role->find($this->request->getPost('role_id'))) {
                die($this->api->error('Invalid role'));
            }

            $data = [
                'full_name'     => $this->request->getPost('full_name'),
                'full_address'  => $this->request->getPost('full_address'),
                'phone'         => $this->request->getPost('phone'),
                'email'         => $this->request->getPost('email'),
                'role_id'       => $this->request->getPost('role_id'),
                'status'        => $this->request->getPost('status'),
                'email'         => $this->request->getPost('email'),
                'password'      => create_password($this->request->getPost('password')),
            ];


            if ($img = $this->request->getFile('image')) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $path = getcwd() . '/public/uploads/admins';
                    $img->move($path, $newName);
                    $imageUpload = new File("{$path}/{$newName}");

                    $thumbnailName = $imageUpload->getBasename('.' . $imageUpload->guessExtension()) . '_thumb.' . $imageUpload->guessExtension();

                    $image = \Config\Services::image('gd');
                    $image->withFile($imageUpload->getPathname())
                        ->fit(150, 150, 'center')
                        ->save("{$path}/{$thumbnailName}");

                    $data['image'] = $imageUpload->getBasename();
                    $data['image_thumb'] = $thumbnailName;
                } else {
                    die($this->api->error('Invalid image'));
                }
            }


            if ($model->insert($data)) {
                die($this->api->success('Admin added successfully', false, ['redirect' => base_url(route_to('admin_admins'))]));
            } else {
                die($this->api->error('Failed to add admin'));
            }
        } catch (\Exception $e) {
            die($this->api->error($e->getMessage()));
        }
    }

    public function myprofile()
    {
        try {
            try {
                $this->permission->check_permission('admins', 'edit');
            } catch (\Exception $e) {
                if (is_post())
                    die($this->api->error($e->getMessage()));

                return redirect()->to(route_to('admin_dashboard') . '?error=' . $e->getMessage());
            }

            $id = $this->session->get('admin_id');

            $model = new AdminModel();
            $admin = $model->find($id);

            if (!$admin) {
                // throw exception 404 not found
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $role = new AdminRoleModel();
            $roles = $role->findAll();

            if (!is_post()) {

                $data['permission'] = $this->permission;
                $data['title'] = "Update Profile";
                $data['admin'] = $admin;
                $data['roles'] = $roles;

                return Template::Admin('profile/update', $data);
            }

            $this->validation->setRule('full_name', 'full name', 'required|trim|strip_tags|min_length[2]|max_length[100]');
            $this->validation->setRule('full_address', 'full address', 'required|trim|strip_tags|min_length[2]|max_length[500]');
            $this->validation->setRule('phone', 'phone', 'required|trim|strip_tags|min_length[7]|max_length[15]');
            $this->validation->setRule('email', 'email', 'required|valid_email|trim|strip_tags|min_length[2]|max_length[100]');

            if ($img = $this->request->getFile('image')) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $this->validation->setRule('image', 'image', 'uploaded[image]|ext_in[image,png,jpg,jpeg]|max_size[image,5120]');
                }
            }

            if ($this->request->getPost('password') || $this->request->getPost('confirm_password')) {
                $this->validation->setRule('password', 'password', 'required|trim|strip_tags|min_length[6]|max_length[100]');
                $this->validation->setRule('confirm_password', 'confirm password', 'required|matches[password]');
            }

            if ($this->validation->withRequest($this->request)->run() == false) {
                $errors = '';
                foreach (array_reverse($this->validation->getErrors()) as $error) {
                    $errors .= "<p>{$error}</p>\n";
                }

                die($this->api->error($errors));
            }


            if (!$role->find($this->request->getPost('role_id'))) {
                die($this->api->error('Invalid role'));
            }

            $data = [
                'full_name'     => $this->request->getPost('full_name'),
                'full_address'  => $this->request->getPost('full_address'),
                'phone'         => $this->request->getPost('phone'),
                'email'         => $this->request->getPost('email'),
            ];

            if ($this->request->getPost('password')) {
                $data['password'] = create_password($this->request->getPost('password'));
            }


            if ($img = $this->request->getFile('image')) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $path = getcwd() . '/public/uploads/admins';
                    $img->move($path, $newName);
                    $imageUpload = new File("{$path}/{$newName}");

                    $thumbnailName = $imageUpload->getBasename('.' . $imageUpload->guessExtension()) . '_thumb.' . $imageUpload->guessExtension();

                    $image = \Config\Services::image('gd');
                    $image->withFile($imageUpload->getPathname())
                        ->fit(150, 150, 'center')
                        ->save("{$path}/{$thumbnailName}");

                    $data['image'] = $imageUpload->getBasename();
                    $data['image_thumb'] = $thumbnailName;
                }
            }


            if ($model->update($id, $data)) {

                if (isset($data['password'])) {
                    $email = new CustomEmail();
                    $email->setProtcols();

                    $data['admin'] = $admin;
                    $data['message'] = "Hi {$admin->full_name},<br><br>";
                    $data['message'] .= "Your password has been reset successfully.<br><br>";
                    $data['message'] .= "Thanks,<br>";
                    $data['message'] .= "Admin";

                    $email->sendMail($admin->email, 'Password Reset', $data);
                }

                die($this->api->success('Account updated successfully', false, ['reload' => true]));
            } else {
                die($this->api->error('Failed to update your account'));
            }
        } catch (\Exception $e) {
            if (is_post())
                die($this->api->error($e->getMessage()));

            return redirect()->to(route_to('admin_dashboard') . '?error=' . $e->getMessage());
        }
    }

    public function admin_roles()
    {
        try {
            try {
                $this->permission->check_permission('admin_roles', 'view');
            } catch (\Exception $e) {
                if (is_post())
                    die($this->api->error($e->getMessage()));

                return redirect()->to(route_to('admin_dashboard') . '?error=' . $e->getMessage());
            }

            $data['permission'] = $this->permission;
            $data['title'] = "Admin Roles";

            $model = new AdminRoleModel();
            $permissionModel = new AdminPermissionModel();
            $rolePermissionModel = new AdminRolePermissionModel();

            $roles = $model->orderBy('id', 'asc')->findAll();
            $permissions = $permissionModel->orderBy('name', 'asc')->findAll();
            $role_permissions = $rolePermissionModel->findAll();

            $admin_roles = [];

            foreach ($roles as $key => $role) {
                $admin_roles[$role->name] = [
                    'id'            => $role->id,
                    'name'          => $role->name,
                    'permissions'   => []
                ];
                foreach ($permissions as $permission) {
                    $admin_roles[$role->name]['permissions'][$permission->key] = [
                        'id'                    => $permission->id,
                        'name'                  => $permission->name,
                        'perm_view_exists'      => $permission->perm_view,
                        'perm_add_exists'       => $permission->perm_add,
                        'perm_edit_exists'      => $permission->perm_edit,
                        'perm_delete_exists'    => $permission->perm_delete,
                        'perm_view'             => false,
                        'perm_add'              => false,
                        'perm_edit'             => false,
                        'perm_delete'           => false,
                    ];

                    foreach ($role_permissions as $role_permission) {
                        if ($role_permission->role_id == $role->id && $role_permission->permission_id == $permission->id) {

                            if ($permission->perm_view == 1 && $role_permission->perm_view == 1)
                                $admin_roles[$role->name]['permissions'][$permission->key]['perm_view'] = true;

                            if ($permission->perm_add == 1 && $role_permission->perm_add == 1)
                                $admin_roles[$role->name]['permissions'][$permission->key]['perm_add'] = true;

                            if ($permission->perm_edit == 1 && $role_permission->perm_edit == 1)
                                $admin_roles[$role->name]['permissions'][$permission->key]['perm_edit'] = true;

                            if ($permission->perm_delete == 1 && $role_permission->perm_delete == 1)
                                $admin_roles[$role->name]['permissions'][$permission->key]['perm_delete'] = true;
                        }
                    }
                }
            }

            $admin_roles = json_decode(json_encode($admin_roles));

            // dd($admin_roles);

            $data['admin_roles'] = $admin_roles;
            return Template::Admin('admins/roles/manage', $data);
        } catch (\Exception $e) {
            if (is_post())
                die($this->api->error($e->getMessage()));

            return redirect()->to(route_to('admin_dashboard') . '?error=' . $e->getMessage());
        }
    }

    public function admin_role_edit($id)
    {

        try {
            $this->permission->check_permission('admin_roles', 'view');
        } catch (\Exception $e) {
            if (is_post())
                die($this->api->error($e->getMessage()));

            return redirect()->to(route_to('admin_dashboard') . '?error=' . $e->getMessage());
        }

        $model = new AdminRoleModel();
        $permissionModel = new AdminPermissionModel();
        $rolePermissionModel = new AdminRolePermissionModel();

        $role = $model->where('id', $id)->orderBy('name', 'asc')->first();
        $permissions = $permissionModel->orderBy('name', 'asc')->findAll();
        $role_permissions = $rolePermissionModel->where('role_id', $id)->findAll();


        if (!is_post()) {
            $data['permission'] = $this->permission;
            $data['title'] = "Edit Admin Role";


            $admin_roles = [
                'id'            => $role->id,
                'name'          => $role->name,
                'permissions'   => []
            ];

            foreach ($permissions as $permission) {
                $admin_roles['permissions'][$permission->key] = [
                    'id'                    => $permission->id,
                    'name'                  => $permission->name,
                    'key'                   => $permission->key,
                    'perm_view_exists'      => $permission->perm_view,
                    'perm_add_exists'       => $permission->perm_add,
                    'perm_edit_exists'      => $permission->perm_edit,
                    'perm_delete_exists'    => $permission->perm_delete,
                    'perm_view'             => false,
                    'perm_add'              => false,
                    'perm_edit'             => false,
                    'perm_delete'           => false,
                ];

                foreach ($role_permissions as $role_permission) {
                    if ($role_permission->role_id == $role->id && $role_permission->permission_id == $permission->id) {

                        if ($permission->perm_view == 1 && $role_permission->perm_view == 1)
                            $admin_roles['permissions'][$permission->key]['perm_view'] = true;

                        if ($permission->perm_add == 1 && $role_permission->perm_add == 1)
                            $admin_roles['permissions'][$permission->key]['perm_add'] = true;

                        if ($permission->perm_edit == 1 && $role_permission->perm_edit == 1)
                            $admin_roles['permissions'][$permission->key]['perm_edit'] = true;

                        if ($permission->perm_delete == 1 && $role_permission->perm_delete == 1)
                            $admin_roles['permissions'][$permission->key]['perm_delete'] = true;
                    }
                }
            }
            $admin_roles = json_decode(json_encode($admin_roles));

            $data['role'] = $admin_roles;
            return Template::Admin('admins/roles/edit', $data);
        }

        try {
            $this->validation->setRule('role_name', 'role name', 'required|trim|min_length[2]');

            if ($this->validation->withRequest($this->request)->run() == false) {
                $errors = '';
                foreach (array_reverse($this->validation->getErrors()) as $error) {
                    $errors .= "<p>{$error}</p>\n";
                }

                die($this->api->error($errors));
            }

            $name = $this->request->getPost('role_name');

            if ($model->update($id, ['name' => $name])) {

                $given_permissions = $this->request->getPost('permissions');

                $rolePermissionModel->where('role_id', $id)->delete();
                $perm_data = [];

                foreach ($permissions as $key => $permission) {
                    $perm_data = [
                        'role_id'           => $id,
                        'permission_id'     => $permission->id,
                        'perm_view'         => 0,
                        'perm_add'          => 0,
                        'perm_edit'         => 0,
                        'perm_delete'       => 0,
                    ];

                    if (!is_null($given_permissions)) {
                        foreach ($given_permissions as $given_key => $given_permission) {
                            if ($role->id == 1 && $permission->key == 'admin_roles') {
                                $perm_data['perm_view'] = 1;
                                $perm_data['perm_add'] = 1;
                                $perm_data['perm_edit'] = 1;
                                $perm_data['perm_delete'] = 1;
                            } elseif ($given_key == $permission->key) {
                                $perm_data['perm_view'] = ($permission->perm_view == 1) ? (isset($given_permission['view']) ? $given_permission['view'] : 0) : 0;
                                $perm_data['perm_add'] = ($permission->perm_add == 1) ? (isset($given_permission['add']) ? $given_permission['add'] : 0) : 0;
                                $perm_data['perm_edit'] = ($permission->perm_edit == 1) ? (isset($given_permission['edit']) ? $given_permission['edit'] : 0) : 0;
                                $perm_data['perm_delete'] = ($permission->perm_delete == 1) ? (isset($given_permission['delete']) ? $given_permission['delete'] : 0) : 0;
                            }
                        }
                    }
                    $rolePermissionModel->insert($perm_data);
                }

                die($this->api->success('Role updated successfully', false, ['reload' => true]));
            } else {
                die($this->api->error('Role update failed'));
            }
        } catch (\Exception $e) {
            die($this->api->error($e->getMessage()));
        }
    }

    public function admin_role_add()
    {

        try {
            $this->permission->check_permission('admin_roles', 'view');
        } catch (\Exception $e) {
            if (is_post())
                die($this->api->error($e->getMessage()));

            return redirect()->to(route_to('admin_dashboard') . '?error=' . $e->getMessage());
        }

        $model = new AdminRoleModel();
        $permissionModel = new AdminPermissionModel();
        $rolePermissionModel = new AdminRolePermissionModel();

        $permissions = $permissionModel->orderBy('name', 'asc')->findAll();


        if (!is_post()) {
            $data['permission'] = $this->permission;
            $data['title'] = "Add Admin Role";

            foreach ($permissions as $permission) {
                $admin_roles['permissions'][$permission->key] = [
                    'id'                    => $permission->id,
                    'name'                  => $permission->name,
                    'key'                   => $permission->key,
                    'perm_view_exists'      => $permission->perm_view,
                    'perm_add_exists'       => $permission->perm_add,
                    'perm_edit_exists'      => $permission->perm_edit,
                    'perm_delete_exists'    => $permission->perm_delete,
                    'perm_view'             => false,
                    'perm_add'              => false,
                    'perm_edit'             => false,
                    'perm_delete'           => false,
                ];
            }
            $admin_roles = json_decode(json_encode($admin_roles));

            $data['role'] = $admin_roles;
            return Template::Admin('admins/roles/new', $data);
        }

        try {
            $this->validation->setRule('role_name', 'role name', 'required|trim|min_length[2]');

            if ($this->validation->withRequest($this->request)->run() == false) {
                $errors = '';
                foreach (array_reverse($this->validation->getErrors()) as $error) {
                    $errors .= "<p>{$error}</p>\n";
                }

                die($this->api->error($errors));
            }

            $name = $this->request->getPost('role_name');

            if ($id = $model->insert(['name' => $name])) {

                $given_permissions = $this->request->getPost('permissions');

                $rolePermissionModel->where('role_id', $id)->delete();
                $perm_data = [];

                foreach ($permissions as $key => $permission) {
                    $perm_data = [
                        'role_id'           => $id,
                        'permission_id'     => $permission->id,
                        'perm_view'         => 0,
                        'perm_add'          => 0,
                        'perm_edit'         => 0,
                        'perm_delete'       => 0,
                    ];

                    if (!is_null($given_permissions)) {
                        foreach ($given_permissions as $given_key => $given_permission) {
                            if ($given_key == $permission->key) {
                                $perm_data['perm_view'] = ($permission->perm_view == 1) ? (isset($given_permission['view']) ? $given_permission['view'] : 0) : 0;
                                $perm_data['perm_add'] = ($permission->perm_add == 1) ? (isset($given_permission['add']) ? $given_permission['add'] : 0) : 0;
                                $perm_data['perm_edit'] = ($permission->perm_edit == 1) ? (isset($given_permission['edit']) ? $given_permission['edit'] : 0) : 0;
                                $perm_data['perm_delete'] = ($permission->perm_delete == 1) ? (isset($given_permission['delete']) ? $given_permission['delete'] : 0) : 0;
                            }
                        }
                    }
                    $rolePermissionModel->insert($perm_data);
                }

                die($this->api->success('Role added successfully', false, ['redirect' => base_url(route_to('admin_roles'))]));
            } else {
                die($this->api->error('Role failed to add'));
            }
        } catch (\Exception $e) {
            die($this->api->error($e->getMessage()));
        }
    }

    public function settings()
    {

        try {
            $this->permission->check_permission('settings', 'view');
        } catch (\Exception $e) {
            if (is_post())
                die($this->api->error($e->getMessage()));

            return redirect()->to(route_to('admin_dashboard') . '?error=' . $e->getMessage());
        }

        $model = new SettingModel();


        if (!is_post()) {
            $data['permission'] = $this->permission;
            $data['title'] = "Settings";

            return Template::Admin('settings/manage', $data);
        }
        try {
            $this->permission->check_permission('settings', 'edit');

            foreach ($this->request->getPost() as $key => $value)
                $this->validation->setRule($key, str_replace('_', ' ', $key), 'trim');


            if ($this->validation->withRequest($this->request)->run() == false) {
                $errors = '';
                foreach (array_reverse($this->validation->getErrors()) as $error) {
                    $errors .= "<p>{$error}</p>\n";
                }

                die($this->api->error($errors));
            }


            $data = [];
            foreach ($this->request->getPost() as $key => $value)
                $data[$key] = $value;


            if ($img = $this->request->getFile('logo')) {
                if ($img->isValid() && !$img->hasMoved()) {

                    $extension = $img->getExtension();
                    $extension = empty($extension) ? '' : '.' . $extension;
                    $newName = 'logo-' . time() . $extension;

                    $path = getcwd() . '/public/assets/pics';
                    $img->move($path, $newName);
                    $imageUpload = new File("{$path}/{$newName}");

                    $data['logo'] = $imageUpload->getBasename();
                }
            }
            if ($img = $this->request->getFile('white_logo')) {
                if ($img->isValid() && !$img->hasMoved()) {

                    $extension = $img->getExtension();
                    $extension = empty($extension) ? '' : '.' . $extension;
                    $newName = 'white_logo-' . time() . $extension;

                    $path = getcwd() . '/public/assets/pics';
                    $img->move($path, $newName);
                    $imageUpload = new File("{$path}/{$newName}");

                    $data['white_logo'] = $imageUpload->getBasename();
                }
            }

            $options = $model->findAll();
            $updated = false;
            foreach ($data as $key => $value) {
                foreach ($options as $row) {
                    if ($row->key == $key)
                        if ($model->update($row->id, ['value' => $value])) {
                            $updated = true;
                        }
                }
            }

            if ($updated) {
                die($this->api->success('Settings updated successfully', false, ['reload' => true]));
            } else {
                die($this->api->error('Settings update failed'));
            }
        } catch (\Exception $e) {
            die($this->api->error($e->getMessage()));
        }
    }

    public function login()
    {

        $option = new Options(); // Loading Options Library
        $option->load(); // Loading Options

        if (!is_post()) {
            $data['title'] = "Admin Login";
            $data['option'] = $option->key;

            return view("admin/login", $data);
        }

        $this->validation->setRule('email', 'email', 'required|valid_email|trim|strip_tags|min_length[2]');
        $this->validation->setRule('password', 'password', 'required|trim|min_length[2]');

        if ($this->validation->withRequest($this->request)->run() == false) {
            $errors = '';
            foreach (array_reverse($this->validation->getErrors()) as $error) {
                $errors .= "<p>{$error}</p>\n";
            }

            die($this->api->error($errors));
        }


        try {

            $model = new AdminModel();
            if ($admin = $model->login($this->request->getPost('email'))->first()) {
                if (password_verify($this->request->getPost('password'), $admin->password)) {
                    $data = [
                        'last_login' => date('Y-m-d H:i:s'),
                        'last_ip'    => $this->request->getIPAddress(),
                    ];
                    $model->update($admin->id, $data);

                    $session_data = [
                        'admin_last_login'      => date('Y-m-d H:i:s'),
                        'admin_last_ip'         => $this->request->getIPAddress(),
                        'is_admin_logged_in'    => true
                    ];
                    foreach ($admin as $key => $value) {
                        if (!in_array($key, ['password'])) {
                            $session_data["admin_{$key}"] = $value;
                        }
                    }

                    $this->session->set($session_data);

                    return die($this->api->success(
                        'Login successful redirecting...',
                        false,
                        [
                            'redirect' => base_url(route_to('admin_dashboard')),
                            'time'     => 0
                        ]
                    ));
                }
            }

            return die($this->api->error('Wrong email or password'));
        } catch (\Exception $e) {
            return die($this->api->error($e->getMessage()));
        }
    }

    public function forgot_password()
    {

        $option = new Options(); // Loading Options Library
        $option->load(); // Loading Options

        if (!is_post()) {
            $data['title'] = "Forgot Password";
            $data['option'] = $option->key;

            return view("admin/reset_password", $data);
        }

        if ($this->session->set("last_sent")) {
            if (time() - $this->session->get("last_sent") < 60) {
                return $this->api->error("Please wait for 60 seconds, before sending another message.");
            }
        }

        $this->validation->setRule('email', 'email', 'required|valid_email|trim|strip_tags|min_length[2]|max_length[100]');

        if ($this->validation->withRequest($this->request)->run() == false) {
            $errors = '';
            foreach (array_reverse($this->validation->getErrors()) as $error) {
                $errors .= "<p>{$error}</p>\n";
            }

            die($this->api->error($errors));
        }

        $email = $this->request->getPost('email');

        $model = new AdminModel();
        $admin = $model->where('email', $email)->first();

        if (!$admin) {
            die($this->api->error('Email not found'));
        }

        $token = random_string('alnum', 32);
        $model->update($admin->id, ['reset_password_token' => $token]);

        $data['token'] = $token;
        $data['admin'] = $admin;

        $message = "Hi {$admin->full_name},<br><br>";
        $message .= "You have requested to reset your password. Please click the link below to reset your password.<br><br>";
        $message .= "<a href='" . base_url(uri_segements([1], "reset_password_now/{$token}")) . "'>Reset Password</a><br><br>";
        $message .= "If you did not request to reset your password, please ignore this email.<br><br>";
        $message .= "Thanks,<br>";
        $message .= "Admin";

        $data['message'] = $message;

        $email = new CustomEmail();
        $email->setProtcols();

        $this->session->set("last_sent", time());
        if ($email->sendMail($admin->email, 'Reset Password', $data))
            die($this->api->success('Reset password link has been sent to your email'));
        else
            die($this->api->error('Failed to send reset password link to your email'));
    }

    public function reset_password_now($reset_token)
    {
        $option = new Options(); // Loading Options Library
        $option->load(); // Loading Options

        if (!is_post()) {
            $data['title'] = "Reset Password";
            $data['option'] = $option->key;

            $model = new AdminModel();
            $admin = $model->where('reset_password_token', $reset_token)->first();

            if (!$admin) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $data['admin'] = $admin;

            return view("admin/reset_password_now", $data);
        }

        $this->validation->setRule('new_password', 'new password', 'required|trim|min_length[6]|max_length[100]');
        $this->validation->setRule('confirm_new_password', 'confirm new password', 'required|trim|min_length[6]|max_length[100]|matches[new_password]');

        if ($this->validation->withRequest($this->request)->run() == false) {
            $errors = '';
            foreach (array_reverse($this->validation->getErrors()) as $error) {
                $errors .= "<p>{$error}</p>\n";
            }

            die($this->api->error($errors));
        }

        $model = new AdminModel();
        $admin = $model->where('reset_password_token', $reset_token)->first();

        if (!$admin) {
            die($this->api->error('Invalid reset password token'));
        }

        $password = $this->request->getPost('new_password');


        $data = [
            'password'              => create_password($password),
            'reset_password_token'  => null,
            'password_reset_at'     => date('Y-m-d H:i:s'),
        ];

        if ($model->update($admin->id, $data)) {

            $email = new CustomEmail();
            $email->setProtcols();

            $data['admin'] = $admin;
            $data['message'] = "Hi {$admin->full_name},<br><br>";
            $data['message'] .= "Your password has been reset successfully.<br><br>";
            $data['message'] .= "Thanks,<br>";
            $data['message'] .= "Admin";

            $email->sendMail($admin->email, 'Password Reset', $data);

            die($this->api->success('Password reset successfully', false, ['redirect' => base_url(route_to('admin_login'))]));
        } else {
            die($this->api->error('Failed to reset password'));
        }
    }


    public function logout()
    {
        $this->session->destroy();

        return redirect()->to(route_to('admin_login'));
    }
}
