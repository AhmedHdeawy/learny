@extends('layouts.app')

@section('content')

<div class="container contact-form">
    <div class="contact-image">
        <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
    </div>

    <a class="nav-link" href="{{ str_replace( '/'.$localeLang,  '/'.$localeLangInverse, url()->full() ) }}">
                            <i class="fa fa-globe"></i> 
                            {{ __('lang.'.$localeLangInverse.'.inverse') }}
                        </a>

    @if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif

	@if (session('status'))
	    <div class="alert alert-success">
	        <ul>
	            <li>{{ session('status') }}</li>
	            
	        </ul>
	    </div>
	@endif

    <form method="post" action="{{ route('postContactUs') }}">
    	{{ csrf_field() }}
        <h3>Drop Us a Message</h3>
       <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name *" value="" />
                </div>
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Your Email *" value="" />
                </div>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control" placeholder="Your Phone Number *" value="" />
                </div>
                <div class="form-group">
                    <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea name="message" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                </div>
            </div>
        </div>
    </form>
	
	<div class="col-12 mt-5">		
		<h3>iOS Support & FAQ</h3>
	</div>
    
    <div class="accordion pb-3" id="accordionExample">
		  <div class="card">
		    <div class="card-header" id="headingOne">
		      <h5 class="mb-0">
		        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		          How do i get an account in iView App?
		        </button>
		      </h5>
		    </div>

		    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
		      <div class="card-body">
		        Send Message via Email, contain your Mobile Number to create an account for you and send sms contains Entry Code and Password
		      </div>
		    </div>
		  </div>
		  <div class="card">
		    <div class="card-header" id="headingTwo">
		      <h5 class="mb-0">
		        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          Can i search for videos in iView App?
		        </button>
		      </h5>
		    </div>
		    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
		      <div class="card-body">
		        yes, you can do this through Search input that exist in App Bar in top of application, type the word and hit enter
		      </div>
		    </div>
		  </div>
		  <div class="card">
		    <div class="card-header" id="headingThree">
		      <h5 class="mb-0">
		        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
		          How do i delete my Account?
		        </button>
		      </h5>
		    </div>
		    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
		      <div class="card-body">
		        Send Message via Email, contain your Mobile Number and we will delete your account?
		      </div>
		    </div>
		  </div>
	</div>
</div>



@endsection
