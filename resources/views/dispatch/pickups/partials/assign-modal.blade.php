<div class="modal" style="" id='{{"assignment_modal_id_".$pickup->id }}' role="dialog" aria-labelledby='dsdsd' aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id='dsdsd'>Assign Courier {{ $pickup->pickup_no }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <assign-courier :id="{{$pickup->id}}"></assign-courier>
      </div>
    </div>
  </div>
</div>
