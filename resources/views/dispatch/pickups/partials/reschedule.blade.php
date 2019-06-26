<div class="modal" style="" id='{{"reschedule_modal_id_".$pickup->id }}' role="dialog" aria-labelledby='dsdsd' aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id='dsdsd'>Update status - {{ $pickup->pickup_no }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('pickups.update-status', $pickup->id) }}" method="post">
          {{ csrf_field() }} {{ method_field('PUT') }}
          <div class="modal-body">
           <div class="row">
               <div class="col-md-12">
                <div class="form-group">
                  <label for="status">Status:</label>
                  <select name="status" id="status" class="form-control" required>
                    <option value="{{ \PAX\Models\Pickup::STATUS_rescheduled }}" selected>Reschedule</option>
                  </select>
                </div>
               </div>
               <div class="form-group col-md-12">
                  <label class="control-label">Pick up date</label>
                  <input type="date" name="pickup_date"  value="{{$pickup->pickup_date or old('pickup_date') }}" placeholder="pick up date" class="form-control" required>
                  @if($errors->has('pickup_date'))
                  <small class="form-control-feedback text-danger">{{ $errors->first('pickup_date') }}</small>
                  @endif
                </div>
                <div class="form-group col-md-12">
                    <label for="ready_time" class="control-label">Ready time</label>
                    <input type="time" name="ready_time" id="ready_time" value="{{ $pickup->ready_time or old('ready_time') }}" class="form-control">
                    @if($errors->has('ready_time'))
                      <small class="form-control-feedback text-danger">{{ $errors->first('ready_time') }}</small>
                    @endif
                </div>              
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
    </div>
    </div>
</div>
  