@extends('layouts.app')

@section('content')

	<h1 class="text-gray-200 uppercase text-3xl tracking-wide font-semibold text-center mb-4 py-4">{{ $movie['title']}} <span class="text-sm">({{ $movie['release_date'] }})</span></h1>
	
	<div class="container mx-auto px-4 flex flex-col md:flex-row border-b border-gray-800 pb-16">

        <div class="w-full md:w-1/3 mx-auto">

        	<img src="{{ $movie['poster_path'] }}" alt="movie poster" class="hover:opacity-75 transition ease-in-out duration-150">

       	</div>

       	<div class="w-full md:w-2/3 mx-auto md:px-10 text-gray-200 items-center">

	        <div class="text-lg rounded leading-tight px-2 py-2 mt-6">
		      	<span><svg class="inline-block h-5 w-5 text-yellow-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg> Rating: {{ $movie['vote_average'] }} </span>
		      	<span>|</span>
		      	<span>
		      	   {{ $movie['genres'] }}		        	
    			</span>
		    </div>

		    <div class="text-lg rounded leading-tight px-2 py-2 mt-6">
		    	{{ $movie['overview'] }}		
		    </div>

		    <div class="mt-12">
		    	<h4 class="font-semibold">Featured crew:</h4>
		    	<div class="flex mt-4">

	    		@foreach( $movie['crew'] as $crew)
					<div class="mr-8">
						<div>{{$crew['name']}}</div>
						<div class="text-sm text-gray-500 mt-1">{{$crew['job']}}</div>
					</div>
	    		@endforeach
		    	</div>		    	
		    </div>

		    <div x-data="{ isOpen: false }">
			    @if(count($movie['videos']['results']) > 0)
			    <div class="mt-12">
			    	<button 
					@click="isOpen = true"
			    	class="bg-orange-500 flex inline-flex items-center text-white rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
			    		<svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
			    		<span class="ml-2 uppercase"> Play trailer</span>		    		
			    	</button>		    	
			    </div>
			    @endif
				
				<template x-if="isOpen">
                    <div style="background-color: rgba(0, 0, 0, .5);"
                        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    >
                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                            <div class="bg-gray-900 rounded">
                                <div class="flex justify-end pr-4 pt-2">
                                    <button
                                        @click="isOpen = false"
                                        @keydown.escape.window="isOpen = false"
                                        class="text-3xl leading-none hover:text-gray-300">&times;
                                    </button>
                                </div>
                                <div class="modal-body px-8 py-8">
                                    <div class="responsive-container">
                                        @isset($movie['videos']['results'][0]['key'] )
                                        <iframe class="responsive-iframe" src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
			</div>
		</div> <!-- end description movie -->
	</div>

	<div class="container mx-auto px-4 py-8"> {{-- Cast container --}}		
		<h2 class="text-gray-300 uppercase text-4xl tracking-wide font-semibold py-8">Cast</h2>
        <div class="text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 border-b border-gray-800 py-8">
		@foreach($movie['cast'] as $cast)
			<div class="flex flex-col">
                <a href="{{ route('actors.show', $cast['id']) }}">
				<img src="https://image.tmdb.org/t/p/w500/{{ $cast['profile_path'] }}" alt="image cast" class="hover:opacity-75 transition ease-in-out duration-150"></a>
	            <div class="text-white text-lg rounded leading-tight px-2 py-2 mt-6">	
					<div class="mr-8">
                        <a href="{{ route('actors.show', $cast['id']) }}">
						  <div>{{$cast['name'] }} </div>
                        </a>
						<div class="text-sm text-gray-500 pt-2">{{$cast['character'] }} </div>
					</div>
			    </div>
			</div>
        @endforeach
    	</div>
	</div> <!-- end container -->

	
	<div class="movie-images" x-data="{ isOpen: false, image: ''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($movie['images'] as $image)
                    <div class="mt-8">
                        <a
                            @click.prevent="
                                isOpen = true
                                image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                            "
                            href="#"
                        >
                            <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" alt="image1" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>
                @endforeach
            </div>
				
	        <div
                style="background-color: rgba(0, 0, 0, .5);"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                x-show="isOpen"
            >
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button
                                @click="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                                class="text-3xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->

	</div>

@endsection
