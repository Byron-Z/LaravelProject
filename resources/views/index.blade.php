<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Fancy Blog</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="landing">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt">
					<img src="{{URL::asset("images/logo.png")}}" alt="Fancy Blog">
					<nav id="nav">
						<ul>
							<li><a href="{{ url('/blog') }}">Home</a></li>
							<li><a href="{{ url('/contact') }}">Contact</a></li>
							@if (Auth::guest())
							      <li><a href="register" class="button">Sign Up</a></li>
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

			<!-- Banner -->
				<section id="banner">
					<h2>Fancy Blog</h2>
					<p>A light weight and free Blog site for you.</p>
					<ul class="actions">
						<li><a href="{{ url('/login') }}" class="button">Sign in</a></li>
						<li><a href="{{ url('/register') }}" class="button special">Sign Up</a></li>
					</ul>
				</section>

			<!-- Main -->
				<section id="main" class="container">

					<section class="box special">
						<header class="major">
							<h2>Introducing few cool things 
							<br />
							you can do with our Free Blog Site</h2>
							<p>Create a fancy Blog with our website. You can post blog, add friends<br />
							and communicate with each other ! Come and join us.</p>
						</header>
						<span class="image featured"><img src="images/blog14.jpg" height="300" width="150" alt="" /></span>
					</section>

					<section class="box special features">
						<div class="features-row">
							<section>
								<span class="image featured"><img src="images/blog11.jpg" height="288" width="150" alt="" /></span>
								<h3>Post Blog</h3>
								<p>Just one click to publish your first blog!</p>
							</section>
							<section>
								<span class="image featured"><img src="images/blog5.jpg" height="288" width="150" alt="" /></span>
								<h3>Add Friends</h3>
								<p>Explore a new word with your friends.</p>
							</section>
						</div>
						<div class="features-row">
							
							<section>
								<span class="image featured"><img src="images/blog13.jpg" height="200" width="150" alt="" /></span>
								<h3>Set Profile</h3>
								<p>Set your pesonal information here.</p>
							</section>
							<section>
								<span class="image featured"><img src="images/blog6.jpg" height="200" width="150" alt="" /></span>
								<h3>Comments</h3>
								<p>A good place to exchange ideas with friends.</p>
							</section>
						</div>
					</section>
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