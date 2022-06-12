@extends('frontend.pages_layouts.master')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center ">
        <div class="col-md-8 " style="box-shadow: 0 0 1rem #cccc;">
            <div class="my-profile d-flex justify-content-between">
                <p class="">My Profile</p>
                <p><b>Date of Registtration:</b> {{ Auth::user()->created_at }}</p>
            </div>
            <div class="profile-box">
                <div class="user-img">
                    <img src="{{  user()->get_image() }}" class="img-fluid" alt="">
                    <h2 class="name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h2>
                   
                </div>
                <form class="main-form" method="POST" action="{{route('update-employee-details-page')}}" enctype="multipart/form-data">
                    @csrf 
                    <div class="profile-fields">
                        <div class="">
                            <label>MemberShip Account</label>
                            
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label><br>
                            <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}"  id="exampleFormControlInput1" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="username">UserName</label><br>
                            <input type="text" name="username" class="form-control" value="{{Auth::user()->username}}"  id="exampleFormControlInput1" placeholder="username" disabled >
                        </div>
                      
                        <div class="row">
                            <div class="col">
                                <label for="first_name">First Name</label><br>
                                <input type="text" name="first_name" class="form-control" value="{{Auth::user()->first_name}}" placeholder="First name" aria-label="First name">
                                @if ($errors->has('first_name'))
                                    <div> <span  class="text-danger" id="first_nameError">{{ $errors->first('first_name') }}</span></div>
                                @endif
                            </div>
                            <div class="col">
                                <label for="last_name">Last Name</label><br>
                                <input type="text" name="last_name" class="form-control" value="{{Auth::user()->last_name}}" placeholder="Last name" aria-label="Last name">
                                @if ($errors->has('last_name'))
                                 <div> <span  class="text-danger" id="last_nameError">{{ $errors->first('last_name') }}</span></div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col">
                                <label for="last_name">Whatsapp Number</label><br>
                                <input type="text" name="phone_number" value="{{Auth::user()->phone_number}}" class="form-control" placeholder="Number">
                                @if ($errors->has('last_name'))
                                 <div> <span  class="text-danger" id="last_nameError">{{ $errors->first('last_name') }}</span></div>
                                @endif
                            </div>
                        </div>
                         
                        <div class="main-form-control">
                            <label for="State">State</label><br>
                            <input type="text" name="state" class="form-control" value="{{Auth::user()->state}}"  placeholder="State">
                        </div>
                        <div class="main-form-control">
                            <label for="City">City</label><br>
                            <input type="text" name="city" class="form-control" value="{{Auth::user()->city}}" placeholder="City">
                        </div>
                        <div class="mb-3">
                            <label for="Street Address">Street Address</label><br>
                            <input type="text" name="address"  class="form-control" value="{{Auth::user()->address}}" id="exampleFormControlInput1" placeholder="Street Address">
                            @if ($errors->has('address'))
                                <div> <span  class="text-danger" id="addressError">{{ $errors->first('address') }}</span></div>
                            @endif  
                        </div>
                        <div class="form-actions right">
                            <button type="submit" class="btn btn-primary">
                              <i class="la la-check-square-o"></i> Save
                            </button>
                            <button type="button" class="btn btn-warning mr-1">
                              <i class="ft-x"></i> Cancel
                            </button>
                          </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection