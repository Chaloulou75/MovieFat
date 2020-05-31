@extends('layouts.app')

@section('content')

	<div class="container mx-auto px-4">
        <h2 class="text-gray-300 uppercase tracking-wide font-semibold">Top Movies</h2>

        <div class="popular-movies text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 border-b border-gray-800 pb-16">

        @foreach($topMovies as $movie)

            <x-movie-card :movie="$movie" />

        @endforeach

		</div> <!-- end Top-movies -->
    </div> <!-- end container -->


@endsection
