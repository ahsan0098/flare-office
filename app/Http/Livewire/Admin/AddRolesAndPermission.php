<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Libraries\Permissions;

class AddRolesAndPermission extends Component
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
    public function mount()
    {
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
                $this->permission->create_permission(trim($perm_id), $perm_type);

                $this->dispatchBrowserEvent('swal:updatepassword', [
                    'icon' => "success",
                    'text' => 'New admin role has been added'
                ]);
            } catch (\Exception $e) {
                dd($this->input);
            }
        }
        // $this->inputs =[$perm_id =>$perm_type];
    }
    public function render()
    {
        return view('livewire.admin.add-roles-and-permission')->layout('layouts.admin-base');
    }
}
