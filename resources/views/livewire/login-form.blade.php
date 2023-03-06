<div>
    <div class="login-box" style="">
        <div class="login-logo">
            <a href="" wire:click.prevent="Login"><b>Software Flare</b><small> Ltd</small></a>
            @if (Session::has('failed'))
            <div class="alert alert-danger">{{ session()->get('failed') }}</div>
            @endif
        </div>
        <!-- /.login-logo -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Login Form</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" wire:submit.prevent="Login">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" wire:model="email" class="form-control"
                            id="exampleInputEmail1" placeholder="Enter email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" wire:model="password" class="form-control"
                            id="exampleInputPassword1" placeholder="Password">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> --}}
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
