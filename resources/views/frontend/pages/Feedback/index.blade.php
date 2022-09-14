@extends('frontend.pages_layouts.master') 
@section('title') 
Feedback
@endsection
  @section('content')
   

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
        <div class="content-body">    
           
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="col-12">	
                        <div class="card ">
                            <div class="section-header m-2">
                                <h1><i class="fa fa-fw fa-cash-register"></i> Feedback Form</h1> 
                            </div>
                                <form method="POST" action="{{ route('feedback.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mx-2">
                                        <label for="fsubject">Subject</label>
                                        <input type="text" name="subject" id="fsubject" class="form-control" value="" placeholder="Subject" required>
                                    </div>
                                    <div class="form-group mx-2">
                                        <label for="fsubject">Message</label>
                                        <textarea class="form-control" rows="5" name="message" placeholder="Enter your Message"></textarea>
                                    </div>
                                    <div class="form-group mx-2">
                                        <label for="fsubject">Attach File</label>
                                        <input type="file" name="image"  class="form-control" value="">
                                    </div>
                                    <div class="form-group mx-2">
                                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-success">
                                             Send Message
                                        </button>
                                    </div>
                                    
                                </form>
                        </div>
                    </div>
                                
                </div>
            </div>
        </div>
    </div>
  </div>


