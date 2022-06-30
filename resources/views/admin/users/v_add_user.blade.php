@extends('layouts.v_adminlte')
@section('title', 'Add User')

@section('content')
<form action="/users/add/submit" method="post">
    
    @csrf
    {{-- @crsf is equivalent to --}}
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

    <div class="container">
      <div class="row">
        <div class="col">
    
          <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" name="email" 
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}">
            <div class="invalid-feedback">
              @error('email'){{ $message }}@enderror
            </div>
          </div>
          
    
          <div class="form-group">
            <label for="input_password">Password: </label>
            <input type="password" name="input_password"
            class="form-control @error('input_password') is-invalid @enderror"
            value="{{ old('input_password') }}">
            <div class="invalid-feedback">
              @error('input_password'){{ $message }}@enderror
            </div>
          </div>


          <div class="form-group">
            <label for="confirm_password">Confirm Password: </label>
            <input type="password" name="confirm_password"
            class="form-control @error('confirm_password') is-invalid @enderror"
            value="{{ old('confirm_password') }}">
            <div class="invalid-feedback">
              @error('confirm_password'){{ $message }}@enderror
            </div>
          </div>
    
    
          <div class="form-group">
            <label for="address">Address: </label>
            <input type="text" name="address"
            class="form-control @error('address') is-invalid @enderror"
            value="{{ old('address') }}">
            <div class="invalid-feedback">
              @error('address'){{ $message }}@enderror
            </div>
          </div>


          <div class="form-group">
            <label for="phone_number">Phone Number: </label>
            <input type="text" name="phone_number"
            class="form-control @error('phone_number') is-invalid @enderror"
            value="{{ old('phone_number') }}">
            <div class="invalid-feedback">
              @error('phone_number'){{ $message }}@enderror
            </div>
          </div>
          
    
          <div class="form-group">
            <button class="btn btn-primary btn-md" type="submit">Submit</button>
            <a href="/users" class="btn btn-secondary btn-md">Back</a>
          </div>
    
        </div>
      </div>
    </div>

  </form>
@endsection