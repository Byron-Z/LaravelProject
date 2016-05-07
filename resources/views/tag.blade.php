@extends('layouts.default')

@section('main')
        <div class="container">

        <div class="row">

        	<!-- Sidebar -->
			@include('layouts.sidebar')

            <!-- Blog Entries Column -->
            <div class="col-md-9">
				<div class="panel panel-default">
				  <div class="panel-heading">Tag: {{$tag->name}}</div>
				  
				  <ul class="list-group">
					  	@if (isset($articles))
		                    @foreach ($articles as $article)
		                    <li class="list-group-item">
		                    	<a href="/blog/article?id={{$article->id}}">{{$article->title}}</a>
		                    	<span class="pull-right">{{$article->updated_at}}</span>
		                    </li>
							@endforeach
						@endif
					</ul>
				</div>
            </div>

        </div>
        <!-- /.row -->

    </div>

@stop