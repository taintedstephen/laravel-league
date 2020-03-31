@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body">

				<form method="post" action="/divisions/save-players">
					@csrf

					<input type="hidden" name="data" id="data" value="" />

					@foreach ($divisions as $division)
						<h3>{{ $division->name }}</h3>
						<div class="division" data-id="{{ $division->id }}">
							<ul class="division-players" id="division-{{ $division->id }}">
								@foreach ($division->players as $player)
									<li data-id="{{ $player->id }}">
										{{ $player->psn }}
									</li>
								@endforeach
							</ul>
						</div>
					@endforeach

					<h3>Unassigned Players</h3>
					<div class="division" data-id="unassigned">
						<ul class="division-players" id="division-unasigned">
							@foreach ($unassignedPlayers as $player)
								<li data-id="{{ $player->id }}">
									{{ $player->psn }}
								</li>
							@endforeach
						</ul>
					</div>

					<div class="form-group row mb-0">
						<div class="col offset-md-4">
							<button type="submit" class="btn btn-primary">
								Save Changes
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<link href="/css/jquery-ui.min.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" defer>
		var lists = [
			@foreach ($divisions as $division)
				'#division-{{ $division->id }}',
			@endforeach
			'#division-unasigned',
		];

		jQuery(document).ready(function($) {
			$(lists.join(',')).sortable({
				connectWith: '.division-players',
				update: sortList,
			});
			sortList();
		})

		function sortList() {
			var data = {};
			$(".division").each(function() {
				var players = [];
				$(this).find("li").each(function() {
					players.push($(this).data("id"));
				})
				data[$(this).data("id")] = players;
			})
			var output = JSON.stringify(data);
			$("#data").val(output);
		}
	</script>


@endsection
