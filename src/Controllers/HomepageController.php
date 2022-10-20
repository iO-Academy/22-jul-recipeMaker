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
        if ($_SESSION['loggedIn'] == true) {
            $userEmail = $_SESSION['user'];
            $userRecipes = $this->recipeModel->getUserRecipes($userEmail);
            //get all ingredients
            $userIngredients = $this->ingredientModel->getUserIngredients($userEmail);
            //foreach through to see where recipe id matches that in userrecipes
            foreach ($userRecipes as $recipe) {
                $recipe->ingredients = [];
                foreach ($userIngredients as $ingredient) {
                    if ($ingredient->getRecipeId() === $recipe->getRecipeId()) {
                        array_push($recipe->ingredients, $ingredient);
                    }
                }
            }

            $args['userRecipes'] = $userRecipes;
            return $this->renderer->render($response, 'home.phtml', $args);
        } else {
            return $response->withHeader('Location', '/login');
        };
    }
}
