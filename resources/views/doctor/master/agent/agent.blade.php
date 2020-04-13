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
                        @include('doctor/master/agent/home')
                    </div>
                </div>
            </div>

            <!-- Footer -->
            @include('layouts/footer')

        </div>

{{--        <!-- modal -->--}}
{{--        <div class="modal" id="targetModal" data-toggle="modal" data-backdrop="static" data-keyboard="false">--}}
{{--            <div id="load_modal_content">--}}
{{--                <!-- dynamic content go here... -->--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div  id="load_modal_content" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
        $(function () {
            $('#tableId').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{url("agent/get-list")}}',
                    method: 'post',
                    data: function (d) {
                        d._token = '{!! csrf_token() !!}';
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "aaSorting": []
            });
        });

        function add_data() {
            $.ajax({
                type: "GET",
                url: '/agent/create',
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
                url: '/agent/edit/' + id,
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

        $('body').on('click', '#submit', function () {
            $('#saveForm').validate({
                rules: {
                    name: {
                        required: true
                    },
                    phone: {
                        required: true
                    },

                },
                messages: {
                    name: {
                        required: 'Name is required'
                    },
                    phone: {
                        required: 'Name is required'
                    },

                },

                submitHandler: function (form) {
                    var currentForm = $('#saveForm')[0];
                    var formData = new FormData(currentForm);
                    $.ajax({
                        url: "{{route('agent.store')}}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            // $('#targetModal').modal('toggle');
                            window.location.href = "{{url('agent')}}";
                            // $('#listData').html(panel);
                        }
                    });

                }
            });
        });

        $('body').on('click', '#submitEdit', function () {
            $('#editForm').validate({
                rules: {
                    name: {
                        required: true
                    },
                    phone: {
                        required: true
                    },

                },
                messages: {
                    name: {
                        required: 'Name is required'
                    },
                    phone: {
                        required: 'Name is required'
                    },

                },

                submitHandler: function (form) {
                    var currentForm = $('#editForm')[0];
                    var formData = new FormData(currentForm);
                    $.ajax({
                        url: "agent/update",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            // $('#targetModal').modal('toggle');
                            // $('#listData').html(response);
                            window.location.href = "{{url('agent')}}";
                        }
                    });

                }
            });
        });
        function delete_data(id) {
            $.ajax({
                type: "GET",
                url: 'agent/delete/' + id,
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
                url: "agent/destroy/" + id,
                success: function (result) {
                    if (result) {
                        // $('#load_modal_content').html(result);
                        // $('#listData').html(result);
                        window.location.href = "{{url('agent')}}";
                        return false;
                    } else {
                        return false;
                    }
                }
            });
            return false;
        }
    </script>
@endsection
