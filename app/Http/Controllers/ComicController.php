<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use GuzzleHttp\Client;

class ComicController extends Controller
{
    public function retrieveComics(): void
    {
        $client = new Client();
        $timestamp = time();

        $response = $client->get(config('services.marvel.base_url') . '/comics', [
            'query' => [
                'apikey' => config('services.marvel.public_key'),
                'ts' => $timestamp,
                'hash' => md5($timestamp . config('services.marvel.private_key') . config('services.marvel.public_key')),
                'limit' => 100,
            ],
        ]);

        $comics = json_decode($response->getBody()->getContents(), true)['data']['results'];

        foreach($comics as $comic){
            $comicData = [
                'title' => $comic['title'],
                'format' => $comic['format'],
                'marvel_id' => $comic['id'],
                'page_count' => $comic['pageCount'],
                'thumbnail' => $comic['thumbnail']['path'] . '.' . $comic['thumbnail']['extension'],
            ];

            Comic::updateOrCreate(['marvel_id' => $comicData['marvel_id']], $comicData);
        }
    }

    public function getComics()
    {
        $comics = Comic::paginate(6);

        return view('list', compact('comics'));
    }
}
