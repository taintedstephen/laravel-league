@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body">

				@foreach ($fixtures as $division)
					<h3 class="card-subtitle mb-2">{{ $division["name"] }}</h3>
					@foreach ($division["fixtures"] as $weeks)
						<h5 class="card-subtitle text-muted  mb-1">Week {{ $weeks["week"] }}</h5>
						<ul class="list-group text-center  mb-4">
							@foreach ($weeks["fixtures"] as $fixture)
								<li class="list-group-item fixture">
									<span class="fixture-player">{{ $fixture["homePlayer"]["psn"] }}</span>
									<span class="fixture-vs">vs.</span>
									<span class="fixture-player">{{ $fixture["awayPlayer"]["psn"] }}</span>
								</li>
							@endforeach
						</ul>
					@endforeach
				@endforeach

				<form action="/results/save-generated" method="post">
					@csrf
					<input type="hidden" name="fixtures" value="{{ $json }}" />

					<div class="form-group row mb-0">
						<div class="form-submit">
							<br />
							<button class="btn btn-primary" type="submit">Save Fixtures</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
