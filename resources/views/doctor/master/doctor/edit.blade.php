    <?php
    $gender_ar = array(
      '1'=> 'Male',
      '2'=> 'Female'
    );
    $d_status = array(
      '1'=> 'Active',
      '2'=> 'Inactive'
    );
    $doc_type = array(
      '1'=> 'Type One',
      '2'=> 'Type Two'
    );
  ?>

    <div class="modal-dialog modal-xl" style="float: right;padding-right: 8%">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Info</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="POST" id="editForm">
            @csrf
             <input type="hidden" name="id" id="id" value="{{$result_data->id}}" class="form-control">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-3">
               <label>Doctor Name <span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="name" id="name" value="{{$result_data->name}}" class="form-control">
            </div>
            <div class="col-md-3">
              <label>Address <span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="address" id="address" value="{{$result_data->address}}" class="form-control">
            </div>
            <div class="col-md-3">
              <label>Phone <span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="phone" id="phone" value="{{$result_data->phone}}" class="form-control">
            </div>
            <div class="col-md-3">
              <label>Email<span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="email" id="email" value="{{$result_data->email}}" class="form-control">
            </div>
          </div><br>
          <div class="row">
            <div class="col-md-3">
              <label>Degree<span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="degree" id="degree" value="{{$result_data->degree}}" class="form-control">
            </div>
            <div class="col-md-3">
              <label>BMDC No<span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="doc_bmdc_no" id="doc_bmdc_no" value="{{$result_data->doc_bmdc_no}}" class="form-control">
            </div>
            <div class="col-md-3">
              <label for="sel1">Select Gender <span style="color: red;font-weight: bold;">*</span></label>
                <select class="form-control" name="gender" id="gender">
                    <?php foreach($gender_ar as $key => $gnd_v){ ?>
                    <option value="<?php echo $gnd_v;?>" {{ ( $gnd_v== $result_data->gender) ? 'selected' : '' }}><?php echo $gnd_v;?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
              <label for="sel1">Select Division <span style="color: red;font-weight: bold;">*</span></label>
                <select class="form-control" name="division_id" id="division_id">
                  <option value="">Select One</option>
                  <?php
                  foreach ($divisions as $division) { ?>
                  <option value="{{$division->id}}" {{ ( $division->id == $result_data->division_id) ? 'selected' : '' }}><?php echo $division->name;?></option>
                <?php } ?>
                </select>
            </div>
          </div><br>
          <div class="row">
            <div class="col-md-3">
              <label for="sel1">Select District </label>
              <select class="form-control districtList" id="district_id" name="district_id">
                @foreach($districts as $district)
                  <option value="{{$district->id}}" {{ ( $district->id == $result_data->district_id) ? 'selected' : '' }}>{{$district->name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label for="sel1">Select Thana</label>
              <select class="form-control thanaList" id="thana_id" name="thana_id">
                  @foreach($thanas as $thana)
                  <option value="{{$thana->id}}" {{ ( $thana->id == $result_data->thana_id) ? 'selected' : '' }}>{{$thana->name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label for="sel1">Select Organigation</label>
              <select class="form-control orgList" id="organization_id" name="organization_id">
                  @foreach($organizations as $organization)
                  <option value="{{$organization->id}}" {{ ( $organization->id == $result_data->organization_id) ? 'selected' : '' }}>{{$organization->organization_name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label for="sel1">Select Status <span style="color: red;font-weight: bold;">*</span></label>
                <select class="form-control" name="d_b_status" id="d_b_status">
                    <?php foreach($d_status as $key => $gnd_v){ ?>
                    <option value="<?php echo $key;?>" {{ ( $key== $result_data->d_b_status) ? 'selected' : '' }}><?php echo $gnd_v;?></option>
                    <?php } ?>
                </select>
            </div>
          </div><br>
          <div class="row">
            <div class="col-md-4">
              <label for="sel1">Select Chamber <span style="color: red;font-weight: bold;">*</span></label>
                <select class="form-control" name="chamber_id" id="chamber_id">
                  <option value="">Select One</option>
                  <?php
                  foreach ($chambers as $chamber) { ?>
                  <option value="<?php echo $chamber->id;?>" {{ ( $chamber->id == $result_data->chamber_id) ? 'selected' : '' }}><?php echo $chamber->chamber_name;?></option>
                <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
              <label for="sel1">Doctor Type <span style="color: red;font-weight: bold;">*</span></label>
                <select class="form-control" name="doc_type" id="doc_type">
                    <?php foreach($doc_type as $key => $gnd_v){ ?>
                    <option value="<?php echo $key;?>" {{ ( $key== $result_data->doc_type) ? 'selected' : '' }}><?php echo $gnd_v;?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
              <label>Photo<span style="color: red;font-weight: bold;">*</span></label>
              <input type="file" name="image" id="image" class="form-control">
            </div>

          </div><br>
          <div class="row">
            <div class="col-md-3">
              <label>First Fees<span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="fees" id="fees" value="{{$result_data->fees}}" class="form-control">
            </div>
            <div class="col-md-3">
              <label>Second Fees<span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="second_fees" id="second_fees" value="{{$result_data->second_fees}}" class="form-control">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" id="submitEdit" value="Save" class="btn btn-primary">
        </div>
      </form>

      </div>
    </div>

    <script type="text/javascript">
      $(document).on('change','#division_id',function(){
        var divId = $('#division_id').val();
        $.ajax({
          type: "GET",
          dataType: "html",
          url: '/getDistrict',
          data:{divId:divId},
          success: function (result) {
            if (result) {
              console.log(result);
              $('.districtList').html(result);
              return false;
            } else {
              return false;
            }
          }
        });
        return false;
      });
    </script>

    <script type="text/javascript">
      $(document).on('change','#district_id',function(){
        var disId = $('#district_id').val();
        $.ajax({
          type: "GET",
          dataType: "html",
          url: '/getThana',
          data:{disId:disId},
          success: function (result) {
            if (result) {
              console.log(result);
              $('.thanaList').html(result);
              return false;
            } else {
              return false;
            }
          }
        });
        return false;
      });
    </script>
    <script type="text/javascript">
      $(document).on('change','#thana_id',function(){
        var thana_id = $('#thana_id').val();
        $.ajax({
          type: "GET",
          dataType: "html",
          url: '/getOrganization',
          data:{thana_id:thana_id},
          success: function (result) {
            if (result) {
              console.log(result);
              $('.orgList').html(result);
              return false;
            } else {
              return false;
            }
          }
        });
        return false;
      });
    </script>
