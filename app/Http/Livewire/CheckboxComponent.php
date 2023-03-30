<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CheckboxComponent extends Component
{
    public $permission;
    public $inputs = [];
    public $Foo = false;
    public $type;
    public $test = 'test';
    public function mount($permission, $inputs, $type)
    {
        $this->permission = $permission;
        $this->inputs = $inputs;
        $this->type = $type;
        if ($inputs != null && array_key_exists($permission['id'], $inputs)) {
            if (array_key_exists($this->type, $inputs[$permission['id']])) {
                if ($inputs[$permission['id']][$this->type]) {
                    $this->Foo = true;
                } else {
                    $this->Foo = false;
                }
            }
        }
    }
    public function updatedFoo()
    {
        $this->emit('inputreceived', $this->permission['id'], [$this->type => $this->Foo]);
    }
    public function render()
    {
        return view('livewire.checkbox-component');
    }
}
