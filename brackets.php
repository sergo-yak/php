<?php
/**
 * UrbanSport testing question
 * Write a function which tests a string for a valid usage of brackets.
 *
 *   Example:
 *   (a+[b]), output: true
 *   (a+(b), output: false
 *   (c{d)}, output: false
 */
const BRACKETS = [
    '[' => ']',
    '{'=> '}',
    '('=> ')'
];

function checkBrackets( string $expression): bool {
    $result = false;

    /* filter out only brackets */
    $rawExpr = array_filter(str_split($expression), function($char) {
            if (in_array($char, array_keys(BRACKETS)) || in_array($char, array_values(BRACKETS)))
                return $char;
    });

    $bracketsTree = createBracketsTree($rawExpr);

    /* check pairs all brackets */
    $i = 0;
    while ($i < count($bracketsTree)) {
        if (count($bracketsTree[$i]) % 2 != 0) {
            $result = false;
            break;
        }
        $result = true;
        $i++;
    }

    return $result;
}

function createBracketsTree(array $rawExpr): array {
    $tree = [];
    $currentLevel = 0;

    foreach ( $rawExpr as $char) {
        $currentLevel = getLevel($tree, $currentLevel, $char);
        $tree[ $currentLevel ][] = $char;
    }

    return $tree;
}

function getLevel( $tree, $currentLevel, $char ): int
{
    if (!isset($tree[$currentLevel])) {
        /* the first element of the array */
        $currentLevel;
    } else {
        if (checkPair($tree[$currentLevel], $char) && count($tree[$currentLevel]) % 2 != 0) {
            $currentLevel;
        } elseif (!checkPair($tree[$currentLevel], $char) && count($tree[$currentLevel]) % 2 == 0) {
            if ($currentLevel != 0 && checkPair($tree[$currentLevel - 1], $char)) {
                $currentLevel--;
            }
        } else {
            $currentLevel++;
        }
    }

    return $currentLevel;
}

function checkPair ($array, $char): bool {
   if (isset(BRACKETS[$array[count($array) - 1]]) && BRACKETS[$array[count($array) - 1]] == $char) {
       return true;
   } else {
       return false;
   }
}