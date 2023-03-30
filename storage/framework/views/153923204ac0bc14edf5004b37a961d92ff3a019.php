<div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Left col -->
                    <?php if(is_array($dep) || is_object($dep)): ?>
                        <?php $__currentLoopData = $dep; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <!-- MAP & BOX PANE -->
                                <div class="card">
                                    <div class="card-header bg-success">
                                        <h3 class="card-title"><?php echo e($dp['name']); ?></h3>

                                        
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-3">
                                        <div class="d-md-flex">
                                            <div class="p-1 flex-fill" style="overflow: hidden">
                                                <!-- Map will be created here -->
                                                <div id="world-map-markers" style="height: 325px; overflow: hidden">
                                                    <div class="map">
                                                        <?php echo e($dp['description']); ?>

                                                        <br><br>
                                                        <?php $__currentLoopData = $dp['sub_department']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <span class="mx-3"><?php echo e($sub['name']); ?> :</span> <span
                                                                class="text-warning">6</span><br>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div><!-- /.d-md-flex -->
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <!-- /.col -->
                    <!-- /.col -->
                </div>
                <hr class="bg-primary my-3">
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-8">
                        <!-- MAP & BOX PANE -->
                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="card-title">Add Department</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="POST" action="" wire:submit.prevent="addDepartment" id="dept_form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Department Name</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter deparment name" wire:model="name">
                                        <?php $__errorArgs = ['name'];
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
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea class="form-control" id="exampleInputEmail1" placeholder="Enter description" rows="5" name="description"
                                            wire:model="description">
                                        </textarea>
                                        <?php $__errorArgs = ['description'];
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
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="col-md-4">
                        <!-- Info Boxes Style 2 -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Sub Department</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="" method="POST" wire:submit.prevent="addSubDepartment"
                                id="sub_dept_form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" name="sub_name" class="form-control"
                                            id="exampleInputEmail1" placeholder="Enter sub-deparment name"
                                            name="sub_name" wire:model="sub_name">
                                        <?php $__errorArgs = ['sub_name'];
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
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea type="description" class="form-control" id="exampleInputEmail1" placeholder="Enter description"
                                            name="sub_desc" rows="3" wire:model="sub_desc"></textarea>
                                        <?php $__errorArgs = ['sub_desc'];
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
                                        <label for="exampleInputEmail1">Main Department</label>
                                        <select name="sub_main" class="form-control" id="exampleInputEmail1"
                                            wire:model="sub_main">
                                            <option value="">Select Main department</option>
                                            <?php $__currentLoopData = $dep; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($dp['id']); ?>"><?php echo e($dp['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['sub_main'];
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
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.info-box -->

                        <!-- /.info-box -->
                        <!-- /.card -->

                        <!-- PRODUCT LIST -->

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
</div>
<?php /**PATH C:\xampp\htdocs\flare-office\resources\views/livewire/admin/admin-department.blade.php ENDPATH**/ ?>