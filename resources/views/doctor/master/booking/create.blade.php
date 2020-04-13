    <div class="modal-dialog modal-xl" style="float: right;padding-right: 8%">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Info</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="POST" id="saveForm">
            @csrf
            <!-- <input type="text" name="_token" value="<?php echo csrf_token(); ?>"> -->
        <div class="modal-body">
          <div class="row">
            <div class="col-md-3">
               <label>Chamber Name <span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="chamber_name" id="chamber_name" class="form-control">
            </div>
            <div class="col-md-3">
              <label>Chamber Address <span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="chamber_address" id="chamber_address" class="form-control">
            </div>
            <div class="col-md-3">
              <label>Phone <span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="phone" id="phone" class="form-control">
            </div>
            <div class="col-md-3">
              <label>Room No <span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="room_no" id="room_no" class="form-control">
            </div>
          </div><br>
          <div class="row">
            <div class="col-md-3">
              <label for="sel1">Select Division <span style="color: red;font-weight: bold;">*</span></label>
                <select class="form-control" name="division_id" id="division_id">
                  <option value="">Select One</option>
                  <?php
                  foreach ($divisions as $division) { ?>
                  <option value="<?php echo $division->id;?>"><?php echo $division->division_name;?></option>
                <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
              <label for="sel1">Select District </label>
              <select class="form-control districtList" id="district_id" name="district_id">
                  <option value="">Select</option>
              </select>
            </div>
            <div class="col-md-3">
              <label for="sel1">Select Thana</label>
              <select class="form-control thanaList" id="thana_id" name="thana_id">
                  <option value="">Select</option>
              </select>
            </div>
            <div class="col-md-3">
              <label for="sel1">Select Organigation</label>
              <select class="form-control orgList" id="organization_id" name="organization_id">
                  <option value="">Select</option>
              </select>
            </div>
           
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" id="submit" value="Save" class="btn btn-primary">
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