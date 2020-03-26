@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body">
				<h1 class="card-title">
					Users
				</h1>

				<div class="btn-toolbar">
					<a href="/users/new" class="btn btn-primary float-right">New User</a>
				</div>

				<table class="table table-striped table-responsive-sm">
					<thead>
						<tr>
							<th scope="col">Email</th>
							<th scope="col">Name</th>
							<th scope="col">Edit</th>
							<th scope="col">Delete</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
							<tr>
								<td>{{ $user->email }}</td>
								<td>{{ $user->name }}</td>
								<td>
									<a href="/users/edit/{{ $user->id }}" class="btn btn-warning">Edit</a>
								</td>
								<td>
									<form
										method="post"
										action="/users/remove"
										onsubmit="return confirm('Really?')"
										name="remove-user"
									>
										@csrf
										<input type="hidden" name="id" value="{{ $user->id }}" />
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
