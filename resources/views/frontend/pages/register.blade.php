@extends('frontend.new_layouts.master')
@section('title')
Register
@endsection
@section('content')
<div class="d-flex flex-column-fluid welcome">
  <div class="container">
      <div class="card card-custom">
          <div class="card-header">
              <h3 class="card-title">{{ __('REGISTER HERE ') }}</h3>
              <div class="card-toolbar">
                  <div class="example-tools justify-content-center">
                      <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                      <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                  </div>
                
              </div>
          </div>

          <form method="POST" action="{{ route('user-register') }}" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                  <div class="row">
                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('First_name') }} <span class="text-danger">*</span></label>
                              <input type="text" name="first_name" class="form-control"
                                  placeholder="Enter First Name" value="{{ old('Username') }}" required>

                              @error('first_name')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Last_Name') }} <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" placeholder="Enter last Name"
                                  name="last_name" value="{{ old('last_name') }}" required />
                              @error('last_name')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Username') }} <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" placeholder="Enter Username"
                                  name="username" value="{{ old('Username') }}" required />
                              @error('username')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Email') }} <span class="text-danger">*</span></label>
                              <input type="email" class="form-control" placeholder="Enter Email" name="email"
                                  value="{{ old('email') }}" required />
                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Date of Birth') }} <span class="text-danger">*</span></label>
                              <input type="date" class="form-control" name="date_of_birth"
                                  value="{{ old('date_of_birth') }}" required />
                              @error('date_of_birth')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Gender') }} <span class="text-danger">*</span></label>
                              <select name="gender" class="form-control" required>
                                  <option selected="selected" disabled="disabled" value="">
                                      {{ __('Select Gender') }}</option>
                                  <option value='male'>Male</option>
                                  <option value='female'>Female</option>
                              </select>
                              @error('gender')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Placement') }} <span class="text-danger">*</span></label>
                              <select name="placement" class="form-control" required>
                                  <option selected="selected" disabled="disabled" value="">
                                      {{ __('Select Placement') }}</option>
                                  <option value='1'>Left</option>
                                  <option value='2'>Right</option>
                              </select>
                              @error('placement')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Country') }} <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" placeholder="Enter Country" name="country"
                                  value="{{ old('country') }}" required />
                              @error('country')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('City') }} <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" placeholder="Enter City" name="city"
                                  value="{{ old('city') }}" required />
                              @error('city')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('State') }} <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" placeholder="Enter State" name="state"
                                  value="{{ old('state') }}" required />
                              @error('state')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Zip Code') }} <span class="text-danger">*</span></label>
                              <input type="number" class="form-control" placeholder="Enter Zipcode"
                                  name="zip_code" value="{{ old('Username') }}" required />
                              @error('State')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Address') }} <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" placeholder="Enter Address" name="address"
                                  value="{{ old('address') }}" required />
                              @error('address')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                              <input type="number" class="form-control" placeholder="Enter Name"
                                  name="phone_number" value="{{ old('phone_number') }}" required />
                              @error('phone_number')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Cnic Number') }} <span class="text-danger">*</span></label>
                              <input type="number" class="form-control" placeholder="Enter Cnic Number" name="cnic"
                                  value="{{ old('cnic') }}" required />
                              @error('cnic')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>
      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Payment Process') }} <span class="text-danger">*</span></label>
                              <select name="payment_process" class="form-control" required>
                                  <option selected="selected" disabled="disabled" value="">
                                      {{ __('Select Payment Process') }}</option>
            @foreach ($payment_methods as $method)
              <option value="{{ $method->id }}">{{ $method->name }}</option>
              
            @endforeach
                              </select>
                              @error('payment_process')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>
      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __("Sponser I'd") }} <span class="text-danger">*</span></label>
                              <input type="number" class="form-control" placeholder="Enter Sponser I'd" name="sponser_id"
                                  value="{{ old('sponser_id') }}" required />
                              @error('sponser_id')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>
      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __("Mother Name") }} <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" placeholder="Enter Mother Name" name="mother_name"
                                  value="{{ old('mother_name') }}" required />
                              @error('mother_name')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>
      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __("Favaourite Pet") }} <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" placeholder="Enter Favaourite Pet" name="favourite_pet"
                                  value="{{ old('favourite_pet') }}" required />
                              @error('favourite_pet')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Password') }}<span class="text-danger">*</span></label>
                              <input type="password" class="form-control" placeholder="Enter Password"
                                  name="password" value="{{ old('password') }}" required />
                              @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="col-6">
                          <div class="form-group">
                              <label>{{ __('Confirm Password') }} <span
                                      class="text-danger">*</span></label>
                              <input type="password" class="form-control" placeholder="Confirm Password"
                                  name="password_confirmation"
                                  value="{{ old('password_confirmation') }}" required />
                              @error('password_confirmation')
                                  <span class="invalid-feedback" role="alert">
                                      {{ $message }}
                                  </span>
                              @enderror
                          </div>
                      </div>
                  </div>
              </div>
              <div class="card-footer" style="text-align: start">
                  <p> Already have Account? </p>
                  <a href="{{ route('login') }}" class="btn btn-primary mr-2">{{ __('Login') }}</a>
                  
              </div>
              <div class="card-footer" style="text-align: end">
                  <button type="submit" class="btn btn-primary mr-2">{{ __('Register') }}</button>
                  <button type="reset" class="btn btn-secondary">{{ __('Reset') }}</button>
              </div>
          </form>
      </div>
  </div>
</div>

@endsection

