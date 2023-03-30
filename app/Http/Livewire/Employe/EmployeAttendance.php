<?php

namespace App\Http\Livewire\Employe;

use Livewire\Component;
use App\Models\Attendance;

class EmployeAttendance extends Component
{
    public $total;
    public function mount()
    {
        $this->total = Attendance::where('employe_id', session('u_id'))->whereMonth('date', date('m'))->with('user')->get();
        $this->total = json_decode($this->total, true);
    }
    public function render()
    {
        return view('livewire.employe.employe-attendance')->layout('layouts.user-base');
    }
}
