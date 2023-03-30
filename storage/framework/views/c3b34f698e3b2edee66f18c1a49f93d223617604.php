<div>
    <!-- Modal -->
    <div class="modal fade" id="attendace_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter current attendance code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" wire:submit.prevent="attendance">
                        <input type="text" name="code" id="" wire:model="code" class="form-control"
                            placeholder="Enter code">
                        <?php if(Session::has('wrong')): ?>
                            <span class="text-danger"><?php echo e(session('wrong')); ?></span>
                        <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\flare-office\resources\views/livewire/admin/mark-attendance.blade.php ENDPATH**/ ?>