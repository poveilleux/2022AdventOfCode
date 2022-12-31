import System.IO (isEOF)
import Data.Int

addMe :: Integer -> Integer -> Integer
addMe x y = x + y

myFunc :: Integer -> IO Integer
myFunc acc = do
    done <- isEOF
    if done then
        return acc
    else do
        line <- getLine
        return (myFunc acc)

main = print (myFunc 1)