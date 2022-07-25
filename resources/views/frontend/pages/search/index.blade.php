@extends('frontend.pages_layouts.master') 
@section('title') 
Search  Sponser
@endsection
  @section('content')
   

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
        <div class="content-body">    
           
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">
                                    {{ __('Search Sponser') }}
                                    
                                </h3>
                                
                            </div>
                            
                        </div>
                        <div class="card-body pb-0">
                            <fieldset class="form-group position-relative mb-0">
                              <input type="text" class="form-control form-control-xl input-xl" name="search" id="search"  oninput="fetch_customer_data(this.value)" placeholder="Search Sponser here ...">
                              <div class="form-control-position">
                                <i class="ft-search font-medium-4"></i>
                              </div>
                            </fieldset>
                          </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        
                                        <th>{{ __('User Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Link') }}</th>
                                      
                                        
                                    </tr>
                                </thead>
                                <tbody class="search">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
       
        </div> 
</div>
<script>
    function fetch_customer_data(query = '')
		 {
		 
	   $.ajax({
	   url:"{{ route('search_sponser') }}",
	   method:'GET',
	   data:{query:query},
	   dataType:'json',
	   success:function(data)
	   {
		   var less = ` <tr>
					<td class="w-100">
						<h6>No users Found against this search</h6>
						</td>
				</tr> `
		   if(data.length > 0){
            
				var html=''
				data.forEach((user)=>{
                        
						html += `
							<tr>
                                            
                                            <td>${ user.username }</td>
                                            <td>${ user.email }</td>
                                            <td> <a href="{{route('user-profile','')}}/${user.id} }}" target="_blank"> {{url()->route('user-profile','')}}/${user.id} </a></td>

							</tr>
													
						`;
				})
				$('.search').html(html);
		   }else{
				   $('.search').html(less);
		   }
	
	   
	   }
	  })
	 }

</script>
@endsection