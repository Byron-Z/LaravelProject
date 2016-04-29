@extends('layouts.default')

@section('main')
        <div class="container">

        <div class="row">

        	<!-- Sidebar -->
			@include('layouts.sidebar')

            <!-- Blog Entries Column -->
            <div class="col-md-9">
                @if (isset($articles))
                    @for ($i = 0; $i < count($articles); $i++)
                    <h2>
                    <a href="#">{{$articles[$i]->title}}</a>
                    </h2>
                    <p>
                        <span class="glyphicon glyphicon-time"></span> Posted on {{$articles[$i]->created_at}}
                        &nbsp;&nbsp;
                        <span class="glyphicon glyphicon-time"></span> Updated on {{$articles[$i]->updated_at}}
                    </p>
                    <p>
                        <span class="glyphicon glyphicon-eye-open"></span> Read: {{$articles[$i]->read_count}}
                        &nbsp;&nbsp;
                        <span class="glyphicon glyphicon-comment"></span><a href="#"> Comments: {{$articles[$i]->comment_count}}</a>
                    </p>
                    <hr>
                    {!! $data[$i] !!}
                    
                    <hr>
                    <a class="btn btn-primary" href="/blog/article?id={{$articles[$i]->id}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>
                  @endfor
                
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        @if($articles->currentPage() > 1)
                        <a href="{{ $articles->previousPageUrl() }}">&larr; Previous</a>
                        @endif
                    </li>
                    <li class="next">
                        @if($articles->hasMorePages())
                        <a href="{{ $articles->nextPageUrl() }}">Next &rarr;</a>
                        @endif
                    </li>
                </ul>

            @endif
            </div>

        </div>
        <!-- /.row -->

    </div>
@stop