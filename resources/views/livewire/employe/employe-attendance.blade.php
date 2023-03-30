<div>
    <div class="row m-1">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Responsive Hover Table</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right"
                                placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Status</th>
                                {{-- <th>Reason</th> --}}
                            </tr>
                        </thead>
                        @php
                            $i = 0;
                        @endphp
                        <tbody>
                            <div>
                                @foreach ($total as $tot)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $tot['date'] }}</td>
                                        <td>{{ date('l', strtotime($tot['date'])) }}</td>
                                        <td>{{ $tot['attendance'] }}</td>
                                        {{-- <td><input class="ml-5 bg-success rdo" type="radio"
                                                name="mark-{{ $tot['id'] }}" id="mark-{{ $tot['id'] }}"
                                                value="present" data-id="{{ $tot['employe_id'] }}"
                                                data-att="{{ $tot['id'] }}">
                                            <input class="bg-success rdo" type="radio" name="mark-{{ $tot['id'] }}"
                                                id="mark-{{ $tot['id'] }}" value="absent"
                                                data-id="{{ $tot['employe_id'] }}" data-att="{{ $tot['id'] }}">
                                            <input class="bg-success rdo" type="radio"
                                                name="mark-{{ $tot['id'] }}" id="mark-{{ $tot['id'] }}"
                                                value="leave" data-id="{{ $tot['employe_id'] }}"
                                                data-att="{{ $tot['id'] }}">
                                        </td> --}}
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
    <!-- /.row -->
</div>
