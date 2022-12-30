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
    $currentDirectory = NULL;
    $tree = new Item;
    $tree->name = "/";
    
  	$line = array_shift($lines);
  	$tokens = explode(" ", $line);
    while (count($lines) > 0) {
      echo "Count: ";
      echo count($lines);
      echo "\n";
    	if ($tokens[0] == "$") {
    		# echo "COMMAND\n";
    		# print_r($tokens);
    		if ($tokens[1] == "cd") {
    			# TODO: change path
		    	$line = array_shift($lines);
		    	$tokens = explode(" ", $line);
    			
    		} else if ($tokens[1] == "ls") {
		    	$line = array_shift($lines);
		    	$tokens = explode(" ", $line);
		    	
		    	while ($tokens[0] != "$" && count($lines) > 0) {
		    		if ($tokens[0] == "dir") {
		    			$dir = new Item;
		    			$dir->name = $tokens[1];
		    			$dir->parent = $tree;
		    			$tree->children[$tokens[1]] = $dir;
		    			#array_push($tree->children, $dir);
		    		} else {
		    			$file = new Item;
		    			$file->name = $tokens[1];
		    			$file->size = intval($tokens[0]);
		    			$tree->children[$tokens[1]] = $file;
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
    
    
    #$currentDir = array();
    #$currentDirectory = NULL;
    #foreach ($lines as $line) {
    #    if (str_starts_with($line, "$ cd ")) {
    #        $path = str_replace("$ cd ", "", $line);
    #        if ($path == "/") {
    #        	array_push($currentDir, $path);
    #        	$currentDirectory = new Item;
    #        	$currentDirectory->name = $path;
    #        } else if ($path == "..") {
    #        	array_pop($currentDir);
    #        	$
    #        } else {
    #        	array_push($currentDir, $path);
    #        	$item = new Item;
    #        	$item->name = $path;
    #        	//$tree[$path] = $item;
    #        }
    #    	#print_r($currentDir);
    #        #echo "CD: '$path'";
    #    }
    #    # echo "$i: $line\n";
    #    # $i++;
    #}
?>