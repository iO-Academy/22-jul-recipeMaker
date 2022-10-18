<?php

namespace Tests\ViewHelpers;

use App\Entities\RecipeEntity;
use App\ViewHelpers\RecipeViewhelper;
use Tests\TestCase;

class RecipeViewHelperTest extends TestCase
{
    public function testSuccessDisplayUserRecipes()
    {
        $expected = '';

        $entityMock = $this->createMock(RecipeEntity::class);
        $entityMock->method('getName')->willReturn('mikey');
        $entityMock->method('getDuration')->willReturn('45');
        $entityMock->method('getCookTime')->willReturn('15');
        $entityMock->method('getPrepTime')->willReturn('30');
        $entityMock->method('getInstructions')->willReturn('do the thing');
        $entityMock->method('getEmail')->willReturn('mike@key.com');

        $userRecipes = [$entityMock];
        $result = RecipeViewhelper::displayUserRecipes($userRecipes);
        $this->assertEquals($expected, $result);
    }
}
