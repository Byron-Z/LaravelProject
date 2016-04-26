@extends('layouts.master')
@section('sidebar')
    @parent
@endsection

@section('content')
<div class="login-card">
    <h1>Register</h1><br>
      <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label class="sr-only" for="InputName">Name</label>
          <input type="text" name="name" value="{{ old('name')}}" placeholder="username">
            @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label class="sr-only" for="InputEmail">Email</label>
          <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="example@gmail.com">
            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>      
            @endif
        </div>


        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label class="sr-only" for="InputPassword">Password</label>
          <input type="password" class="form-control" name="password" placeholder="password">
            @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          <label class="sr-only" for="InputPassword">Password</label>
          <input type="password" class="form-control" name="password_confirmation" placeholder="confirm password">
            @if ($errors->has('password_confirmation'))
              <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
              </span>
            @endif
        </div>
        <label class="sr-only" for="submit">Submit</label>
        <input type="submit" name="register" class="login login-submit" value="Register">
      </form>
    
      <div class="login-help">
        <a href="login">Login</a> • <a href="{{ url('/password/reset') }}">Forgot Password</a>
      </div>
    </div>
 

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

<!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div> -->
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
@endsection