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
	public ?Item $parent = NULL;
}

    $lines = explode("\r\n", $input);
    $tree = new Item;
    $tree->name = "/";
    $currentDirectory = $tree;

    $line = array_shift($lines);
    $tokens = explode(" ", $line);
    while (count($lines) > 0) {
    	if ($tokens[0] == "$") {
    		if ($tokens[1] == "cd") {
    			if ($tokens[2] == "/") {
    				echo "ROOT\n";
    			} else if ($tokens[2] == "..") {
    				$currentDirectory = $currentDirectory->parent;
    			} else {
    				$currentDirectory = $currentDirectory->children[$tokens[2]];
    			}

		    	$line = array_shift($lines);
		    	$tokens = explode(" ", $line);
    			
    		} else if ($tokens[1] == "ls") {
		    	$line = array_shift($lines);
		    	$tokens = explode(" ", $line);
		    	
		    	while ($tokens[0] != "$") {
		    		if ($tokens[0] == "dir") {
		    			$dir = new Item;
		    			$dir->name = $tokens[1];
		    			$dir->parent = $currentDirectory;
		    			$currentDirectory->children[$tokens[1]] = $dir;
		    		} else {
		    			$file = new Item;
		    			$file->name = $tokens[1];
		    			$file->size = intval($tokens[0]);
		    			$currentDirectory->children[$tokens[1]] = $file;
		    		}
		    		
		    		if (count($lines) == 0) {
		    		    break;
		    		}
			    	$line = array_shift($lines);
			    	$tokens = explode(" ", $line);
		    	}
    		} else {
	    		echo "FATAL: unexpected command ";
	    		print_r($tokens);
    			die();
	    	}
    	} else {
    		echo "FATAL: unexpected tokens ";
    		print_r($tokens);
    		die();
    	}
    }

	print_r($tree);
    echo "DONE\n";
?>