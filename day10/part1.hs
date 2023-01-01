import System.IO (isEOF)

-- Source: https://stackoverflow.com/a/10967044
split :: Eq a => a -> [a] -> [[a]]
split x y = func x y [[]]
    where
        func x [] z = reverse $ map (reverse) z
        func x (y:ys) (z:zs) = if y==x then
            func x ys ([]:(z:zs))
        else
            func x ys ((y:z):zs)

myFunc cycle = do
    done <- isEOF
    if done then
        putStrLn ("The result for part 1 is " ++ (show cycle))
    else do
        line <- getLine
        if line == "noop" then
            putStrLn "FOO"
        else do
            let numAsStr = (split ' ' line)!!1
            let add = read numAsStr :: Integer
            print add
        myFunc (cycle + 1)

main = myFunc 1