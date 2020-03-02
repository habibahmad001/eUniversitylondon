@extends('layouts.app')

@section('content')

@include('blocks.sub-header')
@include('blocks.left-menu')

<div class="center-content-area">
  <form method="post" action="{{ URL::to('/users/'.Auth::user()->id) }}" onsubmit="return validate()" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="PUT">

    <div class="information-form">
      <div class="left-box">
        <div class="form-line">
          <label>First Name <span>*</span></label>
          <div class="field-container">
            <input type="text" value="{{ $user->first_name }}" name="first_name" id="first_name" placeholder="First Name" required>
            <span class="error-message" id="fname_error">Please provide first name.</span>
          </div>
        </div>
        <div class="form-line">
          <label>Last Name <span>*</span></label>
          <div class="field-container">
            <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}" placeholder="Last Name" required>
            <span class="error-message" id="lname_error">Please provide last name.</span>
          </div>
        </div>
        <div class="form-line">
          <label>Email <span>*</span></label>
          <div class="field-container">
            <input type="email" name="email" id="email" value="{{ $user->email }}" placeholder="Email" required>
            <span class="error-message" id="email_error">Please provide a valid email.</span>
          </div>
        </div>

        <div class="form-line">
          <label>Avatar</label>
          <div class="field-container">
            <input id="avatar-1" name="avatar" type="file">
            <span><img src="{{URL::asset('/uploads/avatars/')}}/{{ $user->avatar }}"></span>
          </div>
        </div>

        <div class="form-line">
          <label>Password</label>
          <div class="field-container">
            <input type="password" name="password" id="password" value="" placeholder="Password">
            <span class="error-message" id="password_error">Password not match</span>
          </div>
        </div>

        <div class="form-line">
          <label>Confirm password</label>
          <div class="field-container">
            <input type="password" name="password_confirmation" id="password_confirmation" value="" placeholder="Confirm password">
          </div>
        </div>
        
      </div>
      <div class="form-footer">
        <div class="button-container">
          <a href="{{ URL::to('/') }}" class="cancel-button">Cancel</a>
          <input type="submit" value="Save Changes" name="submit" class="save-changes">
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
@section('js_libraries')
  <script type="text/javascript" src="{{ asset('js/account.js')}}"></script>
@endsection
