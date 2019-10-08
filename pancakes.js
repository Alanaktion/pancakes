// Usage: cat input | node pancakes.js

const happy = "+"
const blank = "-"

function getFlipCount(input) {
    height = substr_count(input, happy + blank) + substr_count(input, blank + happy) + 1;
    if (input.substr(-1) == blank) {
        return height;
    }
    return height - 1;
}

function substr_count(string, substring) {
    let n = 0;
    let pos = 0;
    let step = substring.length;

    while (true) {
        pos = string.indexOf(substring, pos);
        if (pos >= 0) {
            ++n;
            pos += step;
        } else break;
    }
    return n;
}

function handleInput() {
    const readline = require('readline');

    const rl = readline.createInterface({
        input: process.stdin,
        terminal: false,
    });

    let i = 0;
    let count;
    rl.on('line', line => {
        // Store number of expected input lines
        if (i == 0) {
            count = parseInt(line.trim());
            i++;
            return;
        }

        // Stop reading input after expected number of lines
        if (i > count) {
            return;
        }

        let input = line.trim();
        console.log(`Case #${i}: ${getFlipCount(input)}`);

        i++;
    });
}

handleInput();
