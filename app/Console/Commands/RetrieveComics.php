<?php

namespace App\Console\Commands;

use App\Models\Comic;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class RetrieveComics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'retrieve-comics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve comic from Marvel API';

    /**
     * Execute the console command.
     */
    public function handle()
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
}
