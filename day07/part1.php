<?php
   $input = "$ cd /
$ ls
dir a
14848514 b.txt
8504156 c.dat
dir d
$ cd a
$ ls
dir e
29116 f
2557 g
62596 h.lst
$ cd e
$ ls
584 i
$ cd ..
$ cd ..
$ cd d
$ ls
4060174 j
8033020 d.log
5626152 d.ext
7214296 k";
class Item {
	public string $name = "";
	public array $children = [];
	public int $size = 0;
}

    $lines = explode("\n", $input);
    $i = 0;
    $currentDir = array();
    $tree = array();
    $currentParent = null;
    foreach ($lines as $line) {
    	$line = str_replace(PHP_EOL, "", $line);
        if (str_starts_with($line, "$ cd ")) {
            $path = str_replace("$ cd ", "", $line);
            if (str_contains($path, "..")) {
            	array_pop($currentDir);
            } else {
            	array_push($currentDir, $path);
            	$item = new Item;
            	$item->name = $path;
            	$tree[$path] = $item;
            }
        	#print_r($currentDir);
            #echo "CD: '$path'";
        }
        # echo "$i: $line\n";
        # $i++;
    }
    
	print_r($tree);
?> 