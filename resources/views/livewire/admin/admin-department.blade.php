<div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Left col -->
                @php
                    $color = ['bg-success', 'bg-primary', 'bg-warning', 'bg-info', 'bg-danger'];
                    // $i = array_rand($color, 1);
                @endphp
                @if (is_array($dep) || is_object($dep))
                    @foreach ($dep as $dp)
                        <div class="col-md-{{ rand(5, 6) }}">
                            <!-- MAP & BOX PANE -->
                            @php
                                $i = array_rand($color, 1);
                            @endphp
                            <div class="card">
                                <div class="card-header {{ $color[$i] }}">
                                    <h3 class="card-title">{{ $dp['name'] }}</h3>

                                    {{-- <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div> --}}
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-3">
                                    <div class="d-md-flex">
                                        <div class="p-1 flex-fill" style="overflow: hidden">
                                            <!-- Map will be created here -->
                                            <div id="world-map-markers" style="height: 325px; overflow: hidden">
                                                <div class="map">
                                                    {{ $dp['description'] }}
                                                    <br><br>
                                                    @foreach ($dp['sub_department'] as $sub)
                                                        <span class="mx-3">{{ $sub['name'] }} :</span> <span
                                                            class="text-warning"></span><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="card-pane-right bg-success pt-2 pb-2 pl-4 pr-4 scrolebar">
                                                <div class="description-block mb-4">
                                                    @foreach ($dp['sub_department'] as $sub)
                                                        <div class="sparkbar pad" data-color="#fff">
                                                            <span class="text-primary">{{ $sub['name'] }}</span>
                                                        </div>
                                                        <p>{{ $sub['description'] }}</p>
                                                    @endforeach
                                                </div>
                                            </div><!-- /.card-pane-right --> --}}
                                    </div><!-- /.d-md-flex -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    @endforeach
                @endif
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
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea class="form-control" id="exampleInputEmail1" placeholder="Enter description" rows="5" name="description"
                                        wire:model="description">
                                        </textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div> --}}
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
                        <form action="" method="POST" wire:submit.prevent="addSubDepartment" id="sub_dept_form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="sub_name" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter sub-deparment name" name="sub_name" wire:model="sub_name">
                                    @error('sub_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea type="description" class="form-control" id="exampleInputEmail1" placeholder="Enter description"
                                        name="sub_desc" rows="3" wire:model="sub_desc"></textarea>
                                    @error('sub_desc')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Main Department</label>
                                    <select name="sub_main" class="form-control" id="exampleInputEmail1"
                                        wire:model="sub_main">
                                        <option value="">Select Main department</option>
                                        @foreach ($dep as $dp)
                                            <option value="{{ $dp['id'] }}">{{ $dp['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('sub_main')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
            {{-- @php
                    echo '<pre>';
                    print_r($dep);
                @endphp --}}
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
