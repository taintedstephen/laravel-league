@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="/players/create">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="psn" class="col col-form-label text-md-right">{{ __('PSN') }}</label>

                            <div class="col">
                                <input id="psn" type="text" class="form-control @error('psn') is-invalid @enderror" name="psn" value="{{ old('psn') }}" required autocomplete="psn">

                                @error('psn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="form-submit">
                                <button type="submit" class="btn btn-primary">
                                    Create Player
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
