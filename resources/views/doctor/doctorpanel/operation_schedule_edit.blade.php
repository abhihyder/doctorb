<div class="row form-inline">
    <div class="col-12 form-group">
        <label class="col-4" for="title">Title</label>
        <div class="col-1">:</div>
        <input type="text" class="col-7 form-control" value="{{ $opScheduleInfo->title }}" name="title" required>
    </div>
    <input type="hidden" name="id" value="{{ \App\Libraries\Encryption::encodeId($opScheduleInfo->id)}}">
    <div class="clear-fix"></div>
    <div class="col-12 form-group">
        <label class="col-4" for="details">Details</label>
        <div class="col-1">:</div>
        <input type="text" class="col-7 form-control" value="{{ $opScheduleInfo->details }}" name="details">
    </div>
    <div class="clear-fix"></div>
    <div class="col-12 form-group">
        <label class="col-4" for="organization">Organization</label>
        <div class="col-1">:</div>
        <input type="text" class="col-7 form-control" value="{{ $opScheduleInfo->organization }}" name="organization" required>
    </div>
    <div class="clear-fix"></div>
    <div class="col-12 form-group">
        <label class="col-4" for="organization">Date</label>
        <div class="col-1">:</div>
        <input type="date" class="col-7 form-control" value="{{ $opScheduleInfo->date }}"  name="date" required>
    </div>
    <div class="clear-fix"></div>
    <div class="col-12 form-group">
        <label class="col-4" for="organization">Time</label>
        <div class="col-1">:</div>
        <input type="time" class="col-7 form-control" value="{{ $opScheduleInfo->time }}" name="time" required>
    </div>
    <div class="clear-fix"></div>
    <div class="col-12 form-group">
        <label class="col-4" for="organization">Status</label>
        <div class="col-1">:</div>
        <select name="status" id="status" class="form-control col-7" required>
            <option value="0">Select One</option>
            <option value="1"  @if($opScheduleInfo->status == 1)  selected @endif >Low</option>
            <option value="2"  @if($opScheduleInfo->status == 2)  selected @endif >Medium</option>
            <option value="3" @if($opScheduleInfo->status == 3)  selected @endif >High</option>
        </select>
    </div>
</div>