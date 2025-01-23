/**
* @author O.Vodotyiets
*/

function isValidBrackets(string $expression): bool
{
    $reservedChars = [
        '(' => true,
        '{' => true,
        '[' => true,
        ')' => false,
        '}' => false,
        ']' => false,
    ];

    $bracketsMap = [
        '(' => ')',
        '{' => '}',
        '[' => ']',
    ];

    $expressionLen = strlen($expression);

    $bracketsStack = [];

    for ($i = 0; $i < $expressionLen; $i++) {
        $char = $expression[$i];

        if (!isset($reservedChars[$char])) {
            continue;
        }

        $isOpenBracket = $reservedChars[$char];

        if ($isOpenBracket) {
            $bracketsStack[] = $char;
            continue;
        }

        $lastBracket = array_pop($bracketsStack);

        if (!$lastBracket || $bracketsMap[$lastBracket] !== $char) {
            return false;
        }
    }

    return count($bracketsStack) == 0;
}
