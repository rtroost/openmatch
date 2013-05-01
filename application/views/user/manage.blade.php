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

					@foreach($users as $user)

					<tr id="user-{{$user -> id}}">
						<td>{{ $user -> email }}</td>
					</tr>

					@endforeach

				</table>

				@else

				<p>Er zijn geen berichten om te laten zien.</p>

				@endif

			</div><!--/span9-->

		</div><!--/row-fluid-->

	</div><!--/container-->

</div><!--/content-->

@endsection