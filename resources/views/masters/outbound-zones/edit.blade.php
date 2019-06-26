@extends('layouts.app')
@section('content')
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Outbound Zones</h4>
            </div>
            <div class="panel-body">
                <form action="{{ route('outbound-zones.update', $zone->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group{{ $errors->has('zone') ? ' has-error' : '' }})">
                        <label for="zone">Zone</label>
                        <select name="zone" id="zone" class="form-control" required>
                            <option value="A"{{ $zone->zone == 'A' ? ' selected' : '' }}>A</option>
                            <option value="B"{{ $zone->zone == 'B' ? ' selected' : '' }}>B</option>
                            <option value="C"{{ $zone->zone == 'C' ? ' selected' : '' }}>C</option>
                            <option value="D"{{ $zone->zone == 'D' ? ' selected' : '' }}>D</option>
                            <option value="E"{{ $zone->zone == 'E' ? ' selected' : '' }}>E</option>
                            <option value="F"{{ $zone->zone == 'F' ? ' selected' : '' }}>F</option>
                            <option value="G"{{ $zone->zone == 'G' ? ' selected' : '' }}>G</option>
                            <option value="H"{{ $zone->zone == 'H' ? ' selected' : '' }}>H</option>
                            <option value="I"{{ $zone->zone == 'I' ? ' selected' : '' }}>I</option>
                            <option value="J"{{ $zone->zone == 'J' ? ' selected' : '' }}>J</option>
                            <option value="K"{{ $zone->zone == 'K' ? ' selected' : '' }}>K</option>
                            <option value="L"{{ $zone->zone == 'L' ? ' selected' : '' }}>L</option>
                            <option value="M"{{ $zone->zone == 'M' ? ' selected' : '' }}>M</option>
                            <option value="N"{{ $zone->zone == 'N' ? ' selected' : '' }}>N</option>
                            <option value="O"{{ $zone->zone == 'O' ? ' selected' : '' }}>O</option>
                            <option value="P"{{ $zone->zone == 'P' ? ' selected' : '' }}>P</option>
                            <option value="Q"{{ $zone->zone == 'Q' ? ' selected' : '' }}>Q</option>
                            <option value="R"{{ $zone->zone == 'R' ? ' selected' : '' }}>R</option>
                            <option value="S"{{ $zone->zone == 'S' ? ' selected' : '' }}>S</option>
                            <option value="T"{{ $zone->zone == 'T' ? ' selected' : '' }}>T</option>
                            <option value="U"{{ $zone->zone == 'U' ? ' selected' : '' }}>U</option>
                            <option value="V"{{ $zone->zone == 'V' ? ' selected' : '' }}>V</option>
                            <option value="W"{{ $zone->zone == 'W' ? ' selected' : '' }}>W</option>
                            <option value="X"{{ $zone->zone == 'X' ? ' selected' : '' }}>X</option>
                            <option value="Y"{{ $zone->zone == 'Y' ? ' selected' : '' }}>Y</option>
                            <option value="Z"{{ $zone->zone == 'Z' ? ' selected' : '' }}>Z</option>
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
                                <option value="{{ $country }}"{{ $zone->code == $country ? ' selected' : '' }}>{{ $name }}</option>
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