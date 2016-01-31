@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-primary btn-lg" id="play-button">Play</button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <h3>Main Game Results</h3>

            <ul class="list-group" id="main-list">
            </ul>
        </div>
    </div>

@endsection