<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\CustomExceptions\InvalidRecipeException;
use App\Models\RecipeModel;
use App\Sanitisers\RecipeSanitiser;
use App\Validators\RecipeValidator;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

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
            $vaildatedRecipe = RecipeSanitiser::sanitiseNewRecipe($recipe);
            $this->recipeModel->addNewRecipe($vaildatedRecipe);
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