<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Slim\Views\Twig;

abstract class AbstractController
{
    protected Twig $view;

    public function __construct(Twig $view)
    {
        $this->view = $view;
    }

    protected function render(ResponseInterface $response, string $template, array $data = []): ResponseInterface
    {
        return $this->view->render($response, $template, $data);
    }

    protected function redirect(ResponseInterface $response, string $url): ResponseInterface
    {
        return $response->withHeader('Location', $url)->withStatus(302);
    }

    protected function json(ResponseInterface $response, array $data): ResponseInterface
    {
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }
}