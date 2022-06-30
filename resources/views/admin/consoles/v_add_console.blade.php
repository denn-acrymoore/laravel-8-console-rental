@extends('layouts.v_adminlte')
@section('title', 'Add Console')

@section('content')
<form action="/consoles/add/submit" method="post" enctype="multipart/form-data">
    
    @csrf
    {{-- @crsf is equivalent to --}}
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

    <div class="container">
      <div class="row">
        <div class="col">
    
          <div class="form-group">
            <label for="name">Console Name: </label>
            <input type="text" name="name" 
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') }}">
            <div class="invalid-feedback">
              @error('name'){{ $message }}@enderror
            </div>
          </div>
    
    
          <div class="form-group">
            <label for="type">Type: </label>
    
            <div class="form-check">
              <input class="form-check-input" type="radio" name="type" id="option_nintendo" 
              value="nintendo" 
              @if (old('type') === "nintendo") 
                  checked
              @endif>
              <label class="form-check-label" for="option_nintendo">
                Nintendo
              </label>
            </div>
    
            <div class="form-check">
              <input class="form-check-input" type="radio" name="type" id="option_playstation" 
              value="playstation" 
              @if (old('type') === "playstation") 
                  checked
              @endif>
              <label class="form-check-label" for="option_playstation">
                Playstation
              </label>
            </div>
    
            <div class="form-check">
              <input class="form-check-input" type="radio" name="type" id="option_xbox" 
              value="xbox" 
              @if (old('type') === "xbox") 
                  checked
              @endif>
              <label class="form-check-label" for="option_xbox">
                Xbox
              </label>
            </div>
    
            <div class="text-danger" style="font-size: 13px">
                @error('type'){{ $message }}@enderror
            </div>
          </div>
          
    
          <div class="form-group">
            <label for="price_per_day">Price Per Day (Rupiah): </label>
            <input type="number" name="price_per_day"
            class="form-control @error('price_per_day') is-invalid @enderror"
            value="{{ old('price_per_day') }}">
            <div class="invalid-feedback">
              @error('price_per_day'){{ $message }}@enderror
            </div>
          </div>
    
    
          <div class="form-group">
            <label for="qty">Quantity: </label>
            <input type="number" name="qty"
            class="form-control @error('qty') is-invalid @enderror"
            value="{{ old('qty') }}">
            <div class="invalid-feedback">
              @error('qty'){{ $message }}@enderror
            </div>
          </div>
    
    
          <div class="form-group">
            <label for="description">Description (semicolon symbol (;) will be used as newline): </label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
            rows="4" cols="50"
            maxlength="240">{{ old('description') }}</textarea>
            <div class="invalid-feedback">
              @error('description'){{ $message }}@enderror
            </div>
          </div>
          
    
          <div class="form-group">
            <label for="picture">Console Picture: </label>
            <input type="file" name="picture" 
            class="form-control-file @error('picture') is-invalid @enderror">
            <div class="invalid-feedback">
              @error('picture'){{ $message }}@enderror
            </div>
          </div>
          
    
          <div class="form-group">
            <button class="btn btn-primary btn-md" type="submit">Submit</button>
            <a href="/consoles" class="btn btn-secondary btn-md">Back</a>
          </div>
    
        </div>
      </div>
    </div>

  </form>
@endsection