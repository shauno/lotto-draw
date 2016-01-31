@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <button type="button" class="btn btn-primary btn-lg" id="play-button">Play</button>
        </div>

        <div class="col-lg-6 text-right">
            <a href="/export-csv" class="btn btn-info btn-lg">Export</a>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-6">
            <h3>Main Game Results</h3>

            <div class="alert alert-danger hidden" role="alert" id="main-error"></div>

            <ul class="list-group" id="main-list">
            </ul>
        </div>

        <div class="col-lg-6">
            <h3>Powerball Results</h3>

            <div class="alert alert-danger hidden" role="alert" id="powerball-error"></div>

            <ul class="list-group" id="powerball-list">
            </ul>
        </div>

    </div>

@endsection