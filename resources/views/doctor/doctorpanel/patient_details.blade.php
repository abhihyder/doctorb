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
                            <h3 class="mb-0">Patient Details</h3>
                        </div>
                        <!-- Light table -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <tr>
                                    <td>Patient name :</td>
                                    <td>{!! $detailsInfo->patient_name !!}</td>
                                </tr>
                                <tr>
                                    <td>Phone :</td>
                                    <td>{!! $detailsInfo->mobile_no !!}</td>
                                </tr>
                                <tr>
                                    <td>Address :</td>
                                    <td>{!! $detailsInfo->address !!}</td>
                                </tr>
                                <tr>
                                    <td>Serial Code :</td>
                                    <td>{!! $detailsInfo->booking_sl_code !!}</td>
                                </tr>
                                <tr>
                                    <td>Serial No :</td>
                                    <td>{!! $detailsInfo->serial_no !!}</td>
                                </tr>
                                <tr>
                                    <td>Visited Time :</td>
                                    <td>{!! $detailsInfo->visited_time !!}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            @include('layouts/footer')

        </div>
    </div>
    <script>

    </script>

@endsection
