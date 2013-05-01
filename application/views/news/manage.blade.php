@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span3">

				@include('administration.sidebar')

			</div><!--/span3-->

			<div class="span9">

				@if($articles)

				<table class="table table-striped table-bordered">

					@foreach($articles -> results as $article)

					<tr id="article-{{$article -> id}}">
						<td>{{ $article -> title }}</td>
						<td>{{ $article -> created_at }}</td>
						<td>{{ $article -> updated_at }}</td>
						<td>{{ $article -> published_at }}</td>
						<td><a href="{{ URL::to_route('news_edit', $article -> id) }}">Aanpassen</a></td>
						<td><a href="#">Publiceren</a></td>
					</tr>

					@endforeach

				</table>

				{{ $articles -> links() }}

				@else

				<p>Er zijn geen berichten om te laten zien.</p>

				@endif

			</div><!--/span9-->

		</div><!--/row-fluid-->

	</div><!--/container-->

</div><!--/content-->

@endsection