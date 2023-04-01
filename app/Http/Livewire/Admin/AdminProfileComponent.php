<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminProfileComponent extends Component
{
    use WithFileUploads;
    public $user;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $facebook;
    public $instagram;
    public $twitter;
    public $github;
    public $image_select;
    public $old_pass;
    public $new_pass;
    public $confirm_pass;
    public $test = "prepare";
    public $Foo;
    public $files = [];
    protected $listeners = ['upload_image' => 'upload_image'];
    public function mount()
    {
        $this->user = User::where('id', session('u_id'))->with('department')->with('position')->first();
        $this->test = $this->user->image;
        // $this->user = json_decode($this->user, true);
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/storage/employe_' . $this->user->id;
        if (file_exists($dir)) {

            $this->files = scandir($dir);

            foreach ($this->files as $index => $file) {
                if ($file === '..' || $file === '.') {
                    unset($this->files[$index]);
                }
            }
            $this->files = array_reverse($this->files);
            clearstatcache();
        }
    }
    public function loadUser()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->address = $this->user->address;
        $this->facebook = $this->user->facebook;
        $this->instagram = $this->user->instagram;
        $this->twitter = $this->user->twitter;
        $this->github = $this->user->github;
    }
    public function updatedFoo()
    {

        $ext = $this->Foo->extension();
        $exts = ['png', 'jpg', 'jpeg', 'gif', 'bmp', 'webp'];

        if (in_array($ext, $exts)) {
            $usr = User::find(session('u_id'));
            $imagename = Carbon::now()->timestamp . '.' . $this->Foo->extension();
            // WithFileUploads::saveDomDocument('users/employe_' . $this->user->id, $imagename);
            $this->Foo->storeAs('users/employe_' . $this->user->id, $imagename);
            $usr->image = $imagename;
            if ($usr->save()) {
                session('user')['image'] = $imagename;
            }
        } else {
            $this->dispatchBrowserEvent('swal:updatepassword', [
                'icon' => "error",
                'text' => "Upload file types (png, jpg, jpeg, gif, bmp, webp) only",
            ]);
        }
    }
    public function Refresher()
    {
        $this->user = User::where('id', session('u_id'))->with('department')->with('position')->first();
    }
    public function updateProfile()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'github' => 'required',
            'twitter' => 'required',
        ]);
        $employe = User::where('id', session('u_id'))->first();
        $employe->name = $this->name;
        $employe->email = $this->email;
        $employe->phone = $this->phone;
        $employe->address = $this->address;
        $employe->facebook = $this->facebook;
        $employe->github = $this->github;
        $employe->twitter = $this->twitter;
        $employe->instagram = $this->instagram;
        if ($employe->save()) {
            session('user')['name'] = $employe->name;
            $this->dispatchBrowserEvent('swal:updateProfile', [
                'icon' => "success",
                'text' => 'User profile updated successfully.',
            ]);
            $this->user = User::where('id', session('u_id'))->with('department')->with('position')->first();
        }
    }
    public function changePassword()
    {
        $this->validate([
            'old_pass' => 'required',
            'new_pass' => 'required',
            'confirm_pass' => 'required|same:new_pass',
        ]);
        // $user = User::where('id', session('u_id'))->with('department')->with('position')->first();
        $employe = User::where('id', session('u_id'))->first();
        $this->old_pass = md5($this->old_pass);
        $this->new_pass = md5($this->new_pass);
        if ($this->old_pass == $employe->password) {
            $employe = User::where('id', session('u_id'))->first();
            $employe->password = $this->new_pass;
            if ($employe->save()) {
                $this->test = "working";
                $this->dispatchBrowserEvent('swal:updatepassword', [
                    'icon' => "success",
                    'text' => 'Password updated successfully.',
                ]);
                $this->old_pass = "";
                $this->new_pass = "";
                $this->confirm_pass = "";
            }
        } else {
            $this->dispatchBrowserEvent('swal:updatepassword', [
                'icon' => "warning",
                'text' => 'Current password did not matched.',
            ]);
            $this->old_pass = "";
            $this->new_pass = "";
            $this->confirm_pass = "";
        }
    }
    public function render()
    {
        return view('livewire.admin.admin-profile-component')->layout('layouts.admin-base');
    }
}
