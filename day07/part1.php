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
	public ?array $children = NULL;
	public int $size = 0;
	public ?Item $parent = NULL;
}

    $lines = explode("\r\n", $input);
    $tree = new Item;
    $tree->name = "/";
    $tree->children = array();
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
		    			$dir->children = array();
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

    $sum = 0;

    function calculate_size($current) {
    	global $sum;

		foreach ($current->children as $item) {
			if ($item->children != NULL) {
				calculate_size($item);
			}
		}

		foreach ($current->children as $item) {
			$current->size = $current->size + $item->size;
		}
		#echo "Size of $current->name: $current->size\n";
		if ($current->size <= 100000) {
			$sum = $sum + $current->size;
		}
    }

	calculate_size($tree);
	echo "The result for part 1 is: $sum\n";
	#print_r($tree);
    echo "DONE\n";
?>