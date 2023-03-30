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
            $atndc = Attendance::where('date', date('y-m-d'))->firstOrNew(['employe_id' => session('u_id')]);
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
        $atend = Attendance::where('employe_id', session()->get('u_id'))->where('date', date('y-m-d'))->first();
        if (!$atend || $atend->attendance == "absent") {
            $this->dispatchBrowserEvent('btn-show');
        } else {
            $this->dispatchBrowserEvent('btn-fade');
            $this->emit('marked');
        }
    }
    public function mount()
    {
        // $this->dispatchBrowserEvent('btn-show');

    }
    public function render()
    {
        $t = date('y-m-d');
        $atend = Attendance::where('employe_id', session()->get('u_id'))->where('date', $t)->first();
        if (!$atend) {
            $this->dispatchBrowserEvent('btn-show');
        }
        return view('livewire.admin.mark-attendance');
    }
}
