# Usage: cat input | python pancakes.py
import sys

happy = '+'
blank = '-'

def getFlipCount(input):
    height = input.count(happy + blank) + input.count(blank + happy) + 1
    if input.endswith(blank):
        return height
    return height - 1

def main():
    count = None
    for i, line in enumerate(sys.stdin):
        if i == 0:
            count = int(line.strip())
        if i > count:
            break

        print("Case #%d: %d" % (i, getFlipCount(line.strip())))

main()
