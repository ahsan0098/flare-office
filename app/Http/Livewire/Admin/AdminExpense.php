<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminExpense extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-expense')->layout("layouts.admin-base");
    }
}
