@layout('layouts.default')

@section('content')

<div class="pageTitle">
	<div class="container">
		<h1>Hier kan een titel <small>om te pagina te verduidelijken</small></h1>
	</div>
</div>

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span12">

				<h3>{{ $location->name }}</h3>
				@if( $location->website )
					<a href="{{ $location->website }}"> Website </a>
				@endif

				<p>Plaats: {{ $location->city }}</p>
				<p>Adres: {{ $location->street }} {{ $location->number }}</p>
				<p>Postcode: {{ $location->postalcode }}</p>

				<p>Types: 
					@foreach($location->types as $type)
						{{ $type->naam }}
					@endforeach
				</p>


			</div><!--/span9-->

		</div><!--/row-fluid-->
	</div><!--/container-->
</div><!--/content-->

@include('handlebar-templates/locationrow')

@endsection