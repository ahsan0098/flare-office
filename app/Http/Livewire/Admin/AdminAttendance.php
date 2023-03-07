<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Randomizer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminAttendance extends Component
{
    public $current;
    public $radio;
    public $option;
    public $search;
    public $random;
    public $total;
    public $test = [];
    protected $listeners = ['marked' => 'marked', 'search_attend' => 'search_attend', 'radio_attendance' => 'radio_attendance'];
    public function mount()
    {
        // $t = time();
        // echo($t . "<br>");
        // $this->random = date('Y/m/d H:i:s');
        $this->random = DB::table('randomizer')->orderBy('id', 'DESC')->first();
        $this->random = $this->random->code;
        $this->current = "Today's Attendance Sheet";
        $this->total = Attendance::with('user')->where('date', date('y-m-d'))->get();
        $this->total = json_decode($this->total, true);
    }
    public function radio_attendance($rdo, $valu, $id)
    {
        // $this->current = $valu;
        $atndc = Attendance::find($id);
        if ($atndc) {
            $atndc->id = $id;
            $atndc->employe_id = $rdo;
            $atndc->date = date('y-m-d');
            $atndc->attendance = $valu;
            $atndc->attendance_code = $this->random;
            if ($atndc->save()) {
                $this->marked();
            }
        } else {
            $this->current = "edfsdfd";
        }
    }
    public function Initiate()
    {
        $user = User::where('id', '!=', session('u_id'))->get();
        foreach ($user as $usr) {
            $atndc = Attendance::where('employe_id', $usr->id)->where('date', date('y-m-d'))->first();
            if (!$atndc) {
                $attend = new Attendance;
                $attend->employe_id = $usr->id;
                $attend->date = date('y-m-d');
                $attend->attendance = "absent";
                $attend->attendance_code = $this->random;
                $attend->save();
            }
        }
        $this->marked();
    }
    public function marked()
    {
        $this->total = Attendance::with('user')->where('date', date('y-m-d'))->get();
        $this->total = json_decode($this->total, true);
    }
    public function search_attend()
    {
        // $this->current = $this->option;
        if ($this->option != '') {
            if ($this->search != '') {
                // $search = $this->search;
                if ($this->option == 'date') {
                    $this->current = "search by Date";
                    $this->total = Attendance::where('date', $this->search)->with('user')->get();
                    $this->total = json_decode($this->total, true);
                }
                if ($this->option == 'employe') {
                    $this->current = "search by Employe";
                    $this->total = Attendance::where('employe_id', $this->search)->with('user')->get();
                    $this->total = json_decode($this->total, true);
                }
                if ($this->option == 'month') {
                    $this->current = "search by Month";
                    $this->total = Attendance::whereMonth('date', $this->search)->with('user')->get();
                    $this->total = json_decode($this->total, true);
                }
            } else {
                $this->total = User::with('attendance')->get();
                $this->total = json_decode($this->total, true);
            }
        } else {
        }
    }
    // public function update_attendance()
    // {
    //     $this->total = Attendance::where('date', $this->search)->with('user')->get();
    //     $this->total = json_decode($this->total, true);
    // }
    public function randomize()
    {
        $code = rand(100000, 999999);
        $rand = new Randomizer;
        $rand->code = $code;
        if ($rand->save()) {
            $this->random = $code;
        }
    }
    public function render()
    {

        return view('livewire.admin.admin-attendance')->layout('layouts.admin-base');
    }
}
