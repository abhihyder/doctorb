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
              <button style="" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#targetModal" onclick="add_data()">Add New Data</button>
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
           @include('doctor/master/chamber/home')
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
                url: '{{url("chamber/get-list")}}',
                method: 'post',
                data: function (d) {
                    d._token = '{!! csrf_token() !!}';
                }
            },
            columns: [
            {data: 'id', name: 'id'},
            {data: 'chamber_name', name: 'chamber_name'},
            // {data: 'chamber_address', name: 'chamber_address'},
            {data: 'organization_name', name: 'organization_name'},
            // {data: 'assigned_doctor', name: 'assigned_doctor'},
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
            url: '/chamber/create',
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
            url: '/chamber/edit/'+id,
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
    
    function view_data(id) {
        $.ajax({
            type: "GET",
            url: '/chamber/view/'+id,
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
<!-- 
 <script type="text/javascript">
        $('body').on('click', '#submit', function () {
            $('#saveForm').validate({
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
                    var currentForm = $('#saveForm')[0];
                    var formData = new FormData(currentForm);
                    $.ajax({
                      url: "{{route('chamber.store')}}",
                      type: 'POST',
                      data: formData,
                      processData: false,
                      contentType: false,
                      success: function (response) {
                        // $('#targetModal').modal('toggle');
                        window.location.href = "{{url('chamber')}}";
                        // $('#listData').html(panel);
                      }
                   });

                }
            });
  });
</script>	 -->
<script type="text/javascript">
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
                      url: "chamber/update",
                      type: 'POST',
                      data: formData,
                      processData: false,
                      contentType: false,
                      success: function (response) {
                        // $('#targetModal').modal('toggle');
                        // $('#listData').html(response);
                        window.location.href = "{{url('chamber')}}";
                      }
                   });

                }
            });
  });
</script>
<script type="text/javascript">
  function delete_data(id) {
      $.ajax({
          type: "GET",
          url: 'chamber/delete/' + id,
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
  function deleteFunction(id) {
      $.ajax({
          type: "GET",
          url: "chamber/destroy/"+id,
          success: function (result) {
              if (result) {
                  // $('#load_modal_content').html(result);
                  // $('#listData').html(result);
                  window.location.href = "{{url('chamber')}}";
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
