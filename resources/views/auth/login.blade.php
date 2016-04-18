@extends('layouts.master')
@section('sidebar')
    @parent
@endsection

@section('content')
<div class="login-card">
    <h1>Log-in</h1><br>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}
            Email <input type="text" name="email" value="{{ old('email')}}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            Password <input type="password" name="password" placeholder="Password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <input type="submit" name="login" class="login login-submit" value="login">
            
        </form>
        
        <div class="login-help">
            <a href="register">Register</a> • <a href="{{ url('/password/reset') }}">Forgot Password</a>
        </div>
</div>

<!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div> -->
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>

@endsection