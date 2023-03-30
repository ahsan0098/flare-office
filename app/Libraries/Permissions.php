<?php

namespace App\Libraries;

use App\Models\User;
use App\Models\AdminRole;
use App\Models\AdminPermission;
use App\Models\AdminRolePermission;
use Exception;

class Permissions
{
    private $session;

    private $admin_permissions;

    private $admin_role_permission;

    private $available_permissions;

    private $role_id;

    private $admin;

    private $admin_roles;

    private $role_permissions;

    public function __construct()
    {
        $this->session = session();

        $this->admin = new User();

        $this->admin_roles = new AdminRole();

        $this->admin_permissions = new AdminPermission();

        $this->admin_role_permission = new AdminRolePermission();

        $this->available_permissions = [];

        $this->role_permissions = [];

        // $this->role_id = $this->session->get('admin_role_id') ?? 1;
    }

    public function load_permissions()
    {
        try {

            // $this->get_permissions();
            // $this->get_role_permissions($this->role_id);
            return $this->get_roles();
            // $this->get_role_permissions($role_id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function get_roles()
    {
        return $this->admin_roles->all();
    }
    public function get_role_permissions($role_id)
    {
        $role_permission = $this->admin_role_permission->where('role_id', $role_id)->with('permission')->get();
        return $role_permission = json_decode($role_permission, true);
    }
    public function hasPermission($key, $permission)
    {
        try {
            $key = "perm_" . $key;
            $perm_id = $this->admin_permissions->where('name', $permission)->first();
            if ($perm_id) {
                $perm_id = $perm_id->id;
                $check = $this->admin_role_permission->select($key)->where('role_id', session('user')['role_id'])->where('permission_id', $perm_id)->first();
                // $check = json_decode($check, true);

                if ($check) {
                    return ['status' => true];
                } else {
                    return ['status' => false, 'message' => 'User do not have permission to perform this task'];
                }
            } else {
                return ['status' => false, 'message' => 'Permission name does not match to any permission'];
            }
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];;
        }
    }

    public function check_permission($key, $permission)
    {
        try {

            if (!$this->hasPermission($key, $permission)) {
                throw new \Exception("You don't have permission to access this page");
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    private function convert_to_object(array $array)
    {
        return json_decode(json_encode($array));
    }
    public function get_permissions()
    {

        try {
            $all_permissions = $this->admin_permissions->All();

            // $permissions = [];

            // foreach ($all_permissions as $permission) {
            //     $permissions[$permission->slug] = [
            //         'id'            => $permission->id,
            //         'name'          => $permission->name,
            //         'slug'           => $permission->key,
            //         'perm_view'     => $permission->perm_view,
            //         'perm_add'      => $permission->perm_add,
            //         'perm_edit'     => $permission->perm_edit,
            //         'perm_delete'   => $permission->perm_delete
            //     ];
            // }

            return $all_permissions;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function update_permission($perm_id, $perm_type, $role)
    {
        try {
            $update_role_permission = $this->admin_role_permission->where('role_id', $role)->where('permission_id', $perm_id)->first();
            if ($update_role_permission) {
                foreach ($perm_type as $perm => $val) {
                    $perm = trim($perm);
                    $val = trim($val);
                    if ($val != 1) {
                        $update_role_permission->$perm = 0;
                    } else {
                        $update_role_permission->$perm = $val;
                    }
                }
                $update_role_permission->save();
            } else {
                foreach ($perm_type as $perm => $val) {
                    $this->admin_role_permission->role_id = $role;
                    $this->admin_role_permission->permission_id = $perm_id;
                    $this->admin_role_permission->$perm = $val;
                }
                $this->admin_role_permission->save();
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    // private function get_role_permissions($role_id)
    // {
    //     try {

    //         $admin_role_permission = $this->admin_role_permission->where('role_id', $role_id)->findAll();

    //         $permissions = [];

    //         foreach ($admin_role_permission as $permission) {
    //             $permissions[$permission->permission_id] = [
    //                 'perm_view'     => $permission->perm_view,
    //                 'perm_add'      => $permission->perm_add,
    //                 'perm_edit'     => $permission->perm_edit,
    //                 'perm_delete'   => $permission->perm_delete
    //             ];
    //         }

    //         return $this->role_permissions = $permissions;
    //     } catch (\Exception $e) {
    //         throw new \Exception($e->getMessage());
    //     }
    // }
}
