<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\Models\IngredientModel;
use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GetIngredientsController extends Controller
{
    private $ingredientModel;

    public function __construct(IngredientModel $ingredientModel)
    {
        $this->ingredientModel = $ingredientModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $data = [
            'success' => false,
            'message' => 'Unexpected Error',
            'data' => []
        ];
        $statusCode = 400;

        try {
            $ingredients = $this->ingredientModel->getAllIngredients();
            $message = 'Data retrieved successfully';
            $data = [
                'success' => true,
                'message' => $message,
                'data' => $ingredients
            ];
            $statusCode = 200;
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $this->respondWithJson($response, $data, $statusCode);
    }
}