@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       Pickup details - {{ $pickup->pickup_no }} ({{ $pickup->status_name }})
                    </div>

                    <div class="panel-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="details">
                                <br>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h5>Pickup date</h5>
                                        <h5>{{ $pickup->pickup_date }}</h5>
                                        <hr>

                                        <h5>Ready time</h5>
                                        <h5>{{ $pickup->ready_time }}</h5>
                                        <hr>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Close time</h5>
                                        <h5>{{ $pickup->close_time }}</h5>
                                        <hr>
                                        <h5>No of packages</h5>
                                        <h5>{{ $pickup->no_packages }}</h5>
                                        <hr>
                                    </div>
                                    <div class="col-sm-4">
                                        <h5>Expected weight</h5>
                                        <h5>{{ $pickup->expected_weight.' Kg' }}</h5>
                                        <hr>

                                        <h5>Cash collect</h5>
                                        <h5>{{ $pickup->cash_collect }}</h5>
                                        <hr>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5>Contact name</h5>
                                        <h5>{{ $pickup->contact_name }}</h5>
                                        <hr>

                                        <h5>Contact phone</h5>
                                        <h5>{{ $pickup->contact_phone }}</h5>
                                        <hr>

                                        <h5>Company name</h5>
                                        <h5>{{ $pickup->company_name }}</h5>
                                        <hr>

                                    </div>
                                    <div class="col-sm-6">
                                        <h5>Bill account</h5>
                                        <h5>{{ !$pickup->client ? '-' : $pickup->client->Name  }}</h5>
                                        <hr>

                                        <h5>Bill Company</h5>
                                        <h5>{{ $pickup->company_name }}</h5>
                                        <hr>

                                        <h5>Courier</h5>
                                        <h5>{{ $pickup->courier ? $pickup->courier->name : '-' }}</h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    
                                        <h5>Address</h5>
                                        <p>
                                            {{ $pickup->address }}
                                        </p>
                                        <hr>
                                    </div>
                                    <div class="col-sm-6">

                                        <h5>Brief description</h5>
                                        <p>
                                            {{ $pickup->description }}
                                        </p>
                                        <hr>
                                    </div>
                                    @if($pickup->done_comment)
                                    <div class="col-sm-6">

                                        <h5>Done comment</h5>
                                        <p>{{ $pickup->done_comment }}</p>
                                        <hr>
                                    </div>
                                    @endif
                                    @if($pickup->cancel_comment)
                                    <div class="col-sm-6">

                                        <h5>Cancel Comment</h5>
                                        <p>{{ $pickup->cancel_comment }}</p>
                                        <hr>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('pickups.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection