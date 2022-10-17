<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

class LoginController extends Controller
{
    private $renderer;

    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        if ($_SESSION['loggedIn'] == true) {
            return $this->renderer->render($response, 'home.phtml', $args);
        } else {
            return $response->withHeader('Location', '/login');
        }
    }
}
