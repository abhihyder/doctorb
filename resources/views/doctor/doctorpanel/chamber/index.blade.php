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
                        <h4 style="text-align: center;">You Chamber List</h4><hr>
                        <div class="row">
                           <div class="col-lg-4">
                               <div class="card text-center" style="width: 18rem;">
                                 <div class="card-body">
                                   <h5 class="card-title">Chamber one</h5>
                                   <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                   <a href="{{ url('chamber-panel/getChamber') }}" class="btn btn-primary">Go chamber</a>
                                 </div>
                               </div>
                           </div>
                           <div class="col-lg-4">
                               <div class="card text-center" style="width: 18rem;">
                                 <div class="card-body">
                                   <h5 class="card-title">Chamber Two</h5>
                                   <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                   <a href="{{ url('chamber-panel/getChamber') }}" class="btn btn-primary">Go chamber</a>
                                 </div>
                               </div>
                           </div>
                           <div class="col-lg-4">
                               <div class="card text-center" style="width: 18rem;">
                                 <div class="card-body">
                                   <h5 class="card-title">Chamber Three</h5>
                                   <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                   <a href="{{ url('chamber-panel/getChamber') }}" class="btn btn-primary">Go chamber</a>
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
        <div class="modal" id="targetModal" data-toggle="modal" data-backdrop="static" data-keyboard="false">
            <div id="load_modal_content">--}}
                <!-- dynamic content go here... -->
            </div>
        </div>

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
@endsection
