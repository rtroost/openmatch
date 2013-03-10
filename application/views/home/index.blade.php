@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')

	@if (Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	<p>Dit is de maincontainer<p>

	
@endsection

@section('footer')
	@include('footer')
@endsection