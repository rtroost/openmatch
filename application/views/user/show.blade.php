@layout('layouts.default')

@section('content')

<div class="pageTitle">
	<div class="container">
		<h1>Profiel bezichtigen</h1>
	</div>
</div>

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span3">

				<ul class="nav nav-tabs nav-stacked">
          <li class="active"><a href="#"><i class="icon-chevron-right"></i> Algemeen</a></li>
          <li><a href="#"><i class="icon-chevron-right"></i> Reacties</a></li>
          <li><a href="#"><i class="icon-chevron-right"></i> Evenementen</a></li>
          <li><a href="#"><i class="icon-chevron-right"></i> Berichten</a></li>
        </ul>

			</div>

			<div class="span9">

				<div>
					<h4>Het profiel van {{ ucwords($user -> name) }} {{ ucwords($user -> surname) }}</h4>
					<p>
						Wat gaan we hier zetten?
					</p>
				</div>

			</div>


		</div><!--/row-fluid-->

	</div><!--/container-->

</div><!--/content-->

@endsection