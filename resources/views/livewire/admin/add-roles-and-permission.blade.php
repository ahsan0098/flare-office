<div>
    <div class="row justify-content-center align-items-center g-2 mx-5">
        <div class="card card-primary mx-1" style="width: 100%;">
            @php
                // echo '<pre>';
                // print_r($input);
            @endphp
            <!-- /.card-header -->
            <!-- form start -->
            <form wire:submit.prevent="set_permissions()">
                <div class="card-body">
                    {{-- <div class="form-group">
                        <label class="col-form-label" for="inputSuccess"> Input
                            with
                            success</label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                    </div> --}}
                    <div class="row justify-content-center align-items-center g-2 font-weight-bolder text-primary">
                        <div class="justify-content-center align-items-center my-1 col-lg-4">Permission</div>
                        <div class="justify-content-center align-items-center my-1 col-lg-2">View</div>
                        <div class="justify-content-center align-items-center my-1 col-lg-2">Add</div>
                        <div class="justify-content-center align-items-center my-1 col-lg-2">Edit</div>
                        <div class="justify-content-center align-items-center my-1 col-lg-2">Delete</div>
                    </div>
                    <div>
                        @foreach ($all_permissions as $perm)
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-lg-4 my-1">{{ Str::ucfirst($perm['name']) }}</div>
                                <div class="col-lg-2 justify-content-center align-items-center my-1">
                                    @livewire('checkbox-component', ['permission' => $perm, 'inputs' => $inputs, 'type' => 'perm_view'], key('perm_view' . $perm['id']))
                                </div>
                                <div class="col-lg-2 justify-content-center align-items-center my-1">
                                    @livewire('checkbox-component', ['permission' => $perm, 'inputs' => $inputs, 'type' => 'perm_add'], key('perm_add' . $perm['id']))
                                </div>
                                <div class="col-lg-2 justify-content-center align-items-center my-1">
                                    @livewire('checkbox-component', ['permission' => $perm, 'inputs' => $inputs, 'type' => 'perm_edit'], key('perm_edit' . $perm['id']))
                                </div>
                                <div class="col-lg-2 justify-content-center align-items-center my-1">
                                    @livewire('checkbox-component', ['permission' => $perm, 'inputs' => $inputs, 'type' => 'perm_delete'], key('perm_delete' . $perm['id']))
                                </div>
                            </div>
                            <hr class="bg-white">
                        @endforeach
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
