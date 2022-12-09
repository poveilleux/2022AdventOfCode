#include <stdio.h>
#include <stdlib.h>

int main()
{
    char *line = NULL;
    size_t len = 0;
    ssize_t lineSize = 0;
    int total = 0;
    
    while (lineSize = getline(&line, &len, stdin) > 0) {
        char first = line[0];
        char second = line[2];
        
        if (second == 'X') { // rock
            total += 1;
            
            if (first == 'A') { // rock (draw -> 3)
                total += 3;
            }
            
            if (first == 'B') { // paper (lose -> 0)
                total += 0;
            }
            
            if (first == 'C') { // scissors (win -> 6)
                total += 6;
            }
        }
        
        if (second == 'Y') { // paper
            total += 2;
            
            if (first == 'A') { // rock (win -> 6)
                total += 6;
            }
            
            if (first == 'B') { // paper (draw -> 3)
                total += 3;
            }
            
            if (first == 'C') { // scissors (lose -> 0)
                total += 0;
            }
        }
        
        if (second == 'Z') { // scissors
            total += 3;
            
            if (first == 'A') { // rock (lose -> 0)
                total += 0;
            }
            
            if (first == 'B') { // paper (win -> 6)
                total += 6;
            }
            
            if (first == 'C') { // scissors (draw -> 3)
                total += 3;
            }
        }
    }
    free(line);
    printf("Total: %i", total);
    return 0;
}
