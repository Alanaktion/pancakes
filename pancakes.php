#!/usr/bin/php
<?php
// Usage: cat input | php pancakes.php
declare(strict_types=1);

const HAPPY = '+';
const BLANK = '-';

/**
 * Blindly flip first blank pancake until whole stack is happy
 *
 * This works for short stacks, but longer stacks (len S ~= 100) can take
 * several nonillion iterations.
 *
 * @param string $input
 * @return int
 */
function naiveFlipCount(string $input): int
{
    $flips = 0;
    while (($p = strpos($input, BLANK)) !== false) {
        $flips ++;
        $top = substr($input, 0, $p + 1);
        $bottom = substr($input, $p + 1);
        $flippedTop = strtr($top, [BLANK => HAPPY, HAPPY => BLANK]);
        $input = $flippedTop . $bottom;
    }
    return $flips;
}

/**
 * Get optimized flip count
 *
 * @link https://code.google.com/codejam/contest/6254486/dashboard
 *
 * @param string $input
 * @return int
 */
function getFlipCount(string $input): int
{
    $height = substr_count($input, HAPPY . BLANK) + substr_count($input, BLANK . HAPPY) + 1;
    if (substr($input, -1) == BLANK) {
        return $height;
    }
    return $height - 1;
}

function handleInput(): void
{
    $i = 0;
    while ($line = fgets(STDIN)) {
        // Store number of expected input lines
        if ($i == 0) {
            $count = $line;
            $i++;
            continue;
        }

        // Stop reading input after expected number of lines
        if ($i > $count) {
            break;
        }

        // Handle input
        $input = trim($line);
        echo "Case #$i: ", getFlipCount($input), "\n";

        $i++;
    }
}

handleInput();
