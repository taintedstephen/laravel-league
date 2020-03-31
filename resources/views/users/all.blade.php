@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body">

				<div class="btn-toolbar">
					<a href="/users/new" class="btn btn-primary float-right">New User</a>
				</div>

				<table class="table table-collapses">
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
								<td data-th="Email">{{ $user->email }}</td>
								<td data-th="Name">{{ $user->name }}</td>
								<td class="table-responsive--fill">
									<a href="/users/edit/{{ $user->id }}" class="btn btn-warning">Edit</a>
								</td>
								<td class="table-responsive--fill">
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
