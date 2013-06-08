@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span8">

				@if($articles)

				<div id="article-small-container">

					@foreach($articles as $article)

					<div class="article-small">

						<h2 class="article-small-title">
							{{ $article -> title }}
						</h2>
						<div class="article-small-meta">
							Gepubliceerd op {{ $article -> published_at }}
						</div>
						<div class="article-small-body">
							@if((strlen($article -> message) > 300))
								{{ substr ($article -> message, 0, 300) }}...<a href="{{ URL::to_route('news_show', $article -> id) }}" class="article-small-readmore"><i class="icon-caret-right"></i> Lees verder</a>
							@else
								{{ $article -> message }}
							@endif
						</div>

					</div>

					@endforeach

				</div>

				@else

				<p>Er zijn geen berichten om te laten zien.</p>

				@endif

			</div><!--/span8-->

			<div class="span4">

			</div>

		</div><!--/row-fluid-->

	</div><!--/container-->

</div><!--/content-->

@endsection