<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginForm extends Component
{
    public $test = "test";
    public $email;
    public $password;
    public function Login()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $this->password = md5($this->password);
        $user = User::where('email', $this->email)->where('password', $this->password)->where('status', 1)->with('role')->first();
        if ($user) {
            session()->put('u_id', $user->id);
            session()->put('user', $user);
            $this->test = 'done';
            $this->email = '';
            $this->password = '';
            if ($user->utype == "ADM") {
                session()->put('utype', 'ADM');
                return redirect()->route('adminDashboard');
            }
            if ($user->utype == "EMP") {
                session()->put('utype', 'EMP');
                return redirect()->route('employeDashboard');
            }
        } else {
            $this->password = '';
            $this->dispatchBrowserEvent('swal:toast', [
                'icon' => "error",
                'title' => 'current password did not matched.',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.login-form')->layout('layouts.login-base');
    }
}
