<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Delete Info</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
			<div class="row">
				<h5 style="color: red">Are Yor Sure Want To Delete ??? </h5>
			</div><br>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary waves-effect" title="Delete" onclick="deleteFunction(<?php echo $main_id;?>)" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#targetModal">Delete</button>
		</div>
	</div>
</div>

