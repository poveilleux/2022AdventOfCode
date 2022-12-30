file = open("input.txt", "r")
lines = file.readlines()

total = 0
for i in range(0, len(lines), 3):
    elf1, elf2, elf3 = lines[i], lines[i + 1], lines[i + 2]

    for c in elf1:
        if elf2.find(c) > -1 and elf3.find(c) > -1:
            if c >= 'a' and c <= 'z':
                total += ord(c) - 96
            if c >= 'A' and c <= 'Z':
                total += ord(c) - 38
            break;

print("Total:", total)
