<?php

namespace App\Http\Livewire\Admin;

use App\Models\department;
use App\Models\subdepartment;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class AdminDepartment extends Component
{
    public $dep = "sdsffsdfasdddfsfS";
    // public $dep_name = "seo";
    // public $dep_desc = "test";
    public $name;
    public $description;
    public $sub_name;
    public $sub_desc;
    public $sub_main;
    public function mount()
    {
        // $member = User::where('dep_id','')->count();
        $this->dep = department::with('subDepartment')->get();
        // foreach($this->dep as $dp){
        //     $sub = subdepartment::where('dep_id', $dp->id)->get();
        //     $dp->subdeps =
        // }
        $this->dep = json_decode($this->dep, true);
    }
    public function addDepartment()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required|min:6',
        ]);
        $dep = new department;
        $dep->name = $this->name;
        $dep->description = $this->description;
        if ($dep->save()) {
            $this->dispatchBrowserEvent('swal:message', [
                'icon' => 'success',
                'text' => 'Success! Department added successfully.',
            ]);
        }
    }
    public function addSubDepartment()
    {
        $this->validate([
            'sub_name' => 'required',
            'sub_desc' => 'required|min:6',
            'sub_main' => 'required',
        ]);
        $dep = new subdepartment;
        $dep->name = $this->sub_name;
        $dep->description = $this->sub_desc;
        $dep->dep_id = $this->sub_main;
        if ($dep->save()) {
            $this->dispatchBrowserEvent('swal:message', [
                'icon' => 'success',
                'text' => 'Success! Sub Department added successfully.',
            ]);
        }
    }
    public function render()
    {
        return view('livewire.admin.admin-department')->layout('layouts.admin-base');
    }
}
