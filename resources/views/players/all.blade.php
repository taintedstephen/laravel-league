@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body">
				<h1 class="card-title">
					Players
				</h1>
				<div class="btn-toolbar">
					<a href="/players/new" class="btn btn-primary float-right">New Player</a>
				</div>

				<table class="table table-striped table-responsive-sm">
					<thead>
						<tr>
							<th scope="col">PSN</th>
							<th scope="col">Name</th>
							<th scope="col">Edit</th>
							<th scope="col">Delete</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($players as $player)
							<tr>
								<td>{{ $player->psn }}</td>
								<td>{{ $player->name }}</td>
								<td>
									<a href="/players/edit/{{ $player->id }}" class="btn btn-warning">Edit</a>
								</td>
								<td>
									<form
										method="post"
										action="/players/remove"
										onsubmit="return confirm('Really?')"
										name="remove-player"
									>
										@csrf
										<input type="hidden" name="id" value="{{ $player->id }}" />
										<button type="submit" class="btn btn-danger">Delete</button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
