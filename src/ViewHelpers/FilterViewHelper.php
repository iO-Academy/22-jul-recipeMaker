<?php

namespace App\ViewHelpers;

class FilterViewHelper
{
    public static function displayIngredientsChecklist(array $userIngredients)
    {
        $result = '';
        if ($userIngredients !== []) {
            foreach ($userIngredients as $userIngredient) {
                $result .= '<input type="checkbox" id="' . $userIngredient->getIngredientId() . '" ';
                $result .= 'name="' . $userIngredient->getIngredientId() . '" ';
                $result .= 'value="' . $userIngredient->getName() . '"';
                $result .= 'class="filter-option">';
                $result .= '<label for="' . $userIngredient->getIngredientId();
                $result .= '">&nbsp;' . $userIngredient->getName() . '';
                $result .= '</label><br>';
            }
        } else {
            $result = '<p>You do not have any ingredients</p>';
        }
        return $result;
    }
}
