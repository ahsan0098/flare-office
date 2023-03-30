<div>
    <div class="row mx-1" wire:poll>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Role and permission assigned by super admin</h1>

                    <div class="card-tools">
                        <button class="btn btn-danger my-0" data-toggle="modal" data-target="#exampleModal">Add
                            role</button>
                        <button class="btn btn-warning my-0" data-toggle="modal" data-target="#addpermission">Add
                            permission</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                        // echo '<pre>';
                        // print_r($all_permissions);
                        $i = 0;
                    ?>
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID<?php echo e($test); ?></th>
                                <th>Name</th>
                                <th>Permission Name</th>
                                <th>View</th>
                                <th>Add</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div>
                                <?php $__currentLoopData = $role_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role => $admin_role_permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(++$i); ?></td>
                                        <td><strong><?php echo e(Str::ucfirst($role)); ?></strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a class="btn btn-success my-0"
                                                href="<?php echo e(route('permission-management', ['role_name' => $role])); ?>"><i
                                                    class="bi bi-pencil-square text-white"></i></a></td>
                                    </tr>
                                    <div>
                                        <?php $__currentLoopData = $admin_role_permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission_for_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><?php echo e(Str::ucfirst($permission_for_role['permission']['name'])); ?></td>
                                                <td><?php if($permission_for_role['perm_view']){?> <i
                                                        class="fas fa-check text-success"></i></button></td>
                                                <?php } elseif (!$permission_for_role['perm_view']){ ?>
                                                <i class="fa fa-times text-danger" aria-hidden="true"></i></button></td>
                                                <?php } ?>
                                                </td>
                                                <td><?php if($permission_for_role['perm_add']){?> <i
                                                        class="fas fa-check text-success"></i></button></td>
                                                <?php } elseif (!$permission_for_role['perm_add']){ ?>
                                                <i class="fa fa-times text-danger" aria-hidden="true"></i></button></td>
                                                <?php } ?></td>
                                                <td><?php if($permission_for_role['perm_edit']){?> <i
                                                        class="fas fa-check text-success"></i></button></td>
                                                <?php } elseif (!$permission_for_role['perm_edit']){ ?>
                                                <i class="fa fa-times text-danger" aria-hidden="true"></i></button></td>
                                                <?php } ?></td>
                                                <td><?php if($permission_for_role['perm_delete']){?> <i
                                                        class="fas fa-check text-success"></i></button></td>
                                                <?php } elseif (!$permission_for_role['perm_delete']){ ?>
                                                <i class="fa fa-times text-danger" aria-hidden="true"></i></button></td>
                                                <?php } ?></td>
                                                <td></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
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
    <!-- /.row -->
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">New User Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent="addrole">
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="col-form-label" for="inputSuccess"> Enter role name</label>
                                    <input type="text" wire:model="newrole" name='newrole'class="form-control"
                                        placeholder="Enter ...">
                                    <?php $__errorArgs = ['newrole'];
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addpermission" tabindex="-1" role="dialog" aria-labelledby="addpermissionLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="addpermissionLabel">New User Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent="addpermission">
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="col-form-label" for="inputSuccess"> Enter role name</label>
                                    <input type="text" wire:model="newpermission"
                                        name='newpermission'class="form-control" placeholder="Enter ...">
                                    <?php $__errorArgs = ['newpermission'];
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
                                <div class="row justify-content-center align-items-center g-2">
                                    <div class="col">Viewable</div>
                                    <div class="col">Addable</div>
                                    <div class="col">Editable</div>
                                    <div class="col">Deletable</div>
                                </div>
                                <div class="row justify-content-center align-items-center g-2">
                                    <div class="col"><input type="checkbox" wire:model="view" class="form-check">
                                    </div>
                                    <div class="col"><input type="checkbox" wire:model="add" class="form-check">
                                    </div>
                                    <div class="col"><input type="checkbox" wire:model="edit" class="form-check">
                                    </div>
                                    <div class="col"><input type="checkbox" wire:model="del" class="form-check">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\flare-office\resources\views/livewire/admin/admin-roles-and-permissions.blade.php ENDPATH**/ ?>