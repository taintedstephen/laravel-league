@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Result</div>

                <div class="card-body">
                    <form method="POST" action="/results/update">
                        @csrf

						<input type="hidden" name="id" value="{{ $match->id }}" />

                        <div class="form-group row">
                            <label for="home_score" class="col col-form-label text-md-right">
								{{ $match->homePlayer->psn }} Score (Home)
							</label>

                            <div class="col">
                                <input id="home_score" type="number" class="form-control @error('home_score') is-invalid @enderror" name="home_score" value="{{ old('home_score', $match->home_score) }}" required >

                                @error('home_score')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

						<div class="form-group row">
                            <label for="away_score" class="col col-form-label text-md-right">
								{{ $match->awayPlayer->psn }} Score (Away)
							</label>

                            <div class="col">
                                <input id="away_score" type="number" class="form-control @error('away_score') is-invalid @enderror" name="away_score" value="{{ old('away_score', $match->away_score) }}" required >

                                @error('away_score')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

						<div class="form-group row">
                            <label for="outcome" class="col col-form-label text-md-right">
								Outcome
							</label>

                            <div class="col">
								<select class="form-control" name="outcome" id="outcome">
									<option value="normal_result"
										@if (old('outcome', $match->outcome) == 'normal_result' || !isset($match->outcome))
											selected
										@endif
									>Normal Result</option>
									<option value="home_forfeit"
										@if (old('outcome', $match->outcome) == 'home_forfeit')
											selected
										@endif
									>Home Forfeit</option>
									<option value="away_forfeit"
										@if (old('outcome', $match->outcome) == 'away_forfeit')
											selected
										@endif
									>Away Forfeit</option>
									<option value="both_forfeit"
										@if (old('outcome', $match->outcome) == 'both_forfeit')
											selected
										@endif
									>Both Forfeit</option>
							    </select>

                                @error('outcome')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="form-submit">
                                <button type="submit" class="btn btn-primary">
                                    Save Result
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
