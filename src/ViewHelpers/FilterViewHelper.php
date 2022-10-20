<?php

namespace App\ViewHelpers;

class FilterViewHelper
{
    public static function displayIngredientsChecklist(array $userIngredients)
    {
        $result = '';
        foreach ($userIngredients as $userIngredient) {
            $result .= '<input type="checkbox" id="' . $userIngredient->getIngredientId() . '" ';
            $result .= 'name="' . $userIngredient->getIngredientId() . '" ';
            $result .= 'value="' . $userIngredient->getName() . '">';
            $result .= '<label for="' . $userIngredient->getIngredientId() . '">&nbsp;' . $userIngredient->getName() . '';
            $result .= '</label><br>';
        }
        return $result;
    }
}