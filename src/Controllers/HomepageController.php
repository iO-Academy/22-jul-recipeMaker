<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\Models\RecipeModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

class HomepageController extends Controller
{
    private $renderer;
    private $recipeModel;

    public function __construct(PhpRenderer $renderer, RecipeModel $recipeModel)
    {
        $this->renderer = $renderer;
        $this->recipeModel = $recipeModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        if ($_SESSION['loggedIn'] == true) {
            $userEmail = $_SESSION['user'];
            $userRecipes = $this->recipeModel->getUserRecipes($userEmail);
            echo '<pre>';
            var_dump($userRecipes);
            echo '</pre>';
            $args['userRecipes'] = $userRecipes;
            return $this->renderer->render($response, 'home.phtml', $args);
        } else {
            return $response->withHeader('Location', '/login');
        };
    }
}
