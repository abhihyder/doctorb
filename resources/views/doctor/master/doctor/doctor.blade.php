@extends('layouts.app')
@section('content')
    <div class="main-content" id="panel">

        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-12 text-right">
                            <!-- <a href="#" class="btn btn-sm btn-neutral">Add New Data</a> -->
                            <button style="" type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#targetModal" onclick="add_data()">Add New Data
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
                        @include('doctor/master/doctor/home')
                    </div>
                </div>
            </div>

            <!-- Footer -->
            @include('layouts/footer')

        </div>

        <!-- modal -->
        <div id="targetModal" class="modal fade" id="modal-default" tabindex="-1" role="dialog"
             aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-xl" id="load_modal_content">
                <!-- dynamic content go here... -->

            </div>
        </div>


        <div class="modal fade" id="coinModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ url('/doctor/coin-assign') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Coin Assign</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="doctor_user_id" id="doctor_user_id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Input coin</label>
                                <input type="number" class="form-control" id="coin" name="coin">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Coin Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <script>
        $(function () {
            $('#tableId').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{url("doctor/get-list/")}}',
                    method: 'post',
                    data: function (d) {
                        d._token = '{!! csrf_token() !!}';
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'image', name: 'image'},
                    {data: 'degree', name: 'degree'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'chamber_name', name: 'chamber_name'},
                    {data: 'organization_name', name: 'organization_name'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "aaSorting": []
            });
        });
    </script>
    <script type="text/javascript">
        function add_data() {
            $.ajax({
                type: "GET",
                url: '/doctor/create',
                success: function (result) {
                    if (result) {
                        $('#load_modal_content').html(result);
                        return false;
                    } else {
                        return false;
                    }
                }
            });
            return false;
        }

        function edit_data(id) {
            $.ajax({
                type: "GET",
                url: '/doctor/edit/' + id,
                success: function (result) {
                    if (result) {
                        $('#load_modal_content').html(result);
                        return false;
                    } else {
                        return false;
                    }
                }
            });
            return false;
        }
    </script>
    <script type="text/javascript">
        $('body').on('click', '#submit', function () {
            $('#saveForm').validate({
                rules: {
                    name: {
                        required: true
                    },
                    address: {
                        required: true
                    },

                },
                messages: {
                    name: {
                        required: 'Name is required'
                    },
                    address: {
                        required: 'Address is required'
                    },

                },

                submitHandler: function (form) {
                    var currentForm = $('#saveForm')[0];
                    var formData = new FormData(currentForm);
                    $.ajax({
                        url: "{{route('doctor.store')}}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            // $('#targetModal').modal('toggle');
                            window.location.href = "{{url('doctor')}}";
                            // $('#listData').html(panel);
                        }
                    });

                }
            });
        });

        
        $('body').on('click', '#submitEdit', function () {
            $('#editForm').validate({
                rules: {
                    chamber_name: {
                        required: true
                    },
                    division_id: {
                        required: true
                    },

                },
                messages: {
                    chamber_name: {
                        required: 'Name is required'
                    },
                    division_id: {
                        required: 'Name is required'
                    },

                },

                submitHandler: function (form) {
                    var currentForm = $('#editForm')[0];
                    var formData = new FormData(currentForm);
                    $.ajax({
                        url: "doctor/update",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            // $('#targetModal').modal('toggle');
                            // $('#listData').html(response);
                            window.location.href = "{{url('doctor')}}";
                        }
                    });

                }
            });
        });

        function delete_data(id) {
            $.ajax({
                type: "GET",
                url: 'doctor/delete/' + id,
                success: function (result) {
                    if (result) {
                        $('#load_modal_content').html(result);
                        return false;
                    } else {
                        return false;
                    }
                }
            });
            return false;
        }

        function deleteFunction(id) {
            $.ajax({
                type: "GET",
                url: "doctor/destroy/" + id,
                success: function (result) {
                    if (result) {
                        // $('#load_modal_content').html(result);
                        // $('#listData').html(result);
                        window.location.href = "{{url('doctor')}}";
                        return false;
                    } else {
                        return false;
                    }
                }
            });
            return false;
        }

        function coin_assign(user_id) {
            $('#doctor_user_id').val(user_id);
            $('#coinModal').modal();
        }
    </script>
@endsection
