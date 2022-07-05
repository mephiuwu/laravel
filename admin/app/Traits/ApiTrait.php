<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait ApiTrait{


    public function ApiService($method,$uri,$data,$db){
        $client = new \GuzzleHttp\Client();




       /*  $resource = fopen('/path/to/file', 'w');
        $stream = \GuzzleHttp\Psr7\stream_for($resource); */
        /* $response = $client->request('GET', $uri,[
          'asdsda' => 'asdasd' 
        ]); */

       /*  $response = $client->$method($uri,[
            \GuzzleHttp\RequestOptions::JSON => ['data' => $data,'db' => $db] 
        ]); */

      //  $response = $client->request($method, $uri);
        $response = $client->get($uri, [
            \GuzzleHttp\RequestOptions::JSON => $data
        ]);

        /* dd($response); */

        /* $body = $response->getBody(); */
        

        return $response->getBody();
        
    }
}