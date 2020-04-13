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
            <div class="col-md-4">
               <label>Name <span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="col-md-4">
              <label>Phone <span style="color: red;font-weight: bold;">*</span></label>
              <input type="text" name="phone" id="phone" class="form-control">
            </div>
            <div class="col-md-4">
              <label for="sel1">Select Organization <span style="color: red;font-weight: bold;">*</span></label>
                <select class="form-control" name="organization_id" id="organization_id">
                  <option value="">Select One</option>
                  <?php
                  foreach ($organizations as $organization) { ?>
                  <option value="<?php echo $organization->id;?>"><?php echo $organization->organization_name;?></option>
                <?php } ?>
                </select>
            </div>
            
          </div><br>
          <div class="row">
            <div class="col-md-4">
              <label for="sel1">Select Chamber </label>
              <select class="form-control chamberList" id="chamber_id" name="chamber_id">
                  <option value="">Select</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="sel1">Select User <span style="color: red;font-weight: bold;">*</span></label>
                <select class="form-control" name="user_id" id="user_id">
                  <option value="">Select One</option>
                  <?php
                  foreach ($users as $user) { ?>
                  <option value="<?php echo $user->id;?>"><?php echo $user->name;?></option>
                <?php } ?>
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
      $(document).on('change','#organization_id',function(){
        var organization_id = $('#organization_id').val();
        $.ajax({
          type: "GET",
          dataType: "html",
          url: '/getChamber',
          data:{organization_id:organization_id},
          success: function (result) {
            if (result) {
              console.log(result);
              $('.chamberList').html(result);
              return false;
            } else {
              return false;
            }
          }
        });
        return false;
      });
    </script>