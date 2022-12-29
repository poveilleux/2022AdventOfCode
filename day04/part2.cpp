#include <iostream>

using namespace std;

int main()
{
    int count = 0;
    string line;
    while (getline(cin, line)) {
        int i = line.find(",");
        string part1 = line.substr(0, i);
        int part1Index = part1.find("-");
        int part1Start = stoi(part1.substr(0, part1Index));
        int part1End = stoi(part1.substr(part1Index + 1, part1.length()));
        
        string part2 = line.substr(i + 1, line.length());
        int part2Index = part2.find("-");
        int part2Start = stoi(part2.substr(0, part2Index));
        int part2End = stoi(part2.substr(part2Index + 1, part2.length()));
        
        if (part1Start <= part2End && part1End >= part2Start) {
            count++;
        } 
    }
    
    cout << "Count: " << count;

    return 0;
}
