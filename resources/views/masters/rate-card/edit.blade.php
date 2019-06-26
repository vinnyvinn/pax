@extends('layouts.app')
@section('content')
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Rate Card</h4>
            </div>
            <div class="panel-body">
                <form action="{{ route('rate-card.update', $card->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Packaging</h4>
                            <p>{{ $card->getPackaging() }}</p>
                        </div>
                        <div class="col-sm-6">
                            <h4>Weight</h4>
                            <p>{{ $card->weight }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="form-group{{ $errors->has('zone_a') ? ' has-error' : '' }}">
                                <label for="zone_a">Zone A</label>
                                <input type="number" step="0.01" min="0" name="zone_a" id="zone_a" class="form-control" required value="{{ $card->zone_a }}">

                                @if($errors->has('zone_a'))
                                    <span class="help-block">{{ $errors->first('zone_a') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('zone_b') ? ' has-error' : '' }}">
                                <label for="zone_b">Zone B</label>
                                <input type="number" step="0.01" min="0" name="zone_b" id="zone_b" class="form-control" required value="{{ $card->zone_b }}">

                                @if($errors->has('zone_b'))
                                    <span class="help-block">{{ $errors->first('zone_b') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('zone_c') ? ' has-error' : '' }}">
                                <label for="zone_c">Zone C</label>
                                <input type="number" step="0.01" min="0" name="zone_c" id="zone_c" class="form-control" required value="{{ $card->zone_c }}">

                                @if($errors->has('zone_c'))
                                    <span class="help-block">{{ $errors->first('zone_c') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('zone_d') ? ' has-error' : '' }}">
                                <label for="zone_d">Zone D</label>
                                <input type="number" step="0.01" min="0" name="zone_d" id="zone_d" class="form-control" required value="{{ $card->zone_d }}">

                                @if($errors->has('zone_d'))
                                    <span class="help-block">{{ $errors->first('zone_d') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('zone_e') ? ' has-error' : '' }}">
                                <label for="zone_e">Zone E</label>
                                <input type="number" step="0.01" min="0" name="zone_e" id="zone_e" class="form-control" required value="{{ $card->zone_e }}">

                                @if($errors->has('zone_e'))
                                    <span class="help-block">{{ $errors->first('zone_e') }}</span>
                                @endif
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group{{ $errors->has('zone_f') ? ' has-error' : '' }}">
                                <label for="zone_f">Zone F</label>
                                <input type="number" step="0.01" min="0" name="zone_f" id="zone_f" class="form-control" required value="{{ $card->zone_f }}">

                                @if($errors->has('zone_f'))
                                    <span class="help-block">{{ $errors->first('zone_f') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('zone_g') ? ' has-error' : '' }}">
                                <label for="zone_g">Zone G</label>
                                <input type="number" step="0.01" min="0" name="zone_g" id="zone_g" class="form-control" required value="{{ $card->zone_g }}">

                                @if($errors->has('zone_g'))
                                    <span class="help-block">{{ $errors->first('zone_g') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('zone_h') ? ' has-error' : '' }}">
                                <label for="zone_h">Zone H</label>
                                <input type="number" step="0.01" min="0" name="zone_h" id="zone_h" class="form-control" required value="{{ $card->zone_h }}">

                                @if($errors->has('zone_h'))
                                    <span class="help-block">{{ $errors->first('zone_h') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('zone_i') ? ' has-error' : '' }}">
                                <label for="zone_i">Zone I</label>
                                <input type="number" step="0.01" min="0" name="zone_i" id="zone_i" class="form-control" required value="{{ $card->zone_i }}">

                                @if($errors->has('zone_i'))
                                    <span class="help-block">{{ $errors->first('zone_i') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('rate-card.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection