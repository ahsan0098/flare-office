<div>
    <div wire:poll>
        <div class="px-3">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $current }}</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 450px;">
                                    {{-- <form action=""> --}}
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
                                    {{-- </form> --}}
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default btn-success px-2"
                                            data-toggle="modal" data-target="#generate_code">
                                            Attendance Token
                                            {{-- <i class="bi bi-person-plus-fill"></i> --}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            {{-- @php
                                echo '<pre>';
                                print_r($test);
                            @endphp --}}
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
                                        @foreach ($total as $tot)
                                            <tr>
                                                <td>image</td>
                                                <td>{{ $tot['user']['name'] }}</td>
                                                <td>{{ $tot['user']['email'] }}</td>
                                                {{-- @if ($tot['attendance'] != null) --}}
                                                <div>
                                                    {{-- @foreach ($tot['attendance'] as $att) --}}
                                                    <td><?= $tot['attendance'] == 'present' ? '<span class="bg-success p-1 rounded">' . $tot['attendance'] . '</span>' : '' ?>
                                                        <?= $tot['attendance'] == 'absent' ? '<span class="bg-danger p-1 rounded">' . $tot['attendance'] . '</span>' : '' ?>
                                                        <?= $tot['attendance'] == 'leave' ? '<span class="bg-warning p-1 rounded">' . $tot['attendance'] . '</span>' : '' ?>
                                                    </td>
                                                    <td>{{ $tot['date'] }}</td>
                                                    {{-- @endforeach --}}
                                                </div>
                                                {{-- @else --}}
                                                {{-- <td><span class="bg-warning text-white p-1 rounded">Not
                                                            marked</span></td>
                                                    <td>...</td> --}}
                                                {{-- @endif --}}
                                                <td><input class="ml-5 bg-success rdo" type="radio"
                                                        name="mark-{{ $tot['id'] }}" id="mark-{{ $tot['id'] }}"
                                                        value="present" data-id="{{ $tot['employe_id'] }}"
                                                        data-att="{{ $tot['id'] }}">
                                                    <input class="bg-success rdo" type="radio"
                                                        name="mark-{{ $tot['id'] }}" id="mark-{{ $tot['id'] }}"
                                                        value="absent" data-id="{{ $tot['employe_id'] }}"
                                                        data-att="{{ $tot['id'] }}">
                                                    <input class="bg-success rdo" type="radio"
                                                        name="mark-{{ $tot['id'] }}" id="mark-{{ $tot['id'] }}"
                                                        value="leave" data-id="{{ $tot['employe_id'] }}"
                                                        data-att="{{ $tot['id'] }}">
                                                </td>
                                            </tr>
                                        @endforeach
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
                                <p type="text" name="random" class="form-control">@php
                                    print_r($random);
                                @endphp
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
                {{-- <div class="modal fade" id="edit_employe" tabindex="-1" role="dialog"
                aria-labelledby="edit_employeLabel" aria-hidden="true" wire:ignore.self>
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
                                                                <option value="{{ $dp->id }}">
                                                                    {{ $dp->name }}
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Regiter</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
            </div>
