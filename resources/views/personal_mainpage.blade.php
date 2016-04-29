@extends('layouts.default')

@section('main')
        <div class="container">

        <div class="row">

        	<!-- Sidebar -->
			@include('layouts.sidebar')

            <!-- Blog Entries Column -->
            <div class="col-md-9">
                @if (isset($articles))
                  @foreach ($articles as $article)
                    <h2>
                    <a href="#">{{$article->title}}</a>
                    </h2>
                    <p>
                        <span class="glyphicon glyphicon-time"></span> Posted on {{$article->created_at}}
                        &nbsp;&nbsp;
                        <span class="glyphicon glyphicon-time"></span> Updated on {{$article->updated_at}}
                    </p>
                    <p>
                        <span class="glyphicon glyphicon-eye-open"></span> Read: {{$article->read_count}}
                        &nbsp;&nbsp;
                        <span class="glyphicon glyphicon-comment"></span><a href="#"> Comments: {{$article->comment_count}}</a>
                    </p>
                    <hr>
                    <!-- {!! $article->content !!} -->
                    {!! Parsedown::instance()->text($article->content) !!}
                    <hr>
                    <a class="btn btn-primary" href="/blog/article?id={{$article->id}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>
                  @endforeach
                @endif
                <!-- First Blog Post -->
                <!-- <h2>
                    <a href="#">Blog Post Title</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

        </div>
        <!-- /.row -->

    </div>
@stop