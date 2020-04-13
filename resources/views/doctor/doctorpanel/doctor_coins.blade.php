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
                        <h4 style="text-align: center;">You Coin Details</h4><hr>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card text-center" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Remaining Coin</h5>
                                        <p class="card-text">Some text title</p>
                                        <a href="#" class="btn btn-warning">{!! $coinsInfo->remaining_coin  !!} Coins</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card text-center" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Coin Spent</h5>
                                        <p class="card-text">Some text title.</p>
                                        <a href="#" class="btn btn-primary"><?php $cost_coin = ($coinsInfo->total_coin - $coinsInfo->remaining_coin); echo $cost_coin;  ?>  Coins</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card text-center" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Coins</h5>
                                        <p class="card-text">Some text title.</p>
                                        <a href="#" class="btn btn-success">{!! $coinsInfo->total_coin  !!} coins</a>
                                    </div>
                                </div>
                            </div>
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


@endsection
