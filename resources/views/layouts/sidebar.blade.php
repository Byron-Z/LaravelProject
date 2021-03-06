<!-- Blog Sidebar Widgets Column -->
<div class="col-md-3">
	<div class="well">
		<!-- SIDEBAR USERPIC -->
		<div class="profile-userpic">
			<img src={{($userProfile==null || $userProfile->portrait=="")? URL::asset("images/blog19.jpg") : URL::asset($userProfile->portrait)}} height="20" width="20" class="img-responsive" alt="">
		</div>
		<!-- END SIDEBAR USERPIC -->
		<!-- SIDEBAR USER TITLE -->
		<div class="profile-usertitle">
			<div class="profile-usertitle-name">
				{{ Auth::user()->name}}
			</div>
		</div>
		<!-- END SIDEBAR USER TITLE -->
		<!-- SIDEBAR BUTTONS -->
		<!-- <div class="profile-userbuttons">
			<button type="button" class="btn btn-success btn-sm">Follow</button>
			<button type="button" class="btn btn-danger btn-sm">Message</button>
		</div> -->
		<!-- END SIDEBAR BUTTONS -->
		<!-- SIDEBAR MENU -->
		<div class="profile-usermenu">
			<ul class="nav">
				<li {!! Request::is('blog') ? 'class="active"' : '' !!}>
					<a href="/blog" >
						<i class="glyphicon glyphicon-home"></i>
					Latest Post </a>
				</li>
				<li {!! Request::is('create') ? 'class="active"' : '' !!}>
					<a href="{{url('create')}}">
						<i class="glyphicon glyphicon-user"></i>
					Write Blog </a>
				</li>
				<li {!! Request::is('archives') ? 'class="active"' : '' !!}>
					<a href="{{url('/archives')}}">
						<i class="glyphicon glyphicon-ok"></i>
					Archives </a>
				</li>
				<li {!! Request::is('profile') ? 'class="active"' : '' !!}>
					<a href="{{url('/profile')}}">
						<i class="glyphicon glyphicon-flag"></i>
					About Me </a>
				</li>
				<li>
					<a href="mailto:{{Auth::user()->email}}" target="_top">
						<i class="glyphicon glyphicon-flag"></i>
					Contact Me </a>
				</li>
			</ul>
		</div>
		<!-- END MENU -->
	</div>
	<!-- Blog Search Well -->
	<form method="post" action="{{ url('/search')}}">
	{!! csrf_field() !!}
	<div class="well">
		<h4>Blog Search</h4>
		<div class="input-group">
			<input type="text" name="search" class="form-control" >
			<span class="input-group-btn">
				<button class="btn btn-default" type="submit">
				<span class="glyphicon glyphicon-search"></span>
				</button>
			</span>
		</div>
		<!-- /.input-group -->
	</div>
	</form>
	<!-- Blog Tags Well -->
	<div class="well">
		<h4>Blog Tags</h4>
<!-- 		<ul class="list-group">
			@if (isset($tags))
                @foreach ($tags as $tag)
  				<li class="list-group-item">
  					<span class="badge">{{$tag->count}}</span>
  					<a href="#">{{$tag->name}}</a>
				</li>
				@endforeach
			@endif
		</ul> -->
		@if (isset($sidebarTags))
            @foreach ($sidebarTags as $sidebarTag)
            <div class="row">
				<div class="col-lg-6">
					<a href="/tag?id={{$sidebarTag->id}}">{{$sidebarTag->name}}</a>
				</div>
				<div class="col-lg-3"></div>
				<div class="col-lg-3"><span class="badge">{{$sidebarTag->count}}</span></div>
			</div>
		<!-- /.row -->
			@endforeach
		@endif
	</div>
<!-- Side Widget Well -->
<div class="well">
<h4>Recent Posts</h4>
	
		@foreach ($recentPosts as $post)
		<div class="row">
				<div class="col-lg-10">
					<a href="/blog/article?id={{$post->id}}">{{$post->title}}</a>
				</div>
				<br>
		</div>
		@endforeach
	
</div>
</div>