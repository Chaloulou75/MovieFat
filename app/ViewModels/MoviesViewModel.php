<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $topMovies;
    public $genres;

    public function __construct($topMovies, $genres)
    {
        $this->topMovies = $topMovies;
        $this->genres = $genres;
    }

    public function topMovies()
    {
    	return $this->formatMovies($this->topMovies);
    }

    public function genres()
    {
    	return collect($this->genres)->mapWithKeys(function($genre){
            return [ $genre['id'] => $genre['name'] ];
        });
    }

    private function formatMovies($movies)
    {
    	return collect($movies)->map(function($movie){

    		$genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value){

	    		return [$value => $this->genres()->get($value)];

	    	})->implode(', ');

    		return collect($movie)->merge([    		
    			'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'],
    			'vote_average' => $movie['vote_average'] * 10 .'%',
    			'release_date' => Carbon::parse($movie['release_date'])->format('Y'),
    			'genres' => $genresFormatted,
    		])->only([ 
    			'id', 'title', 'overview', 'poster_path', 'vote_average', 'release_date','genres_ids', 'genres',
    		]);	
    	});
    }

}
