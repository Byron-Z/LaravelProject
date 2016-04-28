<!-- Blog Sidebar Widgets Column -->
<div class="col-md-3">
	<div class="well">
		<!-- SIDEBAR USERPIC -->
		<div class="profile-userpic">
			<img src="" class="img-responsive" alt="">
		</div>
		<!-- END SIDEBAR USERPIC -->
		<!-- SIDEBAR USER TITLE -->
		<div class="profile-usertitle">
			<div class="profile-usertitle-name">
				{{Auth::user()->name}}
			</div>
		</div>
		<!-- END SIDEBAR USER TITLE -->
		<!-- SIDEBAR BUTTONS -->
		<div class="profile-userbuttons">
			<button type="button" class="btn btn-success btn-sm">Follow</button>
			<button type="button" class="btn btn-danger btn-sm">Message</button>
		</div>
		<!-- END SIDEBAR BUTTONS -->
		<!-- SIDEBAR MENU -->
		<div class="profile-usermenu">
			<ul class="nav">
				<li class="active">
					<a href="#">
						<i class="glyphicon glyphicon-home"></i>
					Latest Post </a>
				</li>
				<li>
					<a href="{{url('create')}}">
						<i class="glyphicon glyphicon-user"></i>
					Write Blog </a>
				</li>
				<li>
					<a href="#" target="_blank">
						<i class="glyphicon glyphicon-ok"></i>
					Archives </a>
				</li>
				<li>
					<a href="#">
						<i class="glyphicon glyphicon-flag"></i>
					About Me </a>
				</li>
				<li>
					<a href="#">
						<i class="glyphicon glyphicon-flag"></i>
					Contact Me </a>
				</li>
			</ul>
		</div>
		<!-- END MENU -->
	</div>
	<!-- Blog Search Well -->
	<div class="well">
		<h4>Blog Search</h4>
		<div class="input-group">
			<input type="text" class="form-control">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button">
				<span class="glyphicon glyphicon-search"></span>
				</button>
			</span>
		</div>
		<!-- /.input-group -->
	</div>
	<!-- Blog Tags Well -->
	<div class="well">
		<h4>Blog Tags</h4>
		<!-- <ul class="list-group">
			@if (isset($tags))
                @foreach ($tags as $tag)
  				<li class="list-group-item">
  					<span class="badge">{{$tag->count}}</span>
  					<a href="#">{{$tag->name}}</a>
				</li>
				@endforeach
			@endif
		</ul> -->
		@if (isset($tags))
            @foreach ($tags as $tag)
            <div class="row">
				<div class="col-lg-6">
					<a href="#">{{$tag->name}}</a>
				</div>
				<div class="col-lg-3"></div>
				<div class="col-lg-3"><span class="badge">{{$tag->count}}</span></div>
			</div>
		<!-- /.row -->
			@endforeach
		@endif
	</div>
<!-- Side Widget Well -->
<div class="well">
<h4>Side Widget Well</h4>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
</div>
</div>