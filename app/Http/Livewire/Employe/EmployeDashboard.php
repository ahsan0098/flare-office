<?php

namespace App\Http\Livewire\Employe;

use Livewire\Component;

class EmployeDashboard extends Component
{
    public function render()
    {
        return view('livewire.employe.employe-dashboard')->layout('layouts.user-base');
    }
}
