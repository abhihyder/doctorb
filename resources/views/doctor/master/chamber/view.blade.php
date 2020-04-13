<div class="modal-dialog modal-xl" style="float: right;padding-right: 8%">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
             <input type="hidden" name="id" id="id" class="form-control">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
               <label>Chamber Name <span style="color: red;font-weight: bold;"></span></label>
               <p class="form-control">{{$chamber->chamber_name}}</p>
              
            </div>
            <div class="col-md-6">
               <label>Chamber Address <span style="color: red;font-weight: bold;"></span></label>
               <p class="form-control">{{$chamber->chamber_address}}</p>
              
            </div>
            <div class="col-md-6">
               <label>Organization Name <span style="color: red;font-weight: bold;"></span></label>
               <p class="form-control">{{$organization->organization_name}}</p>
              
            </div>
            <div class="col-md-6">
               <label>Chamber Address <span style="color: red;font-weight: bold;"></span></label>
               <p class="form-control">{{$chamber->chamber_address}}</p>
              
            </div>
            <div class="col-md-6">
               <label>Chamber Name <span style="color: red;font-weight: bold;"></span></label>
               <p class="form-control">{{$chamber->chamber_name}}</p>
              
            </div>
            <div class="col-md-6">
               <label> Division <span style="color: red;font-weight: bold;"></span></label>
               <p class="form-control">{{$areaInfo[0]->name}}</p>
              
            </div>
            <div class="col-md-6">
               <label> District <span style="color: red;font-weight: bold;"></span></label>
               <p class="form-control">{{$areaInfo[1]->name}}</p>
              
            </div>
            <div class="col-md-6">
               <label> Thana <span style="color: red;font-weight: bold;"></span></label>
               <p class="form-control">{{$areaInfo[2]->name}}</p>
              
            </div>
           
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       
        </div>
      </div>
    </div>