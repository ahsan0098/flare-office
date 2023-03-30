<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\AdminRole;
use Illuminate\Support\Str;
use App\Libraries\Permissions;
use App\Models\AdminPermission;
use League\CommonMark\Normalizer\SlugNormalizer;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AdminRolesAndPermissions extends Component
{
    protected $permission;
    public $newrole;
    public $admin_roles = [];
    public $role_permissions = [];
    public $all_permissions = [];
    public $test;
    public $newpermission;
    public $add = false;
    public $view = false;
    public $edit = false;
    public $del = false;
    function __construct()
    {
        $this->permission = new Permissions(); // Loading Permissions Library
    }


    public function mount()
    {
        // $this->permission = new Permissions(); // Loading Permissions Library
        $this->admin_roles = $this->permission->load_permissions(); // Loading Permissions
        foreach ($this->admin_roles as $role) {
            $this->role_permissions[$role->name] = $this->permission->get_role_permissions($role->id);
        }
    }

    public function addrole()
    {
        $this->validate([
            'newrole' => 'required'
        ]);
        $admin_role = new AdminRole;
        $admin_role->name = $this->newrole;
        if ($admin_role->save()) {
            $this->admin_roles = $this->permission->load_permissions();
            $this->dispatchBrowserEvent('swal:updatepassword', [
                'icon' => "success",
                'text' => 'New admin role has been added'
            ]);
        }
    }
    public function addpermission()
    {
        $this->validate([
            'newpermission' => 'required'
        ]);
        $permission = new AdminPermission;
        $permission->name = $this->newpermission;
        $permission->slug = Str::slug($this->newpermission);
        $permission->perm_view = $this->view;
        $permission->perm_add = $this->add;
        $permission->perm_edit = $this->edit;
        $permission->perm_delete = $this->del;
        $permission->perm_delete = $this->del;
        if ($permission->save()) {
            $this->all_permissions = $this->permission->get_permissions();
            $this->dispatchBrowserEvent('swal:updatepassword', [
                'icon' => "success",
                'text' => 'New admin role has been added'
            ]);
        }
    }
    public function getPermissions()
    {
        $this->all_permissions = $this->permission->get_permissions();
        $this->all_permissions = json_decode($this->all_permissions, true);
    }
    public function render()
    {
        return view('livewire.admin.admin-roles-and-permissions')->layout('layouts.admin-base');
    }
}
