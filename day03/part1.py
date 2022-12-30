file = open("input.txt", "r")
lines = file.readlines()

total = 0
for line in lines:
    part1, part2 = line[:len(line)//2], line[len(line)//2:]

    for c in part1:
        if part2.find(c) > -1:
            if c >= 'a' and c <= 'z':
                total += ord(c) - 96
            if c >= 'A' and c <= 'Z':
                total += ord(c) - 38
            break;

print("Total:", total)
