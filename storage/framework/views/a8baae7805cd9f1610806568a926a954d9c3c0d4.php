<div>
    <div class="row justify-content-center align-items-center g-2 mx-5">
        <div class="card card-primary mx-1" style="width: 100%;">
            <?php
                // echo '<pre>';
                // print_r($input);
            ?>
            <!-- /.card-header -->
            <!-- form start -->
            <form wire:submit.prevent="set_permissions()">
                <div class="card-body">
                    
                    <div class="row justify-content-center align-items-center g-2 font-weight-bolder text-primary">
                        <div class="justify-content-center align-items-center my-1 col-lg-4">Permission</div>
                        <div class="justify-content-center align-items-center my-1 col-lg-2">View</div>
                        <div class="justify-content-center align-items-center my-1 col-lg-2">Add</div>
                        <div class="justify-content-center align-items-center my-1 col-lg-2">Edit</div>
                        <div class="justify-content-center align-items-center my-1 col-lg-2">Delete</div>
                    </div>
                    <div>
                        <?php $__currentLoopData = $all_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-lg-4 my-1"><?php echo e(Str::ucfirst($perm['name'])); ?></div>
                                <div class="col-lg-2 justify-content-center align-items-center my-1">
                                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('checkbox-component', ['permission' => $perm, 'inputs' => $inputs, 'type' => 'perm_view'])->html();
} elseif ($_instance->childHasBeenRendered('perm_view' . $perm['id'])) {
    $componentId = $_instance->getRenderedChildComponentId('perm_view' . $perm['id']);
    $componentTag = $_instance->getRenderedChildComponentTagName('perm_view' . $perm['id']);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('perm_view' . $perm['id']);
} else {
    $response = \Livewire\Livewire::mount('checkbox-component', ['permission' => $perm, 'inputs' => $inputs, 'type' => 'perm_view']);
    $html = $response->html();
    $_instance->logRenderedChild('perm_view' . $perm['id'], $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                                </div>
                                <div class="col-lg-2 justify-content-center align-items-center my-1">
                                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('checkbox-component', ['permission' => $perm, 'inputs' => $inputs, 'type' => 'perm_add'])->html();
} elseif ($_instance->childHasBeenRendered('perm_add' . $perm['id'])) {
    $componentId = $_instance->getRenderedChildComponentId('perm_add' . $perm['id']);
    $componentTag = $_instance->getRenderedChildComponentTagName('perm_add' . $perm['id']);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('perm_add' . $perm['id']);
} else {
    $response = \Livewire\Livewire::mount('checkbox-component', ['permission' => $perm, 'inputs' => $inputs, 'type' => 'perm_add']);
    $html = $response->html();
    $_instance->logRenderedChild('perm_add' . $perm['id'], $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                                </div>
                                <div class="col-lg-2 justify-content-center align-items-center my-1">
                                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('checkbox-component', ['permission' => $perm, 'inputs' => $inputs, 'type' => 'perm_edit'])->html();
} elseif ($_instance->childHasBeenRendered('perm_edit' . $perm['id'])) {
    $componentId = $_instance->getRenderedChildComponentId('perm_edit' . $perm['id']);
    $componentTag = $_instance->getRenderedChildComponentTagName('perm_edit' . $perm['id']);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('perm_edit' . $perm['id']);
} else {
    $response = \Livewire\Livewire::mount('checkbox-component', ['permission' => $perm, 'inputs' => $inputs, 'type' => 'perm_edit']);
    $html = $response->html();
    $_instance->logRenderedChild('perm_edit' . $perm['id'], $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                                </div>
                                <div class="col-lg-2 justify-content-center align-items-center my-1">
                                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('checkbox-component', ['permission' => $perm, 'inputs' => $inputs, 'type' => 'perm_delete'])->html();
} elseif ($_instance->childHasBeenRendered('perm_delete' . $perm['id'])) {
    $componentId = $_instance->getRenderedChildComponentId('perm_delete' . $perm['id']);
    $componentTag = $_instance->getRenderedChildComponentTagName('perm_delete' . $perm['id']);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('perm_delete' . $perm['id']);
} else {
    $response = \Livewire\Livewire::mount('checkbox-component', ['permission' => $perm, 'inputs' => $inputs, 'type' => 'perm_delete']);
    $html = $response->html();
    $_instance->logRenderedChild('perm_delete' . $perm['id'], $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                                </div>
                            </div>
                            <hr class="bg-white">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" id="sub_perm" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\flare-office\resources\views/livewire/admin/permission-mangement.blade.php ENDPATH**/ ?>