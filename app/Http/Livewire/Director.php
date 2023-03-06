<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Director extends Component
{
    public function mount()
    {
        if (auth()->user()) {
            if (auth()->user('utype') === 'ADM') {
                return redirect()->route('adminDashboard');
            }
            if (auth()->user('utype') === 'EMP') {
                return redirect()->route('EmployeDashboard');
            }
        } else {
            return redirect()->route('login');
        }
    }
    public function render()
    {
        return view('livewire.director');
    }
}
