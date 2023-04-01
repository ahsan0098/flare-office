<div>
    <div class="px-3" wire:poll>
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card">
                    {{-- @php
                        echo '<pre>';
                        print_r($);
                    @endphp --}}
                    <div class="card-header" wire:poll>
                        <h3 class="card-title">Employes Table</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Launch demo modal
                                </button> --}}
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search" wire:model="search" id="search_btn">

                                <div class="input-group-append mr-2">
                                    <button type="button" wire:click.prevent="search" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-default btn-primary px-2" data-toggle="modal"
                                        data-target="#add_employe">
                                        <i class="bi bi-person-plus-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0 table_card_view" wire:igonre.self>
                        {{-- @php
                            echo '<pre>';
                            print_r($employe);
                        @endphp --}}
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
                                    {{-- <th>Status</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <div>
                                    @foreach ($employe as $emp)
                                        <tr class="<?= $emp->status ? '' : 'text-warning' ?>">
                                            <td style="text-align: center; vertical-align:middle;"
                                                style="text-align: center; vertical-align:middle;">
                                                @if ($emp->image)
                                                    <img src="{{ asset('storage/employe_' . $emp->id) . '/' . $emp->image }}"
                                                        class="mig img-circle elevation-2" alt="User Image"
                                                        width="50" height="50">
                                                @else
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                                        class="mig img-circle elevation-2" alt="User Image"
                                                        width="50" height="50">
                                                @endif
                                            </td>
                                            <td style="text-align: center; vertical-align:middle;">{{ $emp->name }}
                                            </td>
                                            <td style="text-align: center; vertical-align:middle;">{{ $emp->email }}
                                            </td>
                                            <td style="text-align: center; vertical-align:middle;">{{ $emp->salary }}
                                            </td>
                                            <td style="text-align: center; vertical-align:middle;">
                                                {{ $emp->department->name }}</td>
                                            <td style="text-align: center; vertical-align:middle;">
                                                {{ $emp->position->name }}</td>
                                            <td style="text-align: center; vertical-align:middle;">
                                                {{ $emp->created_at->format('Y-m-d') }}</td>
                                            {{-- <td style="text-align: center; vertical-align:middle;">
                                                <?= $emp->status ? 'Active' : 'Proactive' ?></td> --}}
                                            <td style="text-align: center; vertical-align:middle;"><a href=""
                                                    data-toggle="modal" data-target="#edit_employe"
                                                    wire:click.prevent="Edit({{ $emp->id }})"><i
                                                        class="bi bi-pencil-square text-success"></i></a>&nbsp;&nbsp;<a
                                                    href=""
                                                    wire:click.prevent="deactivate({{ $emp->id }})"><?= $emp->status
                                                        ? '<i
                                                        class="bi bi-person-dash-fill text-warning"></i>'
                                                        : '<i
                                                        class="bi bi-person-plus-fill text-primary"></i>' ?></a>&nbsp;&nbsp;<a
                                                    href=""
                                                    wire:click.prevent="choseDelete({{ $emp->id }})"><i
                                                        class="bi
                                                    bi-trash-fill text-danger"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </div>
                            </tbody>
                        </table>
                        {{-- <button wire:click.prevent="addEmploye">click me</button>
                        {{ $test }} --}}
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
                                                @error('emp_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                                @error('emp_email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                                @error('emp_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                                        @foreach ($deps as $dp)
                                                            <option value="{{ $dp->id }}">{{ $dp->name }}
                                                            </option>
                                                        @endforeach
                                                    </div>
                                                </select>
                                                @error('emp_department')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Position</label>
                                                <select class="form-control select2" style="width: 100%;"
                                                    name="emp_position" wire:model="emp_position">
                                                    <option selected="selected"></option>
                                                    <div>
                                                        @foreach ($sub_deps as $sd)
                                                            <option value="{{ $sd->id }}">{{ $sd->name }}
                                                            </option>
                                                        @endforeach
                                                    </div>
                                                </select>
                                                @error('emp_position')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Salary</label>
                                                <input type="text" class="form-control" name="emp_salary"
                                                    wire:model="emp_salary" id="exampleInputEmail1"
                                                    placeholder="Enter salary">
                                                @error('emp_salary')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                            <button type="submit" class="btn btn-primary">Regiter</button>
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
                                                @error('edit_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                                @error('edit_email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                                @error('edit_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                                        @foreach ($deps as $dp)
                                                            <option value="{{ $dp->id }}">{{ $dp->name }}
                                                            </option>
                                                        @endforeach
                                                    </div>
                                                </select>
                                                @error('edit_department')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Position</label>
                                                <select class="form-control select2" style="width: 100%;"
                                                    name="edit_position" wire:model="edit_position">
                                                    {{-- <option selected="selected"></option> --}}
                                                    <div>
                                                        @foreach ($sub_deps as $sd)
                                                            @if ($edit_position == $sd->id)
                                                                <option selected value="{{ $sd->id }}">
                                                                    {{ $sd->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $sd->id }}">
                                                                    {{ $sd->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </select>
                                                @error('edit_position')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Salary</label>
                                                <input type="text" class="form-control" name="edit_salary"
                                                    wire:model="edit_salary" id="exampleInputEmail1"
                                                    placeholder="Enter salary">
                                                @error('edit_salary')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                            <button type="submit" class="btn btn-primary">Regiter</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
