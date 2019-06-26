@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('setting-dashboard') }}">Setting Dashboard</a></li>
                  <li><a href="{{ route('user.index') }}">Users</a></li>
                  <li class="active">Edit User</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('user.update', $user->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }})">
                                        <label for="name">Name</label>
                                        <input name="name" id="name" value="{{ $user->name or old('name') }}" class="form-control" required>
                                        <span>
                                            @if ($errors->has('name'))
                                                <strong class="help-block">{{ $errors->first('name') }} </strong>
                                            @endif
                                        </span>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }})">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" value="{{ $user->email or old('email') }}" class="form-control" required>
                                        <span>
                                            @if ($errors->has('email'))
                                                <strong class="help-block">{{ $errors->first('email') }} </strong>
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }})">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control">
                                        <span>
                                            @if ($errors->has('password'))
                                                <strong class="help-block">{{ $errors->first('password') }} </strong>
                                            @endif
                                        </span>
                                    </div>

                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }})">
                                        <label for="password_confirmation">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
                                        <span>
                                    @if ($errors->has('password_confirmation'))
                                                <strong class="help-block">{{ $errors->first('password_confirmation') }} </strong>
                                            @endif
                                </span>
                                    </div>
                                </div>
                            </div>

                            <h4>Permissions</h4>
                            <div>
                                <button id="selectAll" class="btn btn-success btn-xs">Select All</button>
                                <button id="selectNone" class="btn btn-danger btn-xs">Select None</button>
                            </div>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="checkbox col-sm-4">
                                        <label>
                                            <input type="checkbox" name="permissions[{{ $permission->slug }}]"{{ in_array($permission->slug, $user->permissions) ? ' checked' : '' }}> {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-success">Save</button>
                                <a href="{{ route('user.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $('#selectAll').on('click', function (e) {
            e.preventDefault();
            $('input[type=checkbox]').prop('checked', true);
        });
        $('#selectNone').on('click', function (e) {
            e.preventDefault();
            $('input[type=checkbox]').prop('checked', false);
        });
    </script>
@endsection