<?php

namespace App\Tests;

use App\Validators\RecipeValidator;
use Tests\TestCase;
use TypeError;

class RecipeValidatorTest extends TestCase
{
    public function testRecipeValidatorSuccess()
    {
        $recipe = [
            'name' => 'cheese', 
            'duration' => 1, 
            'cookTime' => 1, 
            'prepTime' => 1, 
            'instructions' => 'cheese me'
        ];
        $result = RecipeValidator::validateRecipeForm($recipe);
        $this->assertEquals($result, true);
    }

    public function testRecipeValidatorFailure()
    {
        $recipe = [
            'name' => 'cheese',
            'duration' => 1234567891011,
            'cookTime' => 1,
            'prepTime' => 1,
            'instructions' => 'cheese me'
        ];
        $result = RecipeValidator::validateRecipeForm(($recipe));
        $this->assertEquals($result, false);
    }
}
