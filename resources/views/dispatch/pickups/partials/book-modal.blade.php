<div class="modal" style="" id='{{"modal_id_".$pickup->id }}' role="dialog" aria-labelledby='dsdsd' aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id='dsdsd'>Mark Booked</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Mark {{ $pickup->pickup_no }} booked</h3>
      </div>
      <div class="modal-footer">
        <form action="{{ route('pickups.update-status', $pickup->id) }}" method="post">
          {{ csrf_field() }} {{ method_field('PUT') }}
          <input type="hidden" name="status" value="{{ \PAX\Models\Pickup::STATUS_booked }}"/>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Booked</button>
        </form>
      </div>
    </div>
  </div>
</div>
