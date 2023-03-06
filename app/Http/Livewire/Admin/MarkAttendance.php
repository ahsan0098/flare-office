<?php

namespace App\Http\Livewire\Admin;

use App\Models\Attendance;
use App\Models\Randomizer;
use App\Models\User;
use Livewire\Component;

class MarkAttendance extends Component
{
    public $code;
    protected $listeners = ['loader' => 'loader'];
    public function attendance()
    {
        $verify = Randomizer::orderBy('id', 'DESC')->first();
        if ($this->code == $verify->code) {
            $atndc = new Attendance;
            $atndc->employe_id = session()->get('u_id');
            $atndc->date = date('y-m-d');
            $atndc->attendance = "present";
            $atndc->attendance_code = $this->code;
            if ($atndc->save()) {
                $this->emit('marked');
                $this->dispatchBrowserEvent('attendance');
            }
        } else {
            session()->flash('wrong', 'This code is not correct');
        }
    }
    public function loader()
    {
        // $usr = User::find(session()->get('u_id'));
        // $usr = $usr->
        $t = date('y-m-d');
        $atend = Attendance::where('employe_id', session()->get('u_id'))->where('date', $t)->first();
        if (!$atend) {
            $this->dispatchBrowserEvent('btn-show');
        }
    }
    public function mount()
    {
        // $this->dispatchBrowserEvent('btn-show');

    }
    public function render()
    {
        // $t = date('y-m-d');
        // $atend = Attendance::where('employe_id', session()->get('u_id'))->where('date', $t)->first();
        // if (!$atend) {
        //     $this->dispatchBrowserEvent('btn-show');
        // }
        return view('livewire.admin.mark-attendance');
    }
}
