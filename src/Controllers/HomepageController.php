<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\Models\IngredientModel;
use App\Models\RecipeModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

class HomepageController extends Controller
{
    private $renderer;
    private $recipeModel;
    private $ingredientModel;

    public function __construct(PhpRenderer $renderer, RecipeModel $recipeModel, IngredientModel $ingredientModel)
    {
        $this->renderer = $renderer;
        $this->recipeModel = $recipeModel;
        $this->ingredientModel = $ingredientModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
            $userEmail = $_SESSION['user'];
            $userRecipes = $this->recipeModel->getUserRecipes($userEmail);
            $userIngredients = $this->ingredientModel->getUserIngredients($userEmail);
            $userRecipes = $this->recipeModel->attachIngredientstoRecipe(
                $userRecipes,
                $userIngredients
            );
            $filterData = $request->getQueryParams();
            $args['userRecipes'] = $this->recipeModel->filterRecipesByIngredient(
                $filterData,
                $userRecipes
            );
            $args['userIngredients'] = array_unique($userIngredients);
            return $this->renderer->render($response, 'home.phtml', $args);
        } else {
            return $response->withHeader('Location', '/login');
        };
    }
}
