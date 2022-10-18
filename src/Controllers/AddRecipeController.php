<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\CustomExceptions\InvalidRecipeException;
use App\Models\RecipeModel;
use App\Sanitisers\RecipeSanitiser;
use App\Validators\RecipeValidator;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AddRecipeController extends Controller
{
    private $recipeModel;

    public function __construct(RecipeModel $recipeModel)
    {
        $this->recipeModel = $recipeModel;
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
            $this->recipeModel->addNewRecipe(
                $validatedRecipe['name'],
                $validatedRecipe['duration'],
                $validatedRecipe['cookTime'],
                $validatedRecipe['prepTime'],
                $validatedRecipe['instructions']
            );
            $recipeId = $this->recipeModel->getLastRecipeId();
            $userId = $_SESSION['userId'];
            $result = $this->recipeModel->linkRecipeToUser($userId, $recipeId);
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
