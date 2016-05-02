<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="http://project.app">F&B</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{url('/')}}">About Us <span class="sr-only">(current)</span></a></li>
      </ul>
      
      <!-- <form class="navbar-form navbar-left" role="search">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </div>
      </form> -->
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{url('/contact')}}">Contact Us</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{url('/profile')}}" class="fa fa-user">  Profile</a></li>
            <li><a href="#" class="fa fa-cogs">  Setting</a></li>
            <li><a href="#" class="fa fa-bell">  Notifications</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ url('/logout') }}" class="fa fa-sign-out">  Log Out</a></li>
          </ul>
        </li>
      </ul>
      </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>