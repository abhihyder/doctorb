@extends('layouts.app')
@section('content')
    <div class="main-content" id="panel" xmlns="">

        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-12 text-right">
                            <!-- <a href="#" class="btn btn-sm btn-neutral">Add New Data</a> -->
                            <button style="" type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#operationScheduleModal">Add New Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col">
                    @include('layouts/msg')
                    <div class="card" id="listData">
                        <div class="card-header border-0">
                            <h3 class="mb-0">My Operation Schedule</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tableId">
                                <thead class="thead-light">
                                <tr>
                                    {{--<th scope="col" class="sort" data-sort="name">Sl</th>--}}
                                    <th scope="col" class="sort" data-sort="name">Title</th>
                                    <th scope="col" class="sort" data-sort="name">Organization</th>
                                    <th scope="col" class="sort" data-sort="name">Date</th>
                                    <th scope="col" class="sort" data-sort="name">Time</th>
                                    <th scope="col" class="sort" data-sort="name">Status</th>
                                    <th scope="col" class="sort" data-sort="name">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="operationScheduleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="{{ url('/doctor-panel/operation-schedule-store') }}">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Operation Schedule</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row form-inline">
                                <div class="col-12 form-group">
                                    <label class="col-4" for="title">Title</label>
                                    <div class="col-1">:</div>
                                    <input type="text" class="col-7 form-control" name="title" required>
                                </div>
                                <div class="clear-fix"></div>
                                <div class="col-12 form-group">
                                    <label class="col-4" for="details">Details</label>
                                    <div class="col-1">:</div>
                                    <input type="text" class="col-7 form-control" name="details">
                                </div>
                                <div class="clear-fix"></div>
                                <div class="col-12 form-group">
                                    <label class="col-4" for="organization">Organization</label>
                                    <div class="col-1">:</div>
                                    <input type="text" class="col-7 form-control" name="organization" required>
                                </div>
                                <div class="clear-fix"></div>
                                <div class="col-12 form-group">
                                    <label class="col-4" for="organization">Date</label>
                                    <div class="col-1">:</div>
                                    <input type="date" class="col-7 form-control" name="date" required>
                                </div>
                                <div class="clear-fix"></div>
                                <div class="col-12 form-group">
                                    <label class="col-4" for="organization">Time</label>
                                    <div class="col-1">:</div>
                                    <input type="time" class="col-7 form-control" name="time" required>
                                </div>
                                <div class="clear-fix"></div>
                                <div class="col-12 form-group">
                                    <label class="col-4" for="organization">Status</label>
                                    <div class="col-1">:</div>
                                    <select name="status" id="status" class="form-control col-7" required>
                                        <option value="0">Select One</option>
                                        <option value="1">Low</option>
                                        <option value="2">Medium</option>
                                        <option value="3">High</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="operationScheduleEditModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="{{ url('/doctor-panel/operation-schedule-update') }}">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Operation Schedule</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="opScheShowData">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts/footer')

    </div>


    </div>
    <script>
        $(function () {
            $('#tableId').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{url("doctor-panel/get-operation-schedule-list")}}',
                    method: 'post',
                    data: function (d) {
                        d._token = '{!! csrf_token() !!}';
                    }
                },
                columns: [
                    // {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'organization', name: 'organization'},
                    {data: 'date', name: 'date'},
                    {data: 'time', name: 'time'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "aaSorting": []
            });
        });

        $(document).on('click','.edit_operation_schedule',function () {
                var id = $(this).val();
                $.ajax({
                    url: '{{ url('/doctor-panel/operation-schedule-edit') }}',
                    type: "POST",
                    data:
                        {
                            id: id,
                        },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.responseCode === 1) {
                            $('#opScheShowData').html(response.data);
                            $('#operationScheduleEditModal').modal();
                        }

                    }, error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                        console.log(errorThrown);
                    },
                    beforeSend: function (xhr) {

                    }
                });
        })
    </script>

@endsection
