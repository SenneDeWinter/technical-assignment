<?php

namespace App\Repositories\Repositories;

use App\Models\Comic;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ComicRepository
{
    public static function getComics(): Collection
    {
        return Comic::all();
    }

    public static function getPaginatedComics(): LengthAwarePaginator
    {
        return Comic::paginate(6);
    }

    public static function getComicByMarvelId(int $marvelId): Comic
    {
        return Comic::where('marvel_id', $marvelId)->first();
    }
}
