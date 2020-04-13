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
            <div class="col-md-4">
               <label>Name <span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="name" id="name" value="{{$result_data->name}}" class="form-control">
            </div>
            <div class="col-md-4">
              <label>Phone <span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="phone" id="phone" value="{{$result_data->phone}}" class="form-control">
            </div>
            <div class="col-md-4">
              <label for="sel1">Select Organization <span style="color: red;font-weight: bold;">*</span></label>
                <select class="form-control" name="organization_id" id="organization_id">
                  <option value="">Select One</option>
                  <?php
                  foreach ($organizations as $organization) { ?>
                  <option value="<?php echo $organization->id;?>" {{ ( $organization->id == $result_data->organization_id) ? 'selected' : '' }}><?php echo $organization->organization_name;?></option>
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
            <div class="col-md-4">
              <label for="sel1">Select User <span style="color: red;font-weight: bold;">*</span></label>
                <select class="form-control" name="user_id" id="user_id">
                  <option value="">Select One</option>
                  <?php
                  foreach ($users as $user) { ?>
                  <option value="<?php echo $user->id;?>" {{ ( $user->id == $result_data->user_id) ? 'selected' : '' }}><?php echo $user->name;?></option>
                <?php } ?>
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