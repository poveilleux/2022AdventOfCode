#include <stdio.h>
#include <stdlib.h>

int main()
{
    int ROCK = 1;
    int PAPER = 2;
    int SCISSORS = 3;
    
    char *line = NULL;
    size_t len = 0;
    ssize_t lineSize = 0;
    int total = 0;
    
    while (lineSize = getline(&line, &len, stdin) > 0) {
        char first = line[0];
        char second = line[2];
        
        if (second == 'X') { // LOSE
            total += 0;
            
            if (first == 'A') { // rock
                total += SCISSORS;
            }
            
            if (first == 'B') { // paper
                total += ROCK;
            }
            
            if (first == 'C') { // scissors
                total += PAPER;
            }
        }
        
        if (second == 'Y') { // DRAW
            total += 3;
            
            if (first == 'A') { // rock
                total += ROCK;
            }
            
            if (first == 'B') { // paper
                total += PAPER;
            }
            
            if (first == 'C') { // scissors
                total += SCISSORS;
            }
        }
        
        if (second == 'Z') { // WIN
            total += 6;
            
            if (first == 'A') { // rock
                total += PAPER;
            }
            
            if (first == 'B') { // paper
                total += SCISSORS;
            }
            
            if (first == 'C') { // scissors
                total += ROCK;
            }
        }
    }
    free(line);
    printf("Total: %i", total);
    return 0;
}
