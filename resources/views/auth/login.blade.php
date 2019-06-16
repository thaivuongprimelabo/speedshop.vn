@extends('layouts.app')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html">{!! trans('auth.login_page_title') !!}</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">
    </p>

    <form action="{{ route('login') }}" method="post">
      {{ csrf_field() }}
      <div class="form-group has-feedback @if ($errors->has('email')){{'has-error'}} @endif">
        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('auth.email_placeholder') }}" />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))<span class="help-block">{{ $errors->first('email') }}</span>@endif
      </div>
      <div class="form-group has-feedback @if ($errors->has('password')){{'has-error'}} @endif">
        <input id="password" type="password" class="form-control" name="password" placeholder="{{ trans('auth.password_placeholder') }}" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))<span class="help-block">{{ $errors->first('password') }}</span>@endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('auth.remember_me') }}
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth.button.login') }}</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
@endsection
