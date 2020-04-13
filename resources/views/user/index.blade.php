@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="container-fluid">
            <div class="header-body card">
                <h4 class="boxbdr" >User List</h4>
                <table class=" table table-bordered table-hover" id="list">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Type</th>
                        <th>Phone</th>
                        {{--<th>Status</th>--}}
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#list').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{url("user/get-list")}}',
                    method: 'post',
                    data: function (d) {
                        d._token = '{!! csrf_token() !!}';
                    }
                },
                columns: [
                    // {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'gender', name: 'gender'},
                    {data: 'user_type', name: 'user_type'},
                    {data: 'phone', name: 'phone'},
                    // {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "aaSorting": []
            });
        });
    </script>
@endsection
