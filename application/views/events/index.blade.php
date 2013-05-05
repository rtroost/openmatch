@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="well">

				<h3>Maak je eigen evenement aan</h3>

				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>

				<a href="{{ URL::to_route('events_create') }}" class="btn">Aanmaken</a>


			</div>

		</div>

		<div class="row-fluid">

			<div class="span6">
				<h3>Aanbevolen</h3>
				<table class="table table-striped eventList">
					<tbody>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #1</a></td>
							<td>13 jan 2013</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #2</a></td>
							<td>13 jan 2013</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #3</a></td>
							<td>13 jan 2013</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #4</a></td>
							<td>13 jan 2013</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #5</a></td>
							<td>13 jan 2013</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #6</a></td>
							<td>13 jan 2013</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #7</a></td>
							<td>13 jan 2013</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #8</a></td>
							<td>13 jan 2013</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #9</a></td>
							<td>13 jan 2013</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #10</a></td>
							<td>13 jan 2013</td>
						</tr>
					</tbody>
				</table>

			</div><!--/span6-->

			<div class="span6">
				<h3>Recent toegevoegd</h3>
				<table class="table table-striped eventList">
					<tbody>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #1</a></td>
							<td>13m geleden</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #2</a></td>
							<td>13m geleden</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #3</a></td>
							<td>13m geleden</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #4</a></td>
							<td>13m geleden</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #5</a></td>
							<td>13m geleden</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #6</a></td>
							<td>13m geleden</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #7</a></td>
							<td>13m geleden</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #8</a></td>
							<td>13m geleden</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #9</a></td>
							<td>13m geleden</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #10</a></td>
							<td>13m geleden</td>
						</tr>
					</tbody>
				</table>

			</div><!--/span6-->

		</div><!--/row-fluid-->

		<div class="row-fluid">

			<div class="span6">
				<h3>Spoedig ten einde</h3>
				<table class="table table-striped eventList">
					<tbody>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #1</a></td>
							<td>2:59</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #2</a></td>
							<td>2:59</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #3</a></td>
							<td>2:59</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #4</a></td>
							<td>2:59</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #5</a></td>
							<td>2:59</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #6</a></td>
							<td>2:59</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #7</a></td>
							<td>2:59</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #8</a></td>
							<td>2:59</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #9</a></td>
							<td>2:59</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #10</a></td>
							<td>2:59</td>
						</tr>
					</tbody>
				</table>
			</div><!--/span6-->

			<div class="span6">
				<h3>Bijna vol</h3>
				<table class="table table-striped eventList">
					<tbody>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #1</a></td>
							<td>12 van 14 bezet</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #2</a></td>
							<td>12 van 14 bezet</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #3</a></td>
							<td>12 van 14 bezet</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #4</a></td>
							<td>12 van 14 bezet</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #5</a></td>
							<td>12 van 14 bezet</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #6</a></td>
							<td>12 van 14 bezet</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #7</a></td>
							<td>12 van 14 bezet</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #8</a></td>
							<td>12 van 14 bezet</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #9</a></td>
							<td>12 van 14 bezet</td>
						</tr>
						<tr>
							<td><i class="icon-angle-right"></i><a href="#">Evenement #10</a></td>
							<td>12 van 14 bezet</td>
						</tr>
					</tbody>
				</table>

			</div><!--/span6-->

		</div><!--/row-fluid-->

	</div><!--/container-->

</div><!--/content-->

@endsection