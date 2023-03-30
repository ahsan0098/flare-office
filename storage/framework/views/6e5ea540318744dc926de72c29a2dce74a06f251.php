<div>
    <div class="login-box" style="">
        <div class="login-logo">
            <a href="" wire:click.prevent="Login"><b>Software Flare</b><small> Ltd</small></a>
            <?php if(Session::has('failed')): ?>
            <div class="alert alert-danger"><?php echo e(session()->get('failed')); ?></div>
            <?php endif; ?>
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
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" wire:model="password" class="form-control"
                            id="exampleInputPassword1" placeholder="Password">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
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
<?php /**PATH C:\xampp\htdocs\flare-office\resources\views/livewire/login-form.blade.php ENDPATH**/ ?>