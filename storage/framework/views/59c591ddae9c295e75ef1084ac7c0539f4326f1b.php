<div>
    <div wire:poll>
        <div class="px-3">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo e($current); ?></h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 450px;">
                                    
                                    <select name="" id="" wire:model="option">
                                        <option value="">Select type</option>
                                        <option value="date">search by date</option>
                                        <option value="employe">search by employe</option>
                                        <option value="month">seaech by month</option>
                                    </select>
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search" wire:model="search" id="search_attend">
                                    <div class="input-group-append mr-2">
                                        <button type="button" class="btn btn-default btn-primary px-2"
                                            wire:click.prevent="search_attend">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default btn-success px-2"
                                            data-toggle="modal" data-target="#generate_code">
                                            Attendance Token
                                            
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Attendance</th>
                                        <th>Date</th>
                                        <th><button type="button" class="btn btn-danger"
                                                wire:click.prevent="Initiate">Initiate Attendance</button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div>
                                        <?php $__currentLoopData = $total; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>image</td>
                                                <td><?php echo e($tot['user']['name']); ?></td>
                                                <td><?php echo e($tot['user']['email']); ?></td>
                                                
                                                <div>
                                                    
                                                    <td><?= $tot['attendance'] == 'present' ? '<span class="bg-success p-1 rounded">' . $tot['attendance'] . '</span>' : '' ?>
                                                        <?= $tot['attendance'] == 'absent' ? '<span class="bg-danger p-1 rounded">' . $tot['attendance'] . '</span>' : '' ?>
                                                        <?= $tot['attendance'] == 'leave' ? '<span class="bg-warning p-1 rounded">' . $tot['attendance'] . '</span>' : '' ?>
                                                    </td>
                                                    <td><?php echo e($tot['date']); ?></td>
                                                    
                                                </div>
                                                
                                                
                                                
                                                <td><input class="ml-5 bg-success rdo" type="radio"
                                                        name="mark-<?php echo e($tot['id']); ?>" id="mark-<?php echo e($tot['id']); ?>"
                                                        value="present" data-id="<?php echo e($tot['employe_id']); ?>"
                                                        data-att="<?php echo e($tot['id']); ?>">
                                                    <input class="bg-success rdo" type="radio"
                                                        name="mark-<?php echo e($tot['id']); ?>" id="mark-<?php echo e($tot['id']); ?>"
                                                        value="absent" data-id="<?php echo e($tot['employe_id']); ?>"
                                                        data-att="<?php echo e($tot['id']); ?>">
                                                    <input class="bg-success rdo" type="radio"
                                                        name="mark-<?php echo e($tot['id']); ?>" id="mark-<?php echo e($tot['id']); ?>"
                                                        value="leave" data-id="<?php echo e($tot['employe_id']); ?>"
                                                        data-att="<?php echo e($tot['id']); ?>">
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
            <div class="modal fade" id="generate_code" tabindex="-1" role="dialog"
                aria-labelledby="generate_codeLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog" role="document">
                    <div class="modal-content align self-center" style="width: 600px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="generate_codeLabel">Attendance Code</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="p-3">
                                <p type="text" name="random" class="form-control"><?php
                                    print_r($random);
                                ?>
                                </p>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary"
                                        wire:click.prevent="randomize">Randomize</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
<?php /**PATH C:\xampp\htdocs\flare-office\resources\views/livewire/admin/admin-attendance.blade.php ENDPATH**/ ?>