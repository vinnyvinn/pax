<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="m-b-0 text-white">{{ $pickup->id ? 'Update' : 'Add' }} pickup</h4>
    </div>
    <form action="{{ !$pickup->id ? route('pickups.store') : route('pickups.update', $pickup->id) }}" class="form-bordered" method="POST">
      <div class="panel-body">
        {{ csrf_field() }}
        @if($pickup->id)
          {{ method_field('PUT') }}
        @endif
        <div class="row">
            <div class="form-group col-md-4">
                <label class="control-label">Type</label>
                <select name="type" id="type" class="form-control">
                  <option value="{{ \PAX\Models\Pickup::TYPE_tnt }}" {{ $pickup->type or old('type') == \PAX\Models\Pickup::TYPE_tnt ? 'selected' : '' }}>TNT</option>
                  <option value="{{ \PAX\Models\Pickup::TYPE_fedex }}" {{ $pickup->type or old('type') == \PAX\Models\Pickup::TYPE_fedex ? 'selected' : '' }}>FEDEX</option>
                </select>
                @if($errors->has('type'))
                <small class="form-control-feedback text-danger">{{ $errors->first('type') }}</small>
                @endif
            </div>
            <div class="form-group col-md-4">
              <label class="control-label">Pickup no</label>
              <input type="text" disabled name="pickup_no" value="{{ $pickup->pickup_no or old('pickup_no') }}" placeholder="Pick number" class="form-control">
              @if($errors->has('pickup_no'))
              <small class="form-control-feedback text-danger">{{ $errors->first('pickup_no') }}</small>
              @endif
            </div>
            <div class="form-group col-md-4">
              <label class="control-label">Pick up date</label>
              <input type="date" name="pickup_date"  value="{{$pickup->pickup_date or old('pickup_date') }}" placeholder="pick up date" class="form-control" required>
              @if($errors->has('pickup_date'))
              <small class="form-control-feedback text-danger">{{ $errors->first('pickup_date') }}</small>
              @endif
            </div>
            <div class="form-group col-md-4">
                <label for="ready_time" class="control-label">Ready time</label>
                <input type="time" name="ready_time" id="ready_time" max="17:30" value="{{ $pickup->ready_time or old('ready_time') }}" class="form-control" required>
                @if($errors->has('ready_time'))
                  <small class="form-control-feedback text-danger">{{ $errors->first('ready_time') }}</small>
                @endif
            </div>
            <div class="form-group col-md-4">
               <label for="close_time" class="control-label">Close time</label>
               <input type="time" name="close_time" id="close_time" max="17:30" value="{{ $pickup->close_time or old('close_time') }}" class="form-control" required>
               @if($errors->has('close_time'))
                  <small class="form-control-feedback text-danger">{{ $errors->first('close_time') }}</small>
                @endif
            </div>
        </div>
      <hr>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="control-label">Contact name</label>
          <input type="text" name="contact_name" value="{{ $pickup->contact_name or old('contact_name') }}" placeholder="contact name" class="form-control" required>
            @if($errors->has('contact_name'))
            <small class="form-control-feedback text-danger">{{ $errors->first('contact_name') }}</small>
            @endif
        </div>
        <div class="form-group col-md-4">
          <label class="control-label">Contact Phone</label>
          <input type="number" name="contact_phone" value="{{ $pickup->contact_phone or old('contact_phone') }}" class="form-control" required>
          @if($errors->has('contact_phone'))
            <small class="form-control-feedback text-danger">{{ $errors->first('contact_phone') }}</small>
          @endif
        </div>
        <div class="form-group col-md-4">
          <label class="control-label">Company name</label>
          <input type="text" name="company_name" value="{{ $pickup->company_name or old('company_name') }}" class="form-control" required>
          @if($errors->has('company_name'))
            <small class="form-control-feedback text-danger">{{ $errors->first('company_name') }}</small>
          @endif
        </div>
        <div class="form-group col-md-4">
          <label class="control-label" id="client_id">Bill Account</label>
          <select name="client_id" id="client_id" class="form-control">
            @foreach ($clients as $client)
              <option value="{{ $client->DCLink }}" {{ $pickup->client_id or old('client_id') == $client->DCLink ? 'selected' : '' }}>{{ $client->name }}</option> 
            @endforeach
          </select>
          @if($errors->has('bill_account'))
            <small class="form-control-feedback text-danger">{{ $errors->first('bill_account') }}</small>
          @endif
        </div>
        <div class="form-group col-md-4">
          <label class="control-label">Bill Company</label>
          <select class="form-control" name="bill_company" required>
             <option value="{{ \PAX\Models\Pickup::BILL_FEDEX }}" {{ $pickup->bill_company or old('bill_company') == \PAX\Models\Pickup::BILL_FEDEX ? 'selected' : '' }}>FEDEX</option>
             <option value="{{ \PAX\Models\Pickup::BILL_TNT }}" {{ $pickup->bill_company or old('bill_company') == \PAX\Models\Pickup::BILL_TNT ? 'selected' : '' }}>TNT</option>
             <option value="{{ \PAX\Models\Pickup::BILL_DOMESTIC }}" {{ $pickup->bill_company or old('bill_company') == \PAX\Models\Pickup::BILL_DOMESTIC ? 'selected' : '' }}>Domestic</option>
           </select>
           @if($errors->has('bill_account'))
             <small class="form-control-feedback text-danger">{{ $errors->first('bill_company') }}</small>
           @endif
        </div>
    </div>
      <hr>
      <div class="row">
        <div class="form-group col-md-4">
          <label class="control-label">No packages</label>
          <input type="number" name="no_packages" value="{{ $pickup->no_packages or old('no_packages') }}" class="form-control text-right" required>
          @if($errors->has('no_packages'))
          <small class="form-control-feedback text-danger">{{ $errors->first('no_packages') }}</small>
          @endif
        </div>
        <div class="form-group col-md-4">
           <label class="control-label">Expected weight(Kg)</label>
           <input type="number" name="expected_weight" value="{{ $pickup->expected_weight or old('expected_weight') }}" class="form-control text-right" required>
           @if($errors->has('expected_weight'))
           <small class="form-control-feedback text-danger">{{ $errors->first('expected_weight') }}</small>
           @endif
         </div>
      </div>
      <div class="form-group col-md-12">
          <label for="description" class="control-label">Brief description</label>
          <textarea name="description" id="description" class="form-control">{{ $pickup->description or old('description') }}</textarea>
      </div>
      <div class="form-group col-md-12">
          <label for="address" class="control-label">Pickup address</label>
          <textarea name="address" id="address" class="form-control">{{ $pickup->address or old('address') }}</textarea>
      </div>
      <div class="form-group col-md-12">
          <label for="instructions" class="control-label">Other instructions</label>
          <textarea name="instructions" id="instructions" class="form-control">{{ $pickup->instructions or old('instructions') }}</textarea>
      </div>
      <div class="form-group col-md-4">
          <label class="control-label">Cash Collect</label>
          <input type="number" name="cash_collect" value="{{ $pickup->cash_collect or old('cash_collect') }}" class="form-control text-right">
            @if($errors->has('cash_collect'))
            <small class="form-control-feedback text-danger">{{ $errors->first('cash_collect') }}</small>
            @endif
      </div>
      <div class="form-group col-md-4">
          <br>
          <div class="checkbox icheck-primary">
          <input type="checkbox" name="recurrent" id="recurrent" value="1" {{ $pickup->recurrent or old('recurrent') ? 'checked' : '' }}/>
             <label for="recurrent">Check recurrent</label>
          </div>
      </div>
      <hr>
    </div>
    <div class="panel-footer">
        <div class="row">
          <div class="col-12">
            <div class="pull-right clearfix">
               <button type="submit" class="btn btn-info btn-sm">
                 <i class="fa fa-save"></i> {{ $pickup->id ? 'Update' : 'Save' }}
                </button>
               <a href="{{ route('pickups.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-caret-left"></i> Back</a>
            </div>
          </div>
        </div>
    </div>
  </form>
</div>