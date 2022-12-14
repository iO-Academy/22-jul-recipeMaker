<?php

namespace Tests\ViewHelpers;

use App\Entities\IngredientEntity;
use App\Entities\RecipeEntity;
use App\ViewHelpers\RecipeViewhelper;
use Tests\TestCase;

class RecipeViewHelperTest extends TestCase
{
    public function testSuccessWithIngredientsDisplayUserRecipes()
    {
        $expected = '<div class="col-12 col-lg-3 recipe m-3 p-0">';
        $expected .= '<div class="recipe-header d-flex align-items-center justify-content-between">';
        $expected .= '<h2 class="my-auto recipe-name">mikey</h2><div class="d-flex">';
        $expected .= '<h3 class="my-auto recipe-duration mx-1">45 mins</h3>';
        $expected .= '<button class="recipe-button">+</button></div></div>';
        $expected .= '<div class="recipe-content"><div class="d-flex justify-content-between">';
        $expected .= '<p class="m-1">Cooking time: 15 mins</p><p class="m-1">Preparation time: 30 mins</p></div>';
        $expected .= '<p class="font-weight-bold m-1">Ingredients: </p>';
        $expected .= '<ul><li class="ingredient">pasta</li></ul>';
        $expected .= '<p class="font-weight-bold m-1">Instructions: </p>';
        $expected .= '<p class="m-0 p-1">do the thing</p></div></div>';

        $entityMock = $this->createMock(RecipeEntity::class);
        $entityMock->method('getName')->willReturn('mikey');
        $entityMock->method('getDuration')->willReturn('45');
        $entityMock->method('getCookTime')->willReturn('15');
        $entityMock->method('getPrepTime')->willReturn('30');
        $entityMock->method('getInstructions')->willReturn('do the thing');
        $entityMock->method('getEmail')->willReturn('mike@key.com');

        $ingMock = $this->createMock(IngredientEntity::class);
        $ingMock->method('getName')->willReturn('pasta');

        $entityMock->method('getIngredients')->willReturn([$ingMock]);

        $userRecipes = [$entityMock];
        $result = RecipeViewhelper::displayUserRecipes($userRecipes);
        $this->assertEquals($expected, $result);
    }

    public function testSuccessWithNoIngredientsDisplayUserRecipes()
    {
        $expected = '<div class="col-12 col-lg-3 recipe m-3 p-0">';
        $expected .= '<div class="recipe-header d-flex align-items-center justify-content-between">';
        $expected .= '<h2 class="my-auto recipe-name">mikey</h2><div class="d-flex">';
        $expected .= '<h3 class="my-auto recipe-duration mx-1">45 mins</h3>';
        $expected .= '<button class="recipe-button">+</button></div></div>';
        $expected .= '<div class="recipe-content"><div class="d-flex justify-content-between">';
        $expected .= '<p class="m-1">Cooking time: 15 mins</p><p class="m-1">Preparation time: 30 mins</p></div>';
        $expected .= '<p class="font-weight-bold m-1">Ingredients: </p>';
        $expected .= '<ul><li class="ingredient">No ingredients to be displayed</li></ul>';
        $expected .= '<p class="font-weight-bold m-1">Instructions: </p>';
        $expected .= '<p class="m-0 p-1">do the thing</p></div></div>';

        $entityMock = $this->createMock(RecipeEntity::class);
        $entityMock->method('getName')->willReturn('mikey');
        $entityMock->method('getDuration')->willReturn('45');
        $entityMock->method('getCookTime')->willReturn('15');
        $entityMock->method('getPrepTime')->willReturn('30');
        $entityMock->method('getInstructions')->willReturn('do the thing');
        $entityMock->method('getEmail')->willReturn('mike@key.com');

        $ingMock = $this->createMock(IngredientEntity::class);
        $ingMock->method('getName')->willReturn('');

        $entityMock->method('getIngredients')->willReturn([]);

        $userRecipes = [$entityMock];
        $result = RecipeViewhelper::displayUserRecipes($userRecipes);
        $this->assertEquals($expected, $result);
    }

    public function testFailureDisplayUserRecipesEmptyArray()
    {
        $expected = '<div class="col-12 col-lg-3 no-recipe m-3 p-3">';
        $expected .= '<h5 class="text-center">No recipes found.';
        $expected .= '<br>Click the \'+\' in the top right to get started!</h5></div>';
        $result = RecipeViewhelper::displayUserRecipes([]);
        $this->assertEquals($expected, $result);
    }

    public function testMalformedDisplayUserRecipes()
    {
        $input = '';
        $this->expectException(\Error::class);
        $actual = RecipeViewhelper::displayUserRecipes($input);
    }
}
