<?php


require __DIR__.'/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
    'base_url' => 'http://localhost:8000',
    'defaults' => [
        'exceptions' => false,
    ]
]);

$request = $client->post('/api/inventory/new/');

try {
    $response = $client->send( $request );
} catch (\GuzzleHttp\Exception\ClientException $e) {
    echo 'Caught response: ' . $e->getResponse()->getStatusCode();
}

?>