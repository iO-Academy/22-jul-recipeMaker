<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\Models\RecipeModel;
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
            'message' => 'Unexpected Error.',
            'data' => []
        ];
        $statusCode = 400;

        try {
            
        }
    }
}