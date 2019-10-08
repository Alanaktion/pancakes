package main

// Usage: cat input | ./pancakes

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

const happy = "+"
const blank = "-"

func getFlipCount(input string) int {
	height := strings.Count(input, happy+blank) + strings.Count(input, blank+happy) + 1
	if strings.HasSuffix(input, blank) {
		return height
	}
	return height - 1
}

func main() {
	s := bufio.NewScanner(os.Stdin)

	var count int
	var i = 0
	for s.Scan() {
		// Store number of expected input lines
		if i == 0 {
			count, _ = strconv.Atoi(s.Text())
			i++
			continue
		}

		// Stop reading input after expected number of lines
		if i > count {
			break
		}

		// Handle input
		result := getFlipCount(s.Text())
		fmt.Printf("Case #%v: %v\n", i, result)

		i++
	}
}
