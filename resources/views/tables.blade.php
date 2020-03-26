@extends('layouts.app')

@section('content')
	<div class="page-title">
		<h1>Tables</h1>
	</div>
	<ul class="quick-links">
	@foreach ($tables as $table)
		<li>
			<a href="#table{{ $table["id"] }}">{{ $table["name"] }}</a>
		</li>
	@endforeach
	</ul>
	<div class="table-toggles">
		<ul>
			<li class="table-toggle table-toggle--active" data-id="wdl">WDL</li>
			<li class="table-toggle" data-id="kda">KDA</li>
		</ul>
	</div>
	@foreach ($tables as $table)
    <div class="division"><a name="table{{ $table["id"] }}"></a>
		<div class="page-title">
        	<h3>{{ $table["name"] }}</h3>
		</div>

        <table class="table">
			<thead>
				<tr>
					<th scope="col" class="th-rank">#</th>
					<th scope="col" class="th-name">Name</th>
					<th scope="col" class="th-played">P</th>
					<th scope="col" class="th-wins">W</th>
					<th scope="col" class="th-draws">D</th>
					<th scope="col" class="th-losses">L</th>
					<th scope="col" class="th-kills">Kills</th>
					<th scope="col" class="th-deaths">Deaths</th>
					<th scope="col" class="th-kd">K:D</th>
					<th scope="col" class="th-points">PTS</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($table["table"] as $player)
				<tr class="tr-rank-{{ $player["position"] }}">
					<td class="td-rank">{{ $player["position"] }}</td>
					<td class="td-name">
						<a href="/fixtures/player/{{ $player["id"] }}">{{ $player["psn"] }}</a>
					</td>
					<td class="td-played">{{ $player["played"] }}</td>
					<td class="td-wins">{{ $player["wins"] }}</td>
					<td class="td-draws">{{ $player["draws"] }}</td>
					<td class="td-losses">{{ $player["losses"] }}</td>
					<td class="td-kills">{{ $player["kills"] }}</td>
					<td class="td-deaths">{{ $player["deaths"] }}</td>
					<td class="td-kd">{{ $player["kdratio"] }}</td>
					<td class="td-points">{{ $player["points"] }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

    </div>
	@endforeach

	<script type="text/javascript">
		$(document).ready(function() {
			$(".table-toggle").on("click", function() {
				if (!$(this).hasClass("table-toggle--active")) {
					$(".table-toggle--active").removeClass("table-toggle--active");
					$("body").removeClass("body--kd");
					$(this).addClass("table-toggle--active");
					if ($(this).data("id") === "kda") {
						$("body").addClass("body--kd");
					}
				}
			})
		});

	</script>

@endsection
