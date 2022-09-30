<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class TapasScraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:tapas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client(['verify' => false]);

        $episode = '1474893';
        $baseUrl = 'https://tapas.io/episode/';
        for($i=1;$i<10;$i++){
            $response = $client->get($baseUrl . $episode);
            $html = $response->getBody()->getContents();
            $crawler = new \Symfony\Component\DomCrawler\Crawler($html);
            $imgEl = $crawler->filter('.viewer>article>img');
            var_dump($imgEl->attr('data-src'));
            $link = $crawler->filter('.js-episode-viewer div');
            $episode = $link->attr('data-next-id');
            var_dump($episode);
        }
    }
}
