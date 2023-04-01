<div>
    <div class="row mx-1" wire:poll>
        <div class="col-12 col-sm-12">
            <div class="card ">
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
                    @php
                        // echo '<pre>';
                        // print_r($all_permissions);
                        $i = 0;
                    @endphp
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID{{ $test }}</th>
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
                                @foreach ($role_permissions as $role => $admin_role_permission)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td><strong>{{ Str::ucfirst($role) }}</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a class="btn btn-success my-0"
                                                href="{{ route('permission-management', ['role_name' => $role]) }}"><i
                                                    class="bi bi-pencil-square text-white"></i></a></td>
                                    </tr>
                                    <div>
                                        @foreach ($admin_role_permission as $permission_for_role)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>{{ Str::ucfirst($permission_for_role['permission']['name']) }}</td>
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
                                        @endforeach
                                    </div>
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
                                    @error('newrole')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                    <h5 class="modal-title" id="addpermissionLabel">New Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent="addpermission">
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="col-form-label" for="inputSuccess"> Enter permission name</label>
                                    <input type="text" wire:model="newpermission"
                                        name='newpermission'class="form-control" placeholder="Enter ...">
                                    @error('newpermission')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
