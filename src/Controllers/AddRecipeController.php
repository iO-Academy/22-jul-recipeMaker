<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\CustomExceptions\InvalidRecipeException;
use App\Models\IngredientModel;
use App\Models\RecipeModel;
use App\Sanitisers\RecipeSanitiser;
use App\Validators\RecipeValidator;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AddRecipeController extends Controller
{
    private $recipeModel;
    private $ingredientModel;

    public function __construct(RecipeModel $recipeModel, IngredientModel $ingredientModel)
    {
        $this->recipeModel = $recipeModel;
        $this->ingredientModel = $ingredientModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $recipe = $request->getParsedBody();

        $data = [
            'success' => false,
            'message' => 'Unexpected Error',
            'data' => []
        ];
        $statusCode = 400;

        try {
            RecipeValidator::validateRecipeForm($recipe);
            $validatedRecipe = RecipeSanitiser::sanitiseNewRecipe($recipe);
            $validatedRecipe['cookTime'] = $validatedRecipe['cookTime'] ?? null;
            $validatedRecipe['prepTime'] = $validatedRecipe['prepTime'] ?? null;
            $this->recipeModel->addNewRecipe(
                $validatedRecipe['name'],
                $validatedRecipe['duration'],
                $validatedRecipe['instructions'],
                $validatedRecipe['cookTime'],
                $validatedRecipe['prepTime']
            );
            $recipeId = $this->recipeModel->getLastRecipeId();
            $userId = $_SESSION['userId'];
            $result = $this->recipeModel->linkRecipeToUser($userId, $recipeId);

            if (isset($validatedRecipe['ingredients'])) {
                // Get all ingredients
                // filter the input ingredients
                // create an array of ingredient id -> already in db
                // create an array of new ingredients -> insert
                // add new ingredient ids to id array
                // link these to the inserted recipe
                foreach ($validatedRecipe['ingredients'] as $ingredient) {
                    $this->ingredientModel->addNewIngredient($ingredient);
                    $ingredientId = $this->ingredientModel->getLastIngredientId();
                    $result = $this->ingredientModel->linkIngredientToRecipe($recipeId, $ingredientId);
                }
            }

            $message = 'Recipe added to DB';
        } catch (InvalidRecipeException $exception) {
            $data['message'] = $exception->getMessage();
        }

        if (isset($result) && $result) {
            $data = [
                'success' => true,
                'message' => $message,
                'data' => []
            ];
            $statusCode = 200;
        }
        return $this->respondWithJson($response, $data, $statusCode);
    }
}
