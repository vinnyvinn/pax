@extends('layouts.app')
@section('content')
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Outbound Zones</h4>
            </div>
            <div class="panel-body">
                <form action="{{ route('outbound-zones.store') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('zone') ? ' has-error' : '' }})">
                        <label for="zone">Zone</label>
                        <select name="zone" id="zone" class="form-control" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                            <option value="G">G</option>
                            <option value="H">H</option>
                            <option value="I">I</option>
                            <option value="J">J</option>
                            <option value="K">K</option>
                            <option value="L">L</option>
                            <option value="M">M</option>
                            <option value="N">N</option>
                            <option value="O">O</option>
                            <option value="P">P</option>
                            <option value="Q">Q</option>
                            <option value="R">R</option>
                            <option value="S">S</option>
                            <option value="T">T</option>
                            <option value="U">U</option>
                            <option value="V">V</option>
                            <option value="W">W</option>
                            <option value="X">X</option>
                            <option value="Y">Y</option>
                            <option value="Z">Z</option>
                        </select>
                        <span>
                        @if ($errors->has('zone'))
                            <strong class="help-block">{{ $errors->first('zone') }} </strong>
                        @endif
                    </span>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Location Name</label>

                        <input type="text" name="name" id="name" class="form-control" value="{{ $zone->name or old('name') }}" required>
                        @if($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }})">
                        <label for="code">Country</label>
                        <select name="code" id="code" class="form-control" required>
                            @foreach(countries() as $name => $country)
                                <option value="{{ $country }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        <span>
                        @if ($errors->has('code'))
                            <strong class="help-block">{{ $errors->first('code') }} </strong>
                        @endif
                        </span>
                    </div>

                    <br class="clearfix" />

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('outbound-zones.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection