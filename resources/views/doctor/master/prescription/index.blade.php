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
              <button style="" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#targetModal" onclick="add_data()">Prescription </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
      	<form method="POST" id="saveForm">
      	    @csrf
        <div class="col">
          @include('layouts/msg')
          <div class="card" id="listData">
          	<div class="row">
          		<div class="col-lg-4"></div>
          		<div class="col-lg-4"></div>
          		<div class="col-md-4">
          			<label>Patients</label>
          			{{--<select class="form-control" name="patient_name" id="patient_name" onchange="patient_name_func($(this).val())">--}}
          				{{--<option value="">---Selecet One---</option>--}}
          				{{--@foreach($bookings as $booking)--}}
          				{{--<option value="{{$booking->id}}">{{$booking->patient_name}}</option>--}}
          				{{--@endforeach--}}
          			{{--</select>--}}
          		</div>
          	</div><p style="color: green">Patients Info</p><hr>
          	<div class="row">
          		<div class="col-lg-4">
          			<label>Name</label>
          			<input type="text" name="name" id="name" class="form-control" readonly="">
          		</div>
          		<div class="col-lg-4">
          			<label>Age</label>
          			<input type="text" name="age" id="age" class="form-control" readonly="">
          		</div>
          		<div class="col-lg-4">
          			<label>Date <span style="color: red;font-weight: bold;">*</span></label>
          			<input type="date" name="prep_date" id="prep_date" class="form-control">
          		</div>
          	</div><br>
          	<div class="row">
          		<div class="col-lg-4">
          			<label>Mobile</label>
          			<input type="text" name="mobile" id="mobile" class="form-control" readonly="">
          		</div>
          		<div class="col-lg-4">
          			<label>Gender</label>
          			<select class="form-control" name="gender" id="gender" readonly>
          				<option value="">---Selecet One---</option>
          				<option value="1">Male</option>
          				<option value="2">Female</option>
          			</select>
          		</div>
          		<div class="col-lg-4">
          			<label>Patient's ID</label>
          			<input type="text" name="patients_id" id="patients_id" class="form-control" readonly>
          		</div>
          	</div><br><p style="color: green">Medicine Info</p><hr>

          	<div class="row">
          		<div class="col-lg-4">
          			<div class="col-lg-12">
          				<label>B. Pressure</label>
          				<input type="text" name="b_pressure" id="b_pressure" class="form-control">
          			</div><br>
          			<div class="col-lg-12">
          				<label>Problem To Eat</label>
          				<select class="form-control" name="eat_problem">
          					<option value="">---Selecet One---</option>
          					<option value="1">Yes</option>
          					<option value="2">No</option>
          				</select>
          			</div><br>
          			<div class="col-lg-12">
          				<label>Next Appointment</label>
          				<input type="date" name="next_appoinment_date" id="next_appoinment_date" class="form-control">
          			</div><br>
          			<div class="col-lg-12">
          				<label>Disease Name</label>
          				<input type="text" name="disease_name" id="disease_name" class="form-control">
          			</div><br>
          			<div class="col-lg-12">
          				<label>Tests</label>
          				<div class="input-group">
          					<input type="text" name="medical_test" id="medical_test" class="form-control">
          					<span class="input-group-btn">
          						<button  onclick="testAdd()" class="btn btn-info" type="button">Add</button>
          					</span>
          				</div>
          			</div><br>
          			<div class="col-lg-12">
          				<table class="table table-border table-hover">
          					<thead>
          						<th>Tests</th>
          						<th>Action</th>
          					</thead>
          					<tbody id="table_data">
          						<!-- <tr>
          							<td>Test Name</td>
          							<td><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
          						</tr> -->
          					</tbody>
          				</table>
          			</div>
          		</div>
          		<div class="col-lg-8">
          			<div class="row">
          				<div class="col-lg-6">
          					<label>Medicine Category</label>
          					<input type="text" name="medicine_category" id="medicine_category" class="form-control">
          				</div>
          				<div class="col-lg-6">
          					<label>Medicine Name</label>
          					<input type="text" name="medicine_name" id="medicine_name" class="form-control">
          				</div>
          			</div><br>
          			<div class="row">
          				<div class="col-lg-4">
          					<label>Dose Time</label>
          					<select class="form-control" name="dose_time" id="dose_time">
          						<option value="">---Selecet One---</option>
          						<option value="1+1+1">1+1+1</option>
          						<option value="1+1+0">1+1+0</option>
          						<option value="1+0+1">1+0+1</option>
          						<option value="0+1+1">0+1+1</option>
          						<option value="1+0+0">1+0+0</option>
          						<option value="0+1+0">0+1+0</option>
          						<option value="0+0+1">0+0+1</option>
          					</select>
          				</div>
          				<div class="col-lg-4">
          					<label>Before / After</label>
          					<select class="form-control" name="before_after" id="before_after">
          						<option value="">---Selecet One---</option>
          						<option value="1">Befor</option>
          						<option value="2">After</option>
          					</select>
          				</div>
          				<div class="col-lg-4">
          					<label>Time (Before / After)</label>
          					<input type="number" name="time_before_after" id="time_before_after" class="form-control">
          				</div>
          			</div><br>
          			<div class="row">
          				<div class="col-md-4"></div>
          				<div class="col-md-4"><button type="button" onclick="add_medicine()" class="btn btn-primary">Add Medicine</button></div>
          			</div>
          			<div class="row">
          				<h4 style="text-align: center;">Medicine Name</h4>
          				<table class="table table-border table-hover">
          					<thead>
          						<tr>
          							<th>#</th>
          							<th>Medicine Name</th>
          							<th>Dosen</th>
          							<th>Time (Before / After)</th>
          							<th>Action</th>
          						</tr>
          					</thead>
          					<tbody id="medicine_table_data">
          						<!-- <tr>
          							<td>01</td>
          							<td>m name</td>
          							<td>1+1+1</td>
          							<td>note</td>
          							<td><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
          						</tr> -->
          					</tbody>
          				</table>

          				<button type="submit" id="submitFinal" class="btn btn-success">Add Prescription</button>
          			</div>
          		</div><br>
          	</div>
          </div>
        </div>

        </form>

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
 
 <script type="text/javascript">
    function patient_name_func(id) {
        $.ajax({
            type: "GET",
            url: '/prescription/getPationsName/'+id,
            success: function (response) {
                if (response) {
                	var result = $.parseJSON(response);
                    $('#name').val(result.patient_name);
                    $('#age').val(result.age);
                    $('#gender').val(result.gender);
                    $('#mobile').val(result.patient_name);
                    $('#patients_id').val(result.id);
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
	function testAdd(){
		var totlrow=Number($('#table_data tr').length);
		var row_id=totlrow+1;

		 var add_data="<input style='border:none;background: none;' type='text' readonly name='medical_test[]' id='item_"+row_id+"' class='form-control' value='"+$("#medical_test").val()+"' />";
		 var del = "<button type='button' title='Delete' class='btn btn-danger btn-sm waves-effect deletebtn'><i class='material-icons' ><i class='fa fa-trash' aria-hidden='true'></i></i></button>";

		var ts="<tr>"+
        "<td style='padding-left:0px'>"+add_data+"</td>"+
        "<td>"+del+"</td>"+
      "</tr>";

      $("#table_data").append(ts);
	}
	$(document).on('click', 'button.deletebtn', function () {
	 if (confirm("Do you want to delete: ")) {
	  $(this).closest('tr').remove();
	  }
	  return false;
	});
</script>

<script type="text/javascript">
	function add_medicine(){
		var totlrow=Number($('#medicine_table_data tr').length);
		var row_id=totlrow+1;

		var category="<input type='hidden' name='medicine_category[]' id='item_"+row_id+"' class='form-control' value='"+$("#medicine_category").val()+"' />";
		var before_after="<input type='hidden' name='before_after[]' id='item_"+row_id+"' class='form-control' value='"+$("#before_after").val()+"' />";

		 var name="<input style='border:none;background: none;' type='text' readonly name='medicine_name[]' id='item_"+row_id+"' class='form-control' value='"+$("#medicine_name").val()+"' />";
		 var d_time="<input style='border:none;background: none;' type='text' name='dose_time[]' id='item_"+row_id+"' value='"+$("#dose_time").val()+"' />";
		 var note="<input style='border:none;background: none;' type='text' readonly name='time_before_after[]' id='item_"+row_id+"' class='form-control' value='"+$("#time_before_after").val()+"' />";
		 var del = "<button type='button' title='Delete' class='btn btn-danger btn-sm waves-effect deletebtn'><i class='material-icons' ><i class='fa fa-trash' aria-hidden='true'></i></i></button>";

		var ts="<tr>"+
		"<td>"+row_id+"</td>"+
        "<td style='display:none'"+category+"</td>"+
        "<td style='display:none'"+before_after+"</td>"+
        "<td style='padding-left:0px'>"+name+"</td>"+
        "<td style='padding-left:0px'>"+d_time+"</td>"+
        "<td style='padding-left:0px'>"+note+"</td>"+
        "<td>"+del+"</td>"+
      "</tr>";

      $("#medicine_table_data").append(ts);
	}
	$(document).on('click', 'button.deletebtn', function () {
	 if (confirm("Do you want to delete: ")) {
	  $(this).closest('tr').remove();
	  }
	  return false;
	});
</script>



 <script type="text/javascript">
        $('body').on('click', '#submitFinal', function () {
            $('#saveForm').validate({
                rules: {
                    patient_name: {
                        required: true
                    },
                    prep_date: {
                        required: true
                    },

                },
                messages: {
                    patient_name: {
                        required: 'Name is required'
                    },
                    prep_date: {
                        required: 'Date is required'
                    },

                },

                submitHandler: function (form) {
                    var currentForm = $('#saveForm')[0];
                    var formData = new FormData(currentForm);
                    $.ajax({
                      url: '{{ url("prescription/store") }} ',
                      type: 'POST',
                      data: formData,
                      processData: false,
                      contentType: false,
                      success: function (response) {
                        // window.location.href = "prescription/index";
                      }
                   });

                }
            });
  });
</script>	

@endsection
