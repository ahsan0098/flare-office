<div>
    <div class="px-3" wire:poll>
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card">
                    
                    <div class="card-header" wire:poll>
                        <h3 class="card-title">Employes Table</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search" wire:model="search" id="search_btn">

                                <div class="input-group-append mr-2">
                                    <button type="button" wire:click.prevent="search" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-default btn-primary px-2"
                                        wire:click.prevent="checkPermission('user','add','#add_employe')">
                                        <i class="bi bi-person-plus-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0 table_card_view" wire:igonre.self>
                        
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Salary</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th>Joining date</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <div>
                                    <?php $__currentLoopData = $employe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="<?= $emp->status ? '' : 'text-warning' ?>">
                                            <td style="text-align: center; vertical-align:middle;"
                                                style="text-align: center; vertical-align:middle;">
                                                <?php if($emp->image): ?>
                                                    <img src="<?php echo e(asset('storage/employe_' . $emp->id) . '/' . $emp->image); ?>"
                                                        class="mig img-circle elevation-2" alt="User Image"
                                                        width="50" height="50">
                                                <?php else: ?>
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                                        class="mig img-circle elevation-2" alt="User Image"
                                                        width="50" height="50">
                                                <?php endif; ?>
                                            </td>
                                            <td style="text-align: center; vertical-align:middle;"><?php echo e($emp->name); ?>

                                            </td>
                                            <td style="text-align: center; vertical-align:middle;"><?php echo e($emp->email); ?>

                                            </td>
                                            <td style="text-align: center; vertical-align:middle;"><?php echo e($emp->salary); ?>

                                            </td>
                                            <td style="text-align: center; vertical-align:middle;">
                                                <?php echo e($emp->department->name); ?></td>
                                            <td style="text-align: center; vertical-align:middle;">
                                                <?php echo e($emp->position->name); ?></td>
                                            <td style="text-align: center; vertical-align:middle;">
                                                <?php echo e($emp->created_at->format('Y-m-d')); ?></td>
                                            
                                            <td style="text-align: center; vertical-align:middle;"><a href=""
                                                    wire:click.prevent="Edit(<?php echo e($emp->id); ?>)"><i
                                                        class="bi bi-pencil-square text-success"></i></a>&nbsp;&nbsp;<a
                                                    href=""
                                                    wire:click.prevent="deactivate(<?php echo e($emp->id); ?>)"><?= $emp->status
                                                        ? '<i
                                                        class="bi bi-person-dash-fill text-warning"></i>'
                                                        : '<i
                                                        class="bi bi-person-plus-fill text-primary"></i>' ?></a>&nbsp;&nbsp;<a
                                                    href=""
                                                    wire:click.prevent="choseDelete(<?php echo e($emp->id); ?>)"><i
                                                        class="bi
                                                    bi-trash-fill text-danger"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </tbody>
                        </table>
                        
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="modal fade" id="add_employe" tabindex="-1" role="dialog" aria-labelledby="add_employeLabel"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <div class="modal-content align self-center" style="width: 600px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add_employeLabel">Register new employe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-primary">
                            <div class="card-body">
                                <form wire:submit.prevent="addEmploye">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input type="text" name="emp_name" wire:model="emp_name"
                                                    class="form-control" id="exampleInputEmail1"
                                                    placeholder="Enter name">
                                                <?php $__errorArgs = ['emp_name'];
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
                                            <!-- /.form-group -->
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-6">

                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" name="emp_mail"
                                                    wire:model="emp_email" id="exampleInputEmail1"
                                                    placeholder="Enter email">
                                                <?php $__errorArgs = ['emp_email'];
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
                                            <!-- /.form-group -->
                                        </div>

                                        <!-- /.col -->
                                        <div class="col-md-6">

                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <input type="text" class="form-control" name="emp_password"
                                                    wire:model="emp_password" id="exampleInputEmail1"
                                                    placeholder="Enter password">
                                                <?php $__errorArgs = ['emp_password'];
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
                                            <!-- /.form-group -->
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Deparment</label>
                                                <select class="form-control select2" style="width: 100%;"
                                                    name="emp_department" wire:model="emp_department"
                                                    wire:click="changeEvent($event.target.value)">
                                                    <option selected="selected">Select</option>
                                                    <div>
                                                        <?php $__currentLoopData = $deps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($dp->id); ?>"><?php echo e($dp->name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </select>
                                                <?php $__errorArgs = ['emp_department'];
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Position</label>
                                                <select class="form-control select2" style="width: 100%;"
                                                    name="emp_position" wire:model="emp_position">
                                                    <option selected="selected"></option>
                                                    <div>
                                                        <?php $__currentLoopData = $sub_deps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($sd->id); ?>"><?php echo e($sd->name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </select>
                                                <?php $__errorArgs = ['emp_position'];
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
                                        <div class="col-md-6">

                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Salary</label>
                                                <input type="text" class="form-control" name="emp_salary"
                                                    wire:model="emp_salary" id="exampleInputEmail1"
                                                    placeholder="Enter salary">
                                                <?php $__errorArgs = ['emp_salary'];
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
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.row -->
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"
                                style="justify-content: flex-start">Regiter</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit_employe" tabindex="-1" role="dialog" aria-labelledby="edit_employeLabel"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <div class="modal-content align self-center" style="width: 600px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_employeLabel">Register new employe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-primary">
                            <div class="card-body">
                                <form wire:submit.prevent="UpdateEmploye">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input type="text" name="edit_name" wire:model="edit_name"
                                                    class="form-control" id="exampleInputEmail1"
                                                    placeholder="Enter name">
                                                <?php $__errorArgs = ['edit_name'];
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
                                            <!-- /.form-group -->
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-6">

                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" name="edit_mail"
                                                    wire:model="edit_email" id="exampleInputEmail1"
                                                    placeholder="Enter email">
                                                <?php $__errorArgs = ['edit_email'];
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
                                            <!-- /.form-group -->
                                        </div>

                                        <!-- /.col -->
                                        <div class="col-md-6">

                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <input type="text" class="form-control" name="edit_password"
                                                    wire:model="edit_password" id="exampleInputEmail1"
                                                    placeholder="Enter password">
                                                <?php $__errorArgs = ['edit_password'];
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
                                            <!-- /.form-group -->
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Deparment</label>
                                                <select class="form-control select2" style="width: 100%;"
                                                    name="edit_department" wire:model="edit_department"
                                                    wire:click="changeEvent($event.target.value)">
                                                    <option selected="selected" value="">Select</option>
                                                    <div>
                                                        <?php $__currentLoopData = $deps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($dp->id); ?>"><?php echo e($dp->name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </select>
                                                <?php $__errorArgs = ['edit_department'];
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Position</label>
                                                <select class="form-control select2" style="width: 100%;"
                                                    name="edit_position" wire:model="edit_position">
                                                    
                                                    <div>
                                                        <?php $__currentLoopData = $sub_deps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($edit_position == $sd->id): ?>
                                                                <option selected value="<?php echo e($sd->id); ?>">
                                                                    <?php echo e($sd->name); ?>

                                                                </option>
                                                            <?php else: ?>
                                                                <option value="<?php echo e($sd->id); ?>">
                                                                    <?php echo e($sd->name); ?>

                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </select>
                                                <?php $__errorArgs = ['edit_position'];
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
                                        <div class="col-md-6">

                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Salary</label>
                                                <input type="text" class="form-control" name="edit_salary"
                                                    wire:model="edit_salary" id="exampleInputEmail1"
                                                    placeholder="Enter salary">
                                                <?php $__errorArgs = ['edit_salary'];
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
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.row -->
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary text-center"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"
                                style="justify-content: flex-start !important">Regiter</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php /**PATH C:\xampp\htdocs\flare-office\resources\views/livewire/admin/admin-employe.blade.php ENDPATH**/ ?>