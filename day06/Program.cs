using System;
using System.Collections;
using System.Collections.Generic;
using System.IO;
using System.Linq;

string input = File.ReadAllText("input.txt");

Part1(input);
Part2(input);

void Part1(string input)
{
    int skip = 0;
    while (true)
    {
        IEnumerable<char> part = input.Skip(skip).Take(4);
        if (part.Count() == part.Distinct().Count())
        {
            Console.WriteLine("Result for part 1 is: {0}", skip + 4);
            return;
        }

        skip++;
    }
}

void Part2(string input)
{
    int skip = 0;
    while (true)
    {
        IEnumerable<char> part = input.Skip(skip).Take(14);
        if (part.Count() == part.Distinct().Count())
        {
            Console.WriteLine("Result for part 2 is: {0}", skip + 14);
            return;
        }

        skip++;
    }
}