@extends('layouts.default')

@section('main')
        <div class="container">

        <div class="row">

        	<!-- Sidebar -->
			@include('layouts.sidebar')

            <!-- Blog Entries Column -->
            <div class="col-md-9">
            <form method="post" action={{url('/profile')}} >
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
	       			<div class="col-lg-3"><h4>Upload portrait here</h4></div>
	       		</div>
	       		<div class="row">
		       		<div class="col-lg-5"></div>
		       			<div class="col-lg-4">
		            		<span class="image featured"><img src="images/blog19.jpg" height="200" width="200" alt="" /></span>
		            			<label class="control-label"></label>
		            			<input id="image" type="file" class="manual-file-chooser js-manual-file-chooser js-avatar-field">		      	
		            	</div>
            	</div>
            	<br><br>
           
            	<div class="row">
            		<div class="col-lg-1"></div>
	       			<div class="col-lg-3"><h4>Name</h4></div>
	       			<div class="col-lg-4">
	       				<div class="form-group">
	       					<label class="sr-only" for="Name">Name</label>
	       					<input type="text" name="name" class="form-control" placeholder= {{ ($profile==null) ? "Name" : $profile->user->name }}>
	       				</div>
	       			</div>
            	</div>
            	
            	<br>
            	<div class="row">
            		<div class="col-lg-1"></div>
	       			<div class="col-lg-3"><h4>Sex</h4></div>
	       			<div class="col-lg-5">
	       				<div class="radio">
	       					<label class="radio-inline">
	       					  <input type="radio" name="sex" value="male" checked= {{ ($profile==null || $profile->sex =="female") ? "false" : "true" }}> male
	       					</label>
	       					<label class="radio-inline">
	       					  <input type="radio" name="sex" value="female" checked = {{ ($profile!=null && $profile->sex =="male") ? "false" : "true"  }}> female
	       					</label>
	       				</div>
	       			</div>
            	</div>

            	<br>
            	<div class="row">
            		<div class="col-lg-1"></div>
	       			<div class="col-lg-3"><h4>Location</h4></div>
	       			<div class="col-lg-4">
	       				<div class="form-group">
		       				<label for="Location">Country</label>
		       				<input type="text" class="form-control" name="country" placeholder={{ ($profile==null) ? "e.g.China" : $profile->country}}>
	       				</div>
	       				<div class="form-group">
		       				<label for="Location">City</label>
		       				<input type="text" class="form-control" name="city" placeholder={{ ($profile==null) ? "e.g.Beijing" : $profile->city}}>
	       				</div>
	       			</div>
            	</div>

            	<br>
            	<div class="row">
            		<div class="col-lg-1"></div>
	       			<div class="col-lg-3"><h4>Phone Number</h4></div>
	       			<div class="col-lg-4">
	       				<div class="form-group">
		       				<label class="sr-only" for="Phone Number">Phone Number</label>
		       				<input type="text" class="form-control" name="phone" placeholder={{ ($profile==null) ? "9175202986" : $profile->phone}}>
	       				</div>	       							
	       			</div>
            	</div>

            	<br>
            	<div class="row">
            		<div class="col-lg-1"></div>
	       			<div class="col-lg-3"><h4>Description</h4></div>
	       			<div class="col-lg-6">
	       				<div class="form-group">
		       				<label class="sr-only" for="Description">Description</label>
		       				<textarea name="description" class="form-control" id="description" rows="6" placeholder= {{ (($profile==null) ? "description" : $profile->description) }} ></textarea>
		       			</div>		
	       			</div>
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