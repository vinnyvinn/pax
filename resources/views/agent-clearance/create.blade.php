@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">3rd Party Clearance Invoice</div>

                    <div class="panel-body">

                        <form action="{{ route('agent-clearance.store') }}" method="post" role="form">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="form-group">
                                        <label for="client_id">Client</label>
                                        <select required class="form-control selectpicker" name="client_id" id="client_id">
                                            @foreach($clients as $client)
                                                <option value="{{ $client->DCLink }}">{{ $client->Name }}({{ $client->Account }})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="waybill_id">Waybill</label>

                                        <select required class="form-control selectpicker" name="waybill_id" id="waybill_id">
                                            @foreach($waybills as $waybill)
                                                <option value="{{ $waybill->id }}">{{ $waybill->waybill_number }} (Duty {{ $waybill->bill_duty }}, Bill To {{ $waybill->bill_to }})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="clearing_agent_name">Clearing Agent Name.</label>
                                        <input type="text" required class="form-control" name="clearing_agent_name" id="clearing_agent_name">
                                    </div>

                                    <div class="form-group">
                                        <label for="break_bulk_fee">Break Bulk Fee.</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">$</span>
                                            <input  aria-describedby="basic-addon1" pattern="[0-9\.]+$" title="Decimal values only" type="text" required class="form-control" name="break_bulk_fee" id="break_bulk_fee">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <input type="hidden" name="finalize" value="false">

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Process</button>
                                <a href="{{ route('agent-clearance.index') }}" class="btn btn-danger">Back</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection