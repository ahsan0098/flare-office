<div>
    <div class="row justify-content-center align-items-center g-2 m-0 p-0 bg-light">
        
        <section class="col-lg-8 connectedSortable" wire:poll="refreshing">
            
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary" wire:ignore.self>
                <div class="card-header bg-danger">
                    <h3 class="card-title">Private chat</h3>
                    <div class="card-tools">
                        
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                            <i class="fas fa-comments"></i>
                        </button>
                        
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body bg-slate-400">

                    <!-- Conversations are loaded here -->
                    <div class="p-3">
                        <!-- Message. Default to the left -->
                        
                        <div>
                            <?php if($chat != []): ?>
                                <div>
                                    <?php $__currentLoopData = $chat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div>
                                            <?php if($ct['sender']['id'] == $me): ?>
                                                <div class="direct-chat-msg right my-1 py-1">
                                                    <div class="direct-chat-infos clearfix">
                                                        <span
                                                            class="direct-chat-name float-left">You(<?php echo e($ct['sender']['name']); ?>)</span>
                                                        <span
                                                            class="direct-chat-timestamp float-right"><?php echo e($ct['created_at']); ?></span>
                                                    </div>
                                                    <!-- /.direct-chat-infos -->
                                                    <img class="direct-chat-img"
                                                        src="<?php echo e(asset('storage/employe_' . $ct['sender']['id'])); ?>/<?php echo e($ct['sender']['image']); ?>"
                                                        alt="">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="direct-chat-text bg-info py-3">
                                                        <?php echo e($ct['message']); ?>

                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>
                                            <?php else: ?>
                                                <div class="direct-chat-msg my-1 py-1">
                                                    <div class="direct-chat-infos clearfix">
                                                        <span
                                                            class="direct-chat-name float-left"><?php echo e($ct['sender']['name']); ?></span>
                                                        <span
                                                            class="direct-chat-timestamp float-right"><?php echo e($ct['created_at']); ?></span>
                                                    </div>
                                                    <!-- /.direct-chat-infos -->
                                                    <img class="direct-chat-img"
                                                        src="<?php echo e(asset('storage/employe_' . $ct['sender']['id'])); ?>/<?php echo e($ct['sender']['image']); ?>"
                                                        alt="">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="direct-chat-text bg-success py-3">
                                                        <?php echo e($ct['message']); ?>

                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                            <?php endif; ?>

                        </div>

                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                            
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="#" data-widget="chat-pane-toggle"
                                        wire:click="getChat(<?php echo e($user->id); ?>)">
                                        <img class="contacts-list-img"
                                            src="<?php echo e(asset('storage/employe_' . $user->id)); ?>/<?php echo e($user->image); ?>"
                                            alt="no image">

                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name">
                                                <?php echo e($user->name); ?>

                                                <small class="contacts-list-date float-right">2/28/2015</small>
                                            </span>
                                            <span class="contacts-list-msg">cvv</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            
                            <!-- End Contact Item -->
                        </ul>
                        <!-- /.contacts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <form action="#" method="post" wire:submit.prevent="sendMsg">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control"
                                wire:model="message">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-send-fill"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->

        </section>
    </div>
</div>
<!-- /.col -->
<?php /**PATH C:\xampp\htdocs\flare-office\resources\views/livewire/employe/employe-chat-room.blade.php ENDPATH**/ ?>