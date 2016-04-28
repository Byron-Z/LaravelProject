@extends('layouts.default')

@section('main')
        <div class="container">

        <div class="row">
        	<!-- Sidebar -->
			@include('layouts.sidebar')
			<div class="col-md-9">

				@if (isset($article))
				 	<h2>{{$article[0]->title}}</h2>
                    <p>
                        <span class="glyphicon glyphicon-time"></span> Posted on {{$article[0]->created_at}}
                        &nbsp;&nbsp;
                        <span class="glyphicon glyphicon-time"></span> Updated on {{$article[0]->updated_at}}
                        &nbsp;&nbsp;
                        <span class="glyphicon glyphicon-eye-open"></span> Read: {{$article[0]->read_count}}
                        <a href="/blog/article/{{$article[0]->id}}/edit" class="btn btn-success btn-sm pull-right" role="button">Edit</a>
                    </p>
                    <hr>
                    {!! $article[0]->content !!}
                    <hr>
				 @endif
				 <br><br><br>
				 <div id="disqus_thread"></div>
				 <script>


				 /**
				 * RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
				 * LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
				 */
				 /*
				 var disqus_config = function () {
				 this.page.url = PAGE_URL; // Replace PAGE_URL with your page's canonical URL variable
				 this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
				 };
				 */
				 (function() { // DON'T EDIT BELOW THIS LINE
				 var d = document, s = d.createElement('script');

				 s.src = '//projectapp.disqus.com/embed.js';

				 s.setAttribute('data-timestamp', +new Date());
				 (d.head || d.body).appendChild(s);
				 })();
				 </script>
				 <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
            </div>
		</div>
		</div>
@stop