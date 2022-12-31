import System.IO (isEOF)
import Data.Int

myFunc acc = do
    done <- isEOF
    if done then
        putStrLn ("The result for part 1 is " ++ (show acc))
    else do
        line <- getLine
        print line
        myFunc (acc + 1)

main = myFunc 1