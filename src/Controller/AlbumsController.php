<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AlbumsController extends AbstractController
{
    public function index(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $json = file_get_contents(__DIR__ . '/../../data/albums.json');
        $albums = json_decode($json, true);

        return $this->render($response, 'albums.twig', [
            'albums' => $albums
        ]);
    }
}