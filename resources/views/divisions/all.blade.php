@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body">
				<h1 class="card-title">
					Divisions
				</h1>

				<div class="btn-toolbar">
					<a href="/divisions/new" class="btn btn-primary">New Division</a>
					<a href="/divisions/players" class="btn btn-secondary">Manage Players</a>
				</div>

				<table class="table table-striped table-responsive-sm">
					<thead>
						<tr>
							<th scope="col">Name</th>
							<th scope="col">Players</th>
							<th scope="col">Edit</th>
							<th scope="col">Delete</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($divisions as $division)
							<tr>
								<td>{{ $division->name }}</td>
								<td>{{ count($division->players) }}</td>
								<td>
									<a href="/divisions/edit/{{ $division->id }}" class="btn btn-warning">Edit</a>
								</td>
								<td>
									<form
										method="post"
										action="/divisions/remove"
										onsubmit="return confirm('Really?')"
										name="remove-player"
									>
										@csrf
										<input type="hidden" name="id" value="{{ $division->id }}" />
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
