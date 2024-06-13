@extends('layouts.layout')
@section('pageTitle', $user->name . ' - Profile')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">      
            @include('shared.success-message')
            <hr>
            

            <div class="mt-3">
                @include('users.shared.user-card')
            </div>
            @forelse ($ideas as $idea)
                <div class="mt-3">
                    @include('ideas.shared.idea-card')
                </div>
            @empty
                @if (request()->has('search'))
                   <p class="text-center my-4"> No Result Found </p>
                   @else
                   <p class="text-center my-4">No Ideas Created </p>
                @endif
            @endforelse
            <div class="mt-3">
                {{ $ideas->withQueryString()->links() }}
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.folllow-box')
        </div>
    </div>
@endsection
