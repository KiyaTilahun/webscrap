<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class WebController extends Controller
{
    //

    public function index()
    {

        // dd("hello");
        $html = <<<'HTML'
        <!DOCTYPE html>
        <html>
            <body>
                <p class="message">Hello World!</p>
                <p class='grid'>Hello Crawler!

               <p>jjj</p>
                </p>
            </body>
        </html>
        HTML;

        //    $html = file_get_contents('https://www.linkedin.com/jobs/');
        $client = new Client();
        $response = $client->request('GET', 'https://github.com/KiyaTilahun', [
            'headers' => [
               
            ]
        ]);

        $html = $response->getBody()->getContents();

        $crawler = new Crawler($html);

//   dd($crawler);

        $items = $crawler->filter('.footer');
dd($items);
        // Iterate through the filtered elements
        foreach ($items as $item) {
            echo " \n";
            echo $item->textContent . "\n\n";
        }
    }
}
