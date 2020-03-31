@extends('layouts.app')

@section('content')

	@foreach ($weeks as $week)
		<div class="fixture-week">
			<div class="page-title">
				<h3>{{ $week["week"] }}</h3>
			</div>
			@foreach ($week['divisions'] as $division)
				<h4>{{ $division["name"] }}</h4>
				<ul class="fixture-list">
					@foreach ($division["matches"] as $fixture)
						<li class="fixture">
							<span class="fixture-player fixture-player--home">
								<a href="/fixtures/player/{{ $fixture["homePlayer"]["id"] }}">
									{{ $fixture["homePlayer"]["psn"] }}
								</a>
								@if ($fixture["has_result"])
									<span class="fixture-player__score">
										{{ $fixture['home_score'] }}
									</span>
								@endif
							</span>
							<span class="fixture-vs">vs.</span>
							<span class="fixture-player fixture-player--away">
								@if ($fixture["has_result"])
									<span class="fixture-player__score">
										{{ $fixture['away_score'] }}
									</span>
								@endif
								<a href="/fixtures/player/{{ $fixture["awayPlayer"]["id"] }}">
									{{ $fixture["awayPlayer"]["psn"] }}
								</a>
							</span>
						</li>
					@endforeach
				</ul>
				@endforeach
		</div>
	@endforeach

@endsection
