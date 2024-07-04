<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComicResource;
use App\Repositories\Repositories\ComicRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\View\View;

class ComicController extends Controller
{
    public function listComics(): ResourceCollection
    {
        $comics = ComicRepository::getComics();

        return ComicResource::collection($comics);
    }

    public function showComics(): View
    {
        $comics = ComicRepository::getPaginatedComics();

        return view('list', ['comics' => $comics]);
    }
}
