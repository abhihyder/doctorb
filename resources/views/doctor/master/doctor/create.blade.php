<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Add Info</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <form method="POST" id="saveForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-md-3">
                    <label>Doctor Name <span style="color: red;font-weight: bold;">*</span></label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Address <span style="color: red;font-weight: bold;">*</span></label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Phone <span style="color: red;font-weight: bold;">*</span></label>
                    <input type="text" name="phone" id="phone" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Email<span style="color: red;font-weight: bold;">*</span></label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label>Degree<span style="color: red;font-weight: bold;">*</span></label>
                    <input type="text" name="degree" id="degree" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>BMDC No<span style="color: red;font-weight: bold;">*</span></label>
                    <input type="text" name="doc_bmdc_no" id="doc_bmdc_no" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="sel1">Select Gender <span style="color: red;font-weight: bold;">*</span></label>
                    <select class="form-control" name="gender" id="gender">
                        <option value="">Select One</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="sel1">Select Division <span style="color: red;font-weight: bold;">*</span></label>
                    <select class="form-control" name="division_id" id="division_id">
                        <option value="">Select One</option>
                        <?php
                        foreach ($divisions as $division) { ?>
                        <option value="<?php echo $division->id;?>"><?php echo $division->name;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
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
                <div class="col-md-3">
                    <label for="sel1">Select Status</label>
                    <select class="form-control" id="d_b_status" name="d_b_status">
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="sel1">Select Chamber </label>
                    <select class="form-control chamberList" id="chamber_id" name="chamber_id">
                        <option value="">Select</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="sel1">Doctor Type</label>
                    <select class="form-control" id="doc_type" name="doc_type">
                        <option value="1">Type One</option>
                        <option value="2">Type Two</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Photo<span style="color: red;font-weight: bold;">*</span></label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>First Fees<span style="color: red;font-weight: bold;">*</span></label>
                    <input type="text" name="fees" id="fees" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label>Second Fees<span style="color: red;font-weight: bold;">*</span></label>
                    <input type="text" name="second_fees" id="second_fees" class="form-control">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" id="submit" value="Save" class="btn btn-primary">
        </div>
    </form>

</div>

<script type="text/javascript">
    $(document).on('change', '#division_id', function () {
        var divId = $('#division_id').val();
        $.ajax({
            type: "GET",
            dataType: "html",
            url: '/getDistrict',
            data: {divId: divId},
            success: function (result) {
                if (result) {
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
    $(document).on('change', '#district_id', function () {
        var disId = $('#district_id').val();
        $.ajax({
            type: "GET",
            dataType: "html",
            url: '/getThana',
            data: {disId: disId},
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

    $(document).on('change', '#thana_id', function () {
        var thana_id = $('#thana_id').val();
        $.ajax({
            type: "GET",
            dataType: "html",
            url: '/getOrganization',
            data: {thana_id: thana_id},
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
    $(document).on('change', '#organization_id', function () {
        var organization_id = $('#organization_id').val();
        $.ajax({
            type: "GET",
            dataType: "html",
            url: '/getChamber',
            data: {organization_id: organization_id},
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
