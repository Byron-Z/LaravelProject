<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Contact - Blog </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/main.css')}}" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<h1><a href="{{ url('/index') }}">Blog<a></h1>
					<nav id="nav">
						<ul>
							<li><a href="{{ url('/home') }}">Home</a></li>
							<li><a href="{{ url('/contact') }}">Contact</a></li>
							@if (Auth::guest())
                                  <li><a href="{{ url('/register') }}" class="button">Sign Up</a></li>
                            @else
                                  <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                          {{ Auth::user()->name }} <span class="caret"></span>
                                      </a>

                                      <ul class="dropdown-menu" role="menu">
                                          <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                      </ul>
                                  </li>
                            @endif
						</ul>
					</nav>
				</header>

			<!-- Main -->
				<section id="main" class="container 75%">
					<header>
						<h2>Contact Us</h2>
						<p>Tell us what you think about our website.</p>
					</header>
					<div class="box">
						<form method="post" action="{{ url('/contact') }}">
							{!! csrf_field() !!}
							<div class="row uniform 50%">
								<div class="6u 12u(mobilep)">
									<input type="text" name="name" id="name" value="{{ old('name')}}" placeholder="Name" />
								</div>
								<div class="6u 12u(mobilep)">
									<input type="email" name="email" id="email" value="{{ old('email')}}" placeholder="Email" />
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u">
									<input type="text" name="subject" id="subject" value="{{ old('subject')}}" placeholder="Subject" />
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u">
									<textarea name="message" id="message" value="{{ old('message')}}" placeholder="Enter your message" rows="6"></textarea>
								</div>
							</div>
							<div class="row uniform">
								<div class="12u">
									<ul class="actions align-center">
										<li><input type="submit" value="Send Message" /></li>

									</ul>
								</div>
							</div>
						</form>
					</div>
					<p>
						<font size="+1" face="Verdana" color="black">
							{{$msg}}
						</font>
					</p>
				</section>



			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>