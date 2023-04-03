<div>
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                            <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
            {{-- @php
                echo '<pre>';
                print_r($user);
            @endphp --}}

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <div class="uploadimg">
                                <div>
                                    @if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/storage/employe_' . $user->id . '/' . $user->image))
                                        <div>
                                            @if ($user->image)
                                                <img src="{{ asset('storage/employe_' . $user->id) }}/{{ $user->image }}"
                                                    alt="avatar" class="img-fluid changeprofile" style="width: 150px;"
                                                    wire:ignore.self>
                                            @else
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                                    alt="avatar" class="rounded-circle img-fluid"
                                                    style="width: 150px;">
                                            @endif
                                        </div>
                                    @else 
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                            alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                    @endif
                                </div>
                                <button id="upload_image" class="ml-0"><i class="bi bi-camera-fill "
                                        style="font-size: 50px;"></i></button>
                                <input class="image_select" wire:model="Foo" type="file" name="image_select"
                                    id="image_select" hidden>

                            </div>
                            <h5 class="my-3">{{ Str::ucfirst($user->name) }}</h5>

                            <p class="text-muted mb-1">{{ Str::ucfirst($user->position->name) }} from the department of
                                {{ Str::ucfirst($user->department->name) }}</p>

                            <div class="d-flex justify-content-center mb-2">
                                {{-- <button type="button" class="btn btn-primary">Follow</button> --}}
                                <button type="button" class="btn btn-outline-primary ms-1" data-toggle="modal"
                                    data-target="#edit_profile_modal" wire:click.prevent="loadUser">Edit
                                    profile</button>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fas fa-globe fa-lg text-warning"></i>
                                    <p class="mb-0">Social Links</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                                    <p class="mb-0">{{ $user->github }}</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                    <p class="mb-0">{{ $user->twitter }}</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                    <p class="mb-0">{{ $user->instagram }}</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                    <p class="mb-0">{{ $user->facebook }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Str::ucfirst($user->name) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->phone }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Department</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Str::ucfirst($user->department->name) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Current position</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Str::ucfirst($user->position->name) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Joining date</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->created_at->format('y/m/d') }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Change your password</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form class="form-horizontal" wire:submit.prevent="changePassword">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Current
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="old_pass" wire:model="old_pass"
                                                    class="form-control" id="inputEmail3"
                                                    placeholder="Your current password">
                                                @error('old_pass')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">New
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="new_pass" wire:model="new_pass"
                                                    class="form-control" id="inputPassword3"
                                                    placeholder="New Password">
                                                @error('new_pass')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="confirm_pass" wire:model="confirm_pass"
                                                    class="form-control" id="inputPassword3"
                                                    placeholder="Confirm new Password">
                                                @error('confirm_pass')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        {{-- <button type="submit" class="btn btn-info">Sign in</button> --}}
                                        <button type="submit" class="btn btn-info float-right">Submit</button>
                                    </div>
                                    <!-- /.card-footer -->
                                </form>
                            </div>
                            <!-- /.card -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="edit_profile_modal" tabindex="-1" role="dialog"
        aria-labelledby="edit_profile_modalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" style="width: 2000px !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_profile_modalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-lg-3">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" wire:model="name" class="form-control">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" wire:model="email" class="form-control"
                                            placeholder="example@abc.com">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" wire:model="phone" class="form-control"
                                            placeholder="12345678981">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" wire:model="address"
                                            class="form-control" placeholder="your address">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input type="text" name="facebook" wire:model="facebook"
                                            class="form-control" placeholder="http://facebook.com">
                                        @error('facebook')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Instagram</label>
                                        <input type="text" name="instagram" wire:model="instagram"
                                            class="form-control" placeholder="http://instagram.com">
                                        @error('instagram')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>twitter</label>
                                        <input type="text" name="twitter" wire:model="twitter"
                                            class="form-control" placeholder="http://twitter.com">
                                        @error('twitter')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Github</label>
                                        <input type="text" name="github" wire:model="github"
                                            class="form-control" placeholder="http://github.com">
                                        @error('github')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary"
                                        wire:click.prevent="updateProfile">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!------ Include the above in your HEAD tag ---------->

    <!-- Gallery -->
    <!-- Gallery -->
    <div class="text-center my-1">
        <h1>Photo Gallery</h1>
    </div>
    <div class="row">
        @foreach ($files as $file)
            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="{{ asset('storage/employe_' . $user->id) }}/{{ $file }}"
                    class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" />

                {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain1.webp"
                    class="w-100 shadow-1-strong rounded mb-4" alt="Wintry Mountain Landscape" /> --}}
            </div>
        @endforeach
    </div>
    <!-- Gallery -->
</div>
