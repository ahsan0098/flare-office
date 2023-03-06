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
    public $option;
    public $search;
    public $random = "sadss";
    public $total;
    protected $listeners = ['marked' => 'marked', 'search_attend' => 'search_attend'];
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
    public function marked()
    {
        // $this->current = "marked";
        $this->total = Attendance::with('user')->where('date', date('y-m-d'))->get();
        $this->total = json_decode($this->total, true);
        // $this->dispatchBrowserEvent('btn-show');
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
    public function update_attendance()
    {
        $this->total = Attendance::where('date', $this->search)->with('user')->get();
        $this->total = json_decode($this->total, true);
    }
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
