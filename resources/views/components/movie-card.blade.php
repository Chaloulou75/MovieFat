<div class=" border border-gray-800 rounded mt-8 bg-teal-900">
    <div class="mb-2">
    	<a href="{{ route('movies.show', $movie['id']) }}">
        <img src="{{ $movie['poster_path'] }}" alt="movie poster" class="hover:opacity-75 transition ease-in-out duration-150">
        </a>
    </div>
    <div class="text-orange-400 text-lg rounded leading-tight px-2 py-2 mt-6">
    	<a href="{{ route('movies.show', $movie['id']) }}">
    		{{$movie['title'] }} 
    		<span class="text-sm">({{ $movie['release_date'] }})</span>
    	</a>
    </div>
    <div class="text-white text-sm rounded leading-tight px-2 py-2 mt-2">
        {{ $movie['genres'] }}
    </div>
    <div class="text-white text-sm rounded px-2 py-2 mt-2">
    	{{ $movie['overview'] }}
    </div>
</div>
