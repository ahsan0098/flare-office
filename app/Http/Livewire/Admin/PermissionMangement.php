<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Libraries\Permissions;
use App\Models\AdminRole;
use App\Models\AdminRolePermission;
use GuzzleHttp\Psr7\Request;

class PermissionMangement extends Component
{
    protected $permission;
    public $inputs = [];
    public $input = [];
    public $role_name;
    public $send_role;
    protected $listeners = ['inputreceived' => 'inputreceived'];
    public $all_permissions = [];
    public $test;
    function __construct()
    {
        $this->permission = new Permissions(); // Loading Permissions Library

    }
    public function mount($role_name)
    {
        $this->role_name = $role_name;
        $this->role_name = AdminRole::where('name', $this->role_name)->first();
        $this->role_name = $this->role_name->id;
        $current_perms = AdminRolePermission::where('role_id', $this->role_name)->with('permission')->get();
        foreach ($current_perms as $index => $perm) {
            $this->inputs[$perm->permission->id]['perm_view'] = $perm->perm_view;
            $this->inputs[$perm->permission->id]['perm_add'] = $perm->perm_add;
            $this->inputs[$perm->permission->id]['perm_edit'] = $perm->perm_edit;
            $this->inputs[$perm->permission->id]['perm_delete'] = $perm->perm_delete;
        }

        $this->all_permissions = $this->permission->get_permissions();
        $this->all_permissions = json_decode($this->all_permissions, true);
    }
    public function inputreceived($index, $input)
    {
        foreach ($input as $i => $val) {
            $this->input[$index][$i] = $val;
        }
    }
    public function set_permissions()
    {
        foreach ($this->input as $perm_id => $perm_type) {
            try {
                $this->permission->update_permission(trim($perm_id), $perm_type, $this->role_name);

                $this->dispatchBrowserEvent('swal:updatepassword', [
                    'icon' => "success",
                    'text' => 'Permissions are updated'
                ]);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
    }
    public function render()
    {

        return view('livewire.admin.permission-mangement')->layout('layouts.admin-base');
    }
}
