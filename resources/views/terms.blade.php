@extends('layouts.layout')
@section('pageTitle', 'Terms')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">

            @include('shared.success-message')
            @include('ideas.shared.submit-idea')
            <hr>
            <h1>Terms</h1>
            <div>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus libero aliquam numquam quos iure enim,
                aliquid
                eaque sint iste voluptatum dolore necessitatibus voluptas nesciunt accusamus consequuntur laboriosam
                perspiciatis
                facilis dignissimos.
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.folllow-box')
        </div>
    </div>
@endsection
