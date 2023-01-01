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

isCycle :: Integer -> Bool
isCycle num
    | num == 20 = True
    | num == 60 = True
    | num == 100 = True
    | num == 140 = True
    | num == 180 = True
    | num == 220 = True
    | otherwise = False

myFunc cycle x = do
    done <- isEOF
    if done then
        putStrLn ("The result for part 1 is " ++ (show cycle))
    else do
        line <- getLine
        if line == "noop" && (isCycle cycle) then
            do 
                print cycle
                myFunc (cycle + 1) x
        else if line == "noop" then
            do 
                myFunc (cycle + 1) x
        else do
            let numAsStr = (split ' ' line)!!1
            let addValue = read numAsStr :: Integer
            myFunc (cycle + 2) x

main = myFunc 0 1