<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $client = new Client();
$response = $client->request('GET', 'https://www.metaappz.com/References/AmharicAndGeezNumbersReferenceTable.aspx');

// Get the HTML response content
$html = $response->getBody()->getContents();

        //    $html = file_get_contents('https://www.linkedin.com/jobs/');
        $crawler = new Crawler($html);

        // Get the <th> elements
        $thElements = $crawler->filter('th');
        $tdElements = $crawler->filter('tr td:nth-child(2)');

        // Initialize an array to store the data
        $data = [];

        // Collect the <th> and third <td> elements
        $data['th'] = [];
        foreach ($thElements as $th) {
            $data['th'][] = trim($th->textContent); // Store text content of each <th>
        }

        $data['third_td'] = [];
        $count = 0; // Initialize counter
        foreach ($tdElements as $td) {
            // Increment counter
            $count++;

            // Store the text content of the third <td> element in the 'no' key
            if ($count === 3) {
                $data['third_td']['no'] = trim($td->textContent);
            }

            // Store the text content in the 'third_td' array
            $data['third_td'][] = trim($td->textContent);
        }
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        Storage::disk('public')->put('json.json', $jsonData);

        return response()->json($data);
    }
}
