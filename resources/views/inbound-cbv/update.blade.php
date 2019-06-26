@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Update Scan {{ $scan }}
                    </div>

                    <div class="panel-body">

                        <form action="{{ route('manifest.scan', $endpoint) }}" method="post" role="form" enctype="multipart/form-data">

                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('manifest_id') ? ' has-error' : '' }}">
                                <label for="manifest_id">Flight</label>
                                <select class="form-control selectpicker" name="manifest_id" id="manifest_id">
                                    @foreach($manifests as $manifest)
                                    <option value="{{ $manifest->id }}">{{ $manifest->flight_date->format('d F Y') }} - {{ $manifest->flight_number }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('manifest_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('manifest_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('uploaded_file') ? ' has-error' : '' }}">
                                <label for="uploaded_file">Manifest File*</label>
                                <input type="file" class="form-control" name="uploaded_file" id="uploaded_file" required>

                                @if($errors->has('uploaded_file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('uploaded_file') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Update</button>
                                <a href="{{ route('manifest.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection