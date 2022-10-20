<?php

namespace App\Tests;

use App\Entities\IngredientEntity;
use App\ViewHelpers\FilterViewHelper;
use Tests\TestCase;

class FilterViewHelperTest extends TestCase
{
    public function testSuccessDisplayIngredientsChecklist()
    {
        $expected = '<input type="checkbox" id="1" ';
        $expected .= 'name="1" ';
        $expected .= 'value="cheese"';
        $expected .= 'class="filter-option">';
        $expected .= '<label for="1';
        $expected .= '">&nbsp;cheese';
        $expected .= '</label><br>';

        $entityMock = $this->createMock(IngredientEntity::class);
        $entityMock->method('getName')->willReturn('cheese');
        $entityMock->method('getIngredientId')->willReturn('1');

        $userIngredients = [$entityMock];
        $result = FilterViewHelper::displayIngredientsChecklist($userIngredients);
        $this->assertEquals($expected, $result);
    }

    public function testSuccessDisplayNoIngredientsChecklist()
    {
        $expected = '<p>You do not have any ingredients</p>';
        $userIngredients = [];
        $result = FilterViewHelper::displayIngredientsChecklist($userIngredients);
        $this->assertEquals($expected, $result);
    }

    public function testMalformedDisplayIngredientsChecklist()
    {
        $input = '';
        $this->expectException(\Error::class);
        $actual = FilterViewHelper::displayIngredientsChecklist($input);
    }
}
