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
               <label>Organization Name <span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="organization_name" id="organization_name" value="{{$result_data->organization_name}}" class="form-control">
            </div>
            <div class="col-md-3">
              <label>Organization Address <span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="organization_address" id="organization_address" value="{{$result_data->organization_address}}" class="form-control">
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
            <input type="hidden" name="organization_type" id="organization_type" value="{{$result_data->organization_type}}" class="form-control">
            <!-- <div class="col-md-3">
              <label for="sel1">Organization Type </label>
              <select class="form-control thanaList" id="organization_type" name="organization_type">
                  @foreach($thanas as $thana)
                  <option value="{{$thana->id}}" {{ ( $thana->id == $result_data->organization_type) ? 'selected' : '' }}>{{$thana->thana_name}}</option>
                  @endforeach
              </select>
            </div> -->
            <div class="col-md-3">
              <label>Zip Code<span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="zip_code" id="zip_code" value="{{$result_data->zip_code}}" class="form-control">
            </div>

            <div class="col-md-3">
              <label>Registration No<span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="registration_no" id="registration_no" value="{{$result_data->registration_no}}" class="form-control">
            </div>
            <div class="col-md-3">
              <label for="sel1">Select Division <span style="color: red;font-weight: bold;">*</span></label>
                <select class="form-control" name="division_id" id="division_id">
                  <option value="">Select One</option>
                  <?php
                  foreach ($divisions as $division) { ?>
                  <option value="{{$division->id}}" {{ ( $division->id == $result_data->division_id) ? 'selected' : '' }}><?php echo $division->division_name;?></option>
                <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
              <label for="sel1">Select District </label>
              <select class="form-control districtList" id="district_id" name="district_id">
                @foreach($districts as $district)
                  <option value="{{$district->id}}" {{ ( $district->id == $result_data->district_id) ? 'selected' : '' }}>{{$district->district_name}}</option>
                  @endforeach
              </select>
            </div>
          </div><br>
          <div class="row">
            <div class="col-md-3">
              <label for="sel1">Select Thana</label>
              <select class="form-control thanaList" id="thana_id" name="thana_id">
                  @foreach($thanas as $thana)
                  <option value="{{$thana->id}}" {{ ( $thana->id == $result_data->thana_id) ? 'selected' : '' }}>{{$thana->thana_name}}</option>
                  @endforeach
              </select>
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