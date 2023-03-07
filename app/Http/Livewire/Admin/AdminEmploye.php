<?php

namespace App\Http\Livewire\Admin;

use App\Models\department;
use App\Models\subdepartment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdminEmploye extends Component
{
    public $edit_id;
    public $emp_name;
    public $emp_email;
    public $emp_password;
    public $emp_department;
    public $emp_position;
    public $emp_salary;
    public $edit_name;
    public $edit_email;
    public $edit_password;
    public $edit_department;
    public $edit_position;
    public $edit_salary;
    public $test = "try";
    public $deps;
    public $employe;
    public $sub_deps = [];
    public $search = null;
    protected $listeners = ['search' => 'search', 'deleteEmp' => 'deleteEmp'];
    public function mount()
    {
        $this->employe = User::with('department')->with('position')->get();
        // $this->employe = json_decode($this->employe, true);
        $this->deps = department::all();
    }
    public function updated()
    {
        $this->employe = User::with('department')->with('position')->get();
        $this->deps = department::all();
    }
    public function changeEvent($value = null)
    {
        if ($value != null) {
            $this->sub_deps = subdepartment::where('dep_id', $value)->get();
        }
    }
    public function addEmploye()
    {
        $this->validate([
            'emp_name' => 'required',
            'emp_email' => 'required|email|unique:users,email',
            'emp_password' => 'required',
            'emp_department' => 'required',
            'emp_position' => 'required',
            'emp_salary' => 'required|integer',
        ]);
        $this->emp_password = Hash::make($this->emp_password);
        $user = new User;
        $user->name = $this->emp_name;
        $user->email = $this->emp_email;
        $user->password = $this->emp_password;
        $user->department_id = $this->emp_department;
        $user->sub_department_id = $this->emp_position;
        $user->salary = $this->emp_salary;
        if ($user->save()) {
            $this->dispatchBrowserEvent('swal:add_employes', [
                'icon' => 'success',
                'text' => 'Success! Employe registered successfully.',
            ]);
            $this->emp_name = '';
            $this->emp_email = '';
            $this->emp_password = '';
            $this->emp_department = '';
            $this->emp_position = '';
            $this->emp_salary = '';
        }
    }
    public function test($id = null)
    {
        $this->dispatchBrowserEvent('swal:message', [
            'icon' => 'success',
            'text' => 'Success! Employe record updated successfully.',
        ]);
    }
    public function Edit($id)
    {
        $user = User::find($id);
        $this->edit_id = $user->id;
        $this->edit_name = $user->name;
        $this->edit_email = $user->email;
        $this->edit_password = $user->password;
        $this->edit_department = $user->department_id;
        $this->edit_position = $user->sub_department_id;
        $this->edit_salary = $user->salary;
    }
    public function choseDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirmDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, Delete!',
            'id' => $id,

        ]);
    }
    public function deleteEmp($id)
    {
        $user = User::with('employe')->where('id', $id);
        if ($user->delete()) {
            $this->dispatchBrowserEvent('swal:add_employes', [
                'icon' => "success",
                'text' => 'empolye deleted successfully.',
            ]);
        }
    }
    public function deactivate($emp_id)
    {
        $user = User::find($emp_id);
        $user->status = !($user->status);
        $msg = '';
        $icon = '';
        if ($user->status) {
            $msg = 'Success! Employe activated.';
            $icon = 'success';
        } else {
            $msg = 'Success! Employe deactivated.';
            $icon = 'warning';
        }
        if ($user->save()) {
            $this->dispatchBrowserEvent('swal:add_employes', [
                'icon' => $icon,
                'text' => $msg,
            ]);
        }
    }
    public function UpdateEmploye()
    {
        $this->test = "update working";
        $this->validate([
            'edit_name' => 'required',
            'edit_email' => 'required',
            'edit_password' => 'required',
            'edit_department' => 'required',
            'edit_position' => 'required',
            'edit_salary' => 'required|integer',
        ]);
        $this->edit_password = Hash::make($this->edit_password);
        $user = User::find($this->edit_id);
        $user->name = $this->edit_name;
        $user->email = $this->edit_email;
        $user->password = $this->edit_password;
        $user->department_id = $this->edit_department;
        $user->sub_department_id = $this->edit_position;
        $user->salary = $this->edit_salary;
        if ($user->save()) {
            $this->dispatchBrowserEvent('swal:edit_employes', [
                'icon' => 'success',
                'text' => 'Success! Employe record updated successfully.',
            ]);
        }
    }

    public function search()
    {
        if ($this->search != null) {
            $this->employe = User::where('name', 'LIKE', '%' . $this->search . '%')->with('department')->with('position')->get();
        } else {
            $this->employe = User::with('department')->with('position')->get();
        }
    }
    public function render()
    {
        return view('livewire.admin.admin-employe')->layout('layouts.admin-base');
    }
}
