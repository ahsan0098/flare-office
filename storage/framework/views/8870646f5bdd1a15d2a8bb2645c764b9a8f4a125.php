<div>
    <div class="row justify-content-center align-items-center g-2 m-0 p-0" wire:poll>
        

        
        <div class="col-lg-8">
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-warning">
                <div class="card-header  bg-primary">
                    <h3 class="card-title">Public Chat</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="background-color: white !important;">
                    <!-- Conversations are loaded here -->
                    <div class="p-3">
                        <!-- Message. Default to the left -->
                        <div>
                            <?php $__currentLoopData = $public_chat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $public): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div>
                                    <?php if($public->sender->id = $me): ?>
                                        <div class="direct-chat-msg right my-1 py-1">
                                            <div class="direct-chat-infos clearfix">
                                                <span
                                                    class="direct-chat-name float-left"><?php echo e($public->sender->name); ?></span>
                                                <span
                                                    class="direct-chat-timestamp float-right"><?php echo e($public->created_at); ?></span>
                                            </div>
                                            <!-- /.direct-chat-infos -->
                                            <img class="direct-chat-img"
                                                src="<?php echo e(asset('storage/employe_' . $public->sender->id)); ?>/<?php echo e($public->sender->image); ?>"
                                                alt="message user image">
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text py-3">
                                                <?php echo e($public->message); ?>

                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                    <?php else: ?>
                                        <div class="direct-chat-msg my-1 py-1">
                                            <div class="direct-chat-infos clearfix">
                                                <span
                                                    class="direct-chat-name float-left"><?php echo e($public->sender->name); ?></span>
                                                <span
                                                    class="direct-chat-timestamp float-right"><?php echo e($public->created_at); ?></span>
                                            </div>
                                            <!-- /.direct-chat-infos -->
                                            <img class="direct-chat-img"
                                                src="<?php echo e(asset('storage/employe_' . $public->sender->id)); ?>/<?php echo e($public->sender->image); ?>">
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text py-3">
                                                <?php echo e($public->message); ?>

                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!-- /.direct-chat-msg -->

                        <!-- Message to the right -->
                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->

                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="background-color:beige !important;">
                    <form action="" wire:submit.prevent="publicSend">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control"
                                wire:model="public_message">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-warning"><i class="bi bi-send-fill"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
        </div>
    </div>
</div>
<!-- /.col -->
<?php /**PATH C:\xampp\htdocs\flare-office\resources\views/livewire/admin/admin-public-chat.blade.php ENDPATH**/ ?>