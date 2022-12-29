Imports System.IO
Imports System.Text.RegularExpressions

Module Program
    Structure Move
        Dim Amount As Integer
        Dim FromColumn As Integer
        Dim ToColumn As Integer

        Public Overrides Function ToString() As String
            Return "Amount: " & Amount & ", FromColumn: " & FromColumn & ", ToColumn: " & ToColumn
        End Function
    End Structure

    Sub Main()
        Part1()
        Part2()
    End Sub

    Sub Part1()
        Dim Pattern As String = "^move ([0-9]+) from ([0-9]+) to ([0-9]+)$"
        Dim Stacks As New List(Of Stack(Of String))
        Dim Instructions As New List(Of Move)
        Dim RawData As New Stack(Of String)

        Dim reader = File.OpenText("input.txt")
        ' Read input
        While (reader.Peek() <> -1)
            ' Read data
            Dim line = reader.ReadLine()
            If line.Contains("[") Then
                RawData.Push(line)
            End If

            ' Read instructions
            If line.StartsWith("move") Then
                Dim match = Regex.Match(line, Pattern)
                Dim instruction = New Move With {
                    .Amount = Integer.Parse(match.Groups(1).Value),
                    .FromColumn = Integer.Parse(match.Groups(2).Value),
                    .ToColumn = Integer.Parse(match.Groups(3).Value)
                }
                Instructions.Add(instruction)
            End If
        End While

        ' Re-order stacks
        For i = 0 To RawData.Count - 1
            Dim line = RawData(i)
            Dim index As Integer = 0
            Do
                index = line.IndexOf("[", index)
                If index > -1 Then
                    Dim character = line.ElementAt(index + 1)
                    Dim col = index / 4

                    If col >= Stacks.Count Then
                        Stacks.Add(New Stack(Of String))
                    End If

                    Stacks(col).Push(character)
                    index += 1
                End If
            Loop While index <> -1
        Next

        ' Do the moves
        For Each move In Instructions
            For i = 1 To move.Amount
                Stacks(move.ToColumn - 1).Push(Stacks(move.FromColumn - 1).Pop())
            Next
        Next

        ' PrintStacks(Stacks)
        PrintResult("1", Stacks)
    End Sub

    Sub Part2()
        Dim Pattern As String = "^move ([0-9]+) from ([0-9]+) to ([0-9]+)$"
        Dim Stacks As New List(Of Stack(Of String))
        Dim Instructions As New List(Of Move)
        Dim RawData As New Stack(Of String)

        Dim reader = File.OpenText("input.txt")
        ' Read input
        While (reader.Peek() <> -1)
            ' Read data
            Dim line = reader.ReadLine()
            If line.Contains("[") Then
                RawData.Push(line)
            End If

            ' Read instructions
            If line.StartsWith("move") Then
                Dim match = Regex.Match(line, Pattern)
                Dim instruction = New Move With {
                    .Amount = Integer.Parse(match.Groups(1).Value),
                    .FromColumn = Integer.Parse(match.Groups(2).Value),
                    .ToColumn = Integer.Parse(match.Groups(3).Value)
                }
                Instructions.Add(instruction)
            End If
        End While

        ' Re-order stacks
        For i = 0 To RawData.Count - 1
            Dim line = RawData(i)
            Dim index As Integer = 0
            Do
                index = line.IndexOf("[", index)
                If index > -1 Then
                    Dim character = line.ElementAt(index + 1)
                    Dim col = index / 4

                    If col >= Stacks.Count Then
                        Stacks.Add(New Stack(Of String))
                    End If

                    Stacks(col).Push(character)
                    index += 1
                End If
            Loop While index <> -1
        Next

        ' Do the moves
        For Each move In Instructions
            Dim buf As New Stack(Of String)
            For i = 1 To move.Amount
                buf.Push(Stacks(move.FromColumn - 1).Pop())
            Next
            For i = 1 To buf.Count
                Stacks(move.ToColumn - 1).Push(buf.Pop())
            Next
        Next

        ' PrintStacks(Stacks)
        PrintResult("2", Stacks)
    End Sub

    Sub PrintStacks(ByRef stacks As List(Of Stack(Of String)))
        For i = 0 To stacks.Count - 1
            Console.WriteLine("Column #" & (i + 1))
            For j = 0 To stacks(i).Count - 1
                Console.WriteLine(vbTab & stacks(i).ElementAt(j))
            Next
        Next
    End Sub

    Sub PrintResult(part As String, ByRef stacks As List(Of Stack(Of String)))
        Console.Write("Result for part {0} is: ", part)
        For i = 0 To stacks.Count - 1
            Console.Write(stacks(i).Peek())
        Next
        Console.WriteLine()
    End Sub
End Module
