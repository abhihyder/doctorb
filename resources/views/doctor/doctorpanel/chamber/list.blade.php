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
              <!-- <button style="" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#targetModal" onclick="add_data()">Add New Data</button> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card" id="listData">
           @include('doctor/doctorpanel/chamber/home')
          </div>
        </div>
      </div>

      <!-- Footer -->
      @include('layouts/footer')

    </div>

    <!-- modal -->
     <div class="modal" id="targetModal" data-toggle="modal" data-backdrop="static" data-keyboard="false">
          <div id="load_modal_content">
            <!-- dynamic content go here... -->
          </div>
    </div>


  </div>
  <script>
    $(function () {
        $('#tableId').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{url("/chamber-panel/get-list")}}',
                method: 'post',
                data: function (d) {
                    d._token = '{!! csrf_token() !!}';
                }
            },
            columns: [
            {data: 'id', name: 'id'},
            // {data: 'booking_serial_code', name: 'booking_serial_code'},
            {data: 'patient_name', name: 'patient_name'},
            {data: 'mobile_no', name: 'mobile_no'},
            {data: 'visited_time', name: 'visited_time'},
            // {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "aaSorting": []
        });
    });

    function view_data(id) {
        $.ajax({
            type: "GET",
            url: '{{url("/chamberPanel/view_data")}}/'+id,
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

@endsection
