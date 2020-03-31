@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body">

				<table class="table table-collapses">
					<thead>
						<tr>
							<th scope="col">Week</th>
							<th scope="col">Division</th>
							<th scope="col">Home</th>
							<th scope="col">Away</th>
							<th scope="col">Score</th>
							<th scope="col">Outcome</th>
							<th scope="col">Edit</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($matches as $match)
							<tr>
								<td data-th="Match Week">{{ $match->match_week }}</td>
								<td data-th="Name">{{ $match->division->name }}</td>
								<td data-th="Home">{{ $match->homePlayer->psn }}</td>
								<td data-th="Away">{{ $match->awayPlayer->psn }}</td>
								@if ( $match->has_result )
									<td data-th="Score">{{ $match->home_score }}&nbsp;:&nbsp;{{ $match->away_score }}</td>
									<td data-th="Outcome">{{ ucwords(str_replace('_', ' ', $match->outcome)) }}</td>
									<td class="table-responsive--fill">
										<a href="/results/edit/{{ $match->id }}" class="btn btn-warning">Edit</a>
									</td>
								@else
									<td data-th="Score"></td>
									<td data-th="Outcome">No result</td>
									<td class="table-responsive--fill">
										<a href="/results/edit/{{ $match->id }}" class="btn btn-primary">Add Scores</a>
									</td>
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>

				@if (count($matches) === 0)
					<a href="/results/generate" class="btn btn-primary">Generate Fixture List</a>
				@else
					<form
						action="/results/empty"
						method="post"
						onsubmit="return confirm('Dan - if you\'re reading this are you SURE?! Maybe speak to me before you delete EVERYTHING. (AGAIN)')">
						@csrf
						<button type="submit" class="btn btn-danger">Delete all fixtures</button>
					</form>
				@endif
			</div>
		</div>
	</div>
@endsection
