<?php

namespace App\Tests;

use App\Models\IngredientModel;
use Tests\TestCase;

class IngredientModelTest extends TestCase
{
    public function testFilterDuplicateIngredientsSuccess()
    {
        $ingredients = ['coke', '7up'];
        $dbIngredients = [['name' => 'coke', 'id' => 1], ['name' => 'tomato', 'id' => 2]];
        $expected = [1];
        $result = IngredientModel::filterDuplicateIngredients($ingredients, $dbIngredients);
        $this->assertEquals($result, $expected);
    }

    public function testFilterDuplicateIngredientsFailure()
    {
        $ingredients = [1, 2, 3];
        $dbIngredients = [['name' => 'coke', 'id' => 1], ['name' => 'tomato', 'id' => 2]];
        $expected = [];
        $result = IngredientModel::filterDuplicateIngredients($ingredients, $dbIngredients);
        $this->assertEquals($result, $expected);
    }

    public function testFilterDuplicateIngredientsMalformed()
    {
        $ingredients = 'butter';
        $dbIngredients = [['name' => 'coke', 'id' => 1], ['name' => 'tomato', 'id' => 2]];
        $this->expectException(\Error::class);
        $actual = IngredientModel::filterDuplicateIngredients($ingredients, $dbIngredients);
    }

    public function testRemoveDuplicateIngredientsSuccess()
    {
        $ingredients = ['7up', 'coke'];
        $dbIngredients = [['name' => 'coke', 'id' => 1], ['name' => 'tomato', 'id' => 2]];
        $result = IngredientModel::removeDuplicateIngredients($ingredients, $dbIngredients);
        $this->assertContains('7up', $result);
        $this->assertNotContains('coke', $result);
    }

    public function testRemoveDuplicateIngredientsFailure()
    {
        $ingredients = [1, 2];
        $dbIngredients = [['name' => 'coke', 'id' => 1], ['name' => 'tomato', 'id' => 2]];
        $expected = [];
        $result = IngredientModel::removeDuplicateIngredients($ingredients, $dbIngredients);
        $this->assertEquals($result, $expected);
    }

    public function testRemoveDuplicateIngredientsMalformed()
    {
        $ingredients = 'butter';
        $dbIngredients = [['name' => 'coke', 'id' => 1], ['name' => 'tomato', 'id' => 2]];
        $this->expectException(\Error::class);
        $actual = IngredientModel::removeDuplicateIngredients($ingredients, $dbIngredients);
    }
}
