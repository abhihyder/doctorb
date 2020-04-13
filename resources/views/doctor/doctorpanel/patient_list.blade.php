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
                            {{--<button style="" type="button" class="btn btn-success btn-sm" data-toggle="modal"--}}
                                    {{--data-target="#targetModal" onclick="add_data()">Add New Data--}}
                            {{--</button>--}}
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
                            <h3 class="mb-0">Patient List</h3>
                        </div>
                        <!-- Light table -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tableId">
                                <thead class="thead-light">
                                <tr>
                                    {{--<th scope="col" class="sort" data-sort="name">Sl</th>--}}
                                    <th scope="col" class="sort" data-sort="name">Name</th>
                                    <th scope="col" class="sort" data-sort="name">Address</th>
                                    <th scope="col" class="sort" data-sort="name">Phone</th>
                                    <th scope="col" class="sort" data-sort="name">Action</th>
                                </tr>
                                </thead>

                            </table>
                        </div>
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
    </div>
    <script>
        $(function () {
            $('#tableId').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{url("doctor-panel/get-patient-list/")}}',
                    method: 'post',
                    data: function (d) {
                        d._token = '{!! csrf_token() !!}';
                    }
                },
                columns: [
                    // {data: 'id', name: 'id'},
                    {data: 'patient_name', patient_name: 'patient_name'},
                    {data: 'address', name: 'address'},
                    {data: 'mobile_no', name: 'mobile_no'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "aaSorting": []
            });
        });
    </script>

@endsection
