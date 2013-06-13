@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="article">

				<h1 class="article-title">
					{{ $article -> title }}
				</h1>
				<div class="article-meta">
					Gepubliceerd op {{ $article -> published_at }}
				</div>
				<div class="article-body">
						{{ $article -> body }}
				</div>

			</div>

		</div><!--/row-fluid-->

	</div><!--/container-->

</div><!--/content-->

@endsection