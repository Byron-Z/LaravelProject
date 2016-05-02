@extends('layouts.default')

@section('main')
        <div class="container">

        <div class="row">

        	<!-- Sidebar -->
			@include('layouts.sidebar')

            <!-- Blog Entries Column -->
            <div class="col-md-9">
            <form method="post" action="{{url('/profile')}}" enctype="multipart/form-data" >
            	{!! csrf_field() !!}
            	<div class="row">
	            	<div class="col-md-4"></div>
	            	<div class="col-md-5">
	            	<h3>{{$reminder}}</h3>
	            	</div>
            	</div>
            	<br>  	
            	<div class="row">
	            	<div class="col-lg-1"></div>
	       			<div class="col-lg-3"><h4>Upload portrait here *</h4></div>
	       		</div>
	       		<div class="row">
		       		<div class="col-lg-5"></div>
		       			<div class="col-lg-4">
		            		<span class="image featured"><img src={{($userProfile==null)? "images/blog19.jpg" : $userProfile->portrait}} height="200" width="200" alt="" /></span>
		            			<label class="control-label"></label>
		            			<input id="image" type="file" name="image" class="manual-file-chooser js-manual-file-chooser js-avatar-field">		      	
		            	</div>
            	</div>
            	<br><br>
           
            	<div class="row">
            		<div class="col-lg-1"></div>
	       			<div class="col-lg-3"><h4>Name *</h4></div>
	       			<div class="col-lg-4">
	       				<div class="form-group">
	       					<label class="sr-only" for="Name">Name</label>
	       					<input type="text" name="name" class="form-control" placeholder= {{ ($userProfile==null) ? "Name" : $userProfile->user->name }}>
	       					@if ($errors->has('name'))
	       					    <span class="help-block" style="color:red">
	       					        <strong>{{ $errors->first('name') }}</strong>
	       					    </span>
	       					@endif		
	       				</div>
	       			</div>
	       			<!-- <div class="col-lg-1"><h4>*<h4></div> -->
            	</div>
            	
            	<br>
            	<div class="row">
            		<div class="col-lg-1"></div>
	       			<div class="col-lg-3"><h4>Sex *</h4></div>
	       			<div class="col-lg-5">
	       				<div class="radio">
	       					<label class="radio-inline">
	       					  <input type="radio" name="sex" value="male" checked= {{ ($userProfile==null || $userProfile->sex =="female") ? "false" : "true" }}> male
	       					</label>
	       					<label class="radio-inline">
	       					  <input type="radio" name="sex" value="female" checked = {{ ($userProfile!=null && $userProfile->sex =="male") ? "false" : "true"  }}> female
	       					</label>
	       				</div>
	       			</div>
            	</div>

            	<br>
            	<div class="row">
            		<div class="col-lg-1"></div>
	       			<div class="col-lg-3"><h4>Location *</h4></div>
	       			<div class="col-lg-4">
	       				<div class="form-group">
		       				<label for="Location">Country</label>
		       				<input type="text" class="form-control" name="country" placeholder={{ ($userProfile==null) ? "e.g.China" : $userProfile->country}}>
		       				@if ($errors->has('country'))
		       				    <span class="help-block" style="color:red">
		       				        <strong>{{ $errors->first('country') }}</strong>
		       				    </span>
		       				@endif
	       				</div>
	       				<div class="form-group">
		       				<label for="Location">City</label>
		       				<input type="text" class="form-control" name="city" placeholder={{ ($userProfile==null) ? "e.g.Beijing" : $userProfile->city}}>
		       				@if ($errors->has('city'))
		       				    <span class="help-block" style="color:red">
		       				        <strong>{{ $errors->first('city') }}</strong>
		       				    </span>
		       				@endif
	       				</div>
	       			</div>

            	</div>

            	<br>
            	<div class="row">
            		<div class="col-lg-1"></div>
	       			<div class="col-lg-3"><h4>Phone Number *</h4></div>
	       			<div class="col-lg-4">
	       				<div class="form-group">
		       				<label class="sr-only" for="Phone Number">Phone Number</label>
		       				<input type="text" class="form-control" name="phone" placeholder={{ ($userProfile==null) ? "9175202986" : $userProfile->phone}}>
		       				@if ($errors->has('phone'))
		       				    <span class="help-block" style="color:red">
		       				        <strong>{{ $errors->first('phone') }}</strong>
		       				    </span>
		       				@endif
	       				</div>	       							
	       			</div>
	       			<!-- <div class="col-lg-1"><h4>*<h4></div> -->
            	</div>

            	<br>
            	<div class="row">
            		<div class="col-lg-1"></div>
	       			<div class="col-lg-3"><h4>Description *</h4></div>
	       			<div class="col-lg-6">
	       				<div class="form-group">
		       				<label class="sr-only" for="Description">Description</label>
		       				<textarea name="description" class="form-control" id="description" rows="6" placeholder= {{ (($userProfile==null) ? "description" : $userProfile->description) }} ></textarea>
		       				@if ($errors->has('description'))
		       				    <span class="help-block" style="color:red">
		       				        <strong>{{ $errors->first('description') }}</strong>
		       				    </span>
		       				@endif
		       			</div>		
	       			</div>
	       			<!-- <div class="col-lg-1"><h4>*<h4></div> -->
            	</div>

            	<div class="row">
            		<div class="col-md-4"></div>
	            	<div class="col-md-5">
	            	<div class="form-group row">
	            	  <div class="col-md-4">
	            	    <button type="submit" class="btn btn-primary">Save</button>
	            	  </div>
	            	</div>
	            	</div>
            	</div>
            	</form>
            </div> 
        </div>
        </div>
@endsection