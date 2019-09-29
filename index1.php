<form method="GET" action="">
	pointer: <input type="number" name="p">
	insert: <input type="text" name="i">
	delete: <input type="text" name="d">
	search: <input type="text" name="s">
	<input type="submit" value="submit">
</form>

<?php
session_start();
$height=array();
$nodes=array();
$node=array();
$data="jkfd
fdsfsa
fdfcloseb
trt
bvcbc
nhgjd
fdfclosee
trtf
bvcbg
nhgjh
fdfclosei
trtj
bvcbl
nhgjk
trdfxc";
$data = explode("\n", file_get_contents('a.txt'));
if (@$_GET['p']) {
	$p=$_GET['p'];
	create($p);
}else if (@$_GET['i']) {
	$p=$_GET['i'];
	// insert($p);
}else if (@$_GET['d']) {
	$d=$_GET['d'];
	// delete($d);
}else if (@$_GET['s']) {
	$s=$_GET['s'];
	search($s);
}

function create($p){
	$_SESSION['pointer']=$p;
	global $data;
	global $height,$node,$nodes;
	$maxLeaf=$p-1;
	$minLeaf=round(($p-1)/2);
	// $data=explode(PHP_EOL, $data);
	sort($data);
	$nodes=row($nodes,$node,$data,$minLeaf,$maxLeaf);
	array_push($height, $nodes);
	$height=recurse($height,$nodes,$p);
	print_r($height);
	if ($_SESSION['tree']=$height) {
		// echo "done";
	};
	echo sizeof($height);
	// print_r($height);
	// echo json_encode($height);

	
}
function insert($i){
	create($_SESSION['pointer']);
	global $nodes,$node;
	// while () {
	// 	# code...
	// }

}
function row($nodes,$node,$data,$minLeaf,$maxLeaf){
	$flag=0;
	for ($i=0; $i < sizeof($data); $i++) { 
		if (sizeof($node)==$maxLeaf) {
			array_push($nodes,$node);
			$node=array();
			$flag=$flag+1;
		}
		array_push($node,$data[$i]);
	}
	if (!empty($node)) {
		if (sizeof($node)<$minLeaf) {
			$loop=$minLeaf-sizeof($node);
			$last_nodes=array_pop($nodes);
			for ($i=0; $i < $loop; $i++) { 
				$last_node=array_pop($last_nodes);
				array_unshift($node, $last_node);
			}
			array_push($nodes, $last_nodes);
			array_push($nodes, $node);
		}else{
			array_push($nodes,$node);
		}
	}
	return $nodes;
}

function recurse($height,$nodes,$p){
	// print_r($nodes);
		if (sizeof($nodes)>1) {
			$data=array();
			for ($i=0; $i < sizeof($nodes)-1; $i++) { 
				 $end=end($nodes[$i]).',,'.$i;
				array_push($data, $end);
			}
			echo "<br><br><br>";
			// print_r($data);
			$nodes=array();
			$node=array();
			// global $nodes,$node;

			$minInt=round($p/2);
			$maxInt=$p;

			if (sizeof($data)<$p) {
				array_push($nodes,$data);
				array_push($height, $nodes);
				echo sizeof($height);
				// recurse($height,$nodes,$p);
// print_r($height);
				return $height;
			} else{
				$nodes=row($nodes,$node,$data,$minInt,$maxInt);
				// print_r($nodes);
				array_push($height, $nodes);
				// print_r($height);

				echo sizeof($height);
				$height=recurse($height,$nodes,$p);
			}
			// return $height;
		} 
		// else
		// $data=array();
		// for ($i=0; $i < sizeof($nodes)-1; $i++) { 
		// 	array_push($data, end($nodes[$i]));
		// }
		// array_push($height, $nodes);
		return $height;
		// }
	}

function search($s){
	$tree=$_SESSION['tree'];
	 $i=sizeof($tree)-1;
	$j=0;
	$k=0;
	// searchn($s,$tree,$i,$j,$k);
	aa($tree,$i,$j,$s);

	// for ($m=0; $m < sizeof($tree[0]); $m++) { 
	// 		for ($n=0; $n < sizeof($tree[0][$m]); $n++) { 
	// 			$node=explode('|', $tree[0][$m][$n]);
	// 			$word=$node[0];
	// 			if ($word==$s) {
	// 				echo $tree[0][$m][$n];
	// 				echo "<br> ".$m." ".$n;
	// 			}
	// 		}
	// 	}

	// echo $depth=sizeof($tree);
	// for ($i=$depth-1; $i >=0; $i--) { 
	// 	echo $nodes=sizeof($tree[$i]);
	// 	echo "<br>";
	// 	for ($j=0; $j < $nodes; $j++) { 
	// 		echo $node=sizeof($tree[$i][$j]);
	// 		echo " ";
	// 		print_r($tree[$i][$j]);
	// 	}

	// }
	// if ('abcfd'<'bcv') {
	// 	// echo "great";
	// }
}

// function searchn($s,$tree,$i,$j,$k){
	// if ($tree[$i][$j][$k]==$s) {
	// 	echo "found at ".$i." ".$j." ".$k;
	// }
	 // elseif($s<$tree[$i][$j][$k]){
	// echo $tree[$i][$j][$k];
	// $index=explode(',,', $tree[$i][$j][$k]);
// echo sizeof($index);
	// print_r($index);
	// if ($index[sizeof($index)-1]<sizeof($tree)) 
		// aa($tree,$i,$j,$s);
	// }else{
		// $i=$i-1;
		// $j=sizeof($tree[$i])-1;
		// $k=$index[sizeof($index)-2];
		// echo $k=end($index);
		// if ($i<0||$j<0||$k<0) {
		// 	echo "not found";
		// } else
		// 	searchn($s,$tree,$i,$j,$k);
	// }
// echo "<br>";

	// }
// }

function aa($tree,$i,$j,$s){
	for ($l=0; $l < sizeof($tree[$i][$j]); $l++) { 
		// echo "string";
			$node=explode('|', $tree[$i][$j][$l]);
			$word=$node[0];
			if ($word==$s) {
				// echo $tree[$i][$j][$l];
				// echo "<br> ".$i." ".$j." ".$l;
			} elseif($s<$word){
				$node=explode(',,', $tree[$i][$j][$l]);
				if ($i<0||$j<0||$l<0) {
						echo "not found";
					} else{
						 // $tree[$i-1][sizeof($node)-1][$l];
						if ($i!=0) {
							aa($tree,$i-1,$node[sizeof($node)-1],$s);
						}
						// break;
					}
					echo $tree[$i][$j][$l];
					echo "<br>";
					break;
			}
			// elseif($s>$word&&$l=(sizeof($tree[$i][$j])-1)){
			// 	$node=explode(',,', $tree[$i][$j][$l]);
			// 	if ($i<0||$j<0||$l<0) {
			// 			echo "not found";
			// 		} else{
			// 			 // $tree[$i-1][sizeof($node)-1][$l];
			// 			if ($i!=0) {

			// 				aa($tree,$i-1,end($node)+1,$s);

			// 			}
			// 			// break;
			// 		}
			// 		echo $tree[$i][$j][$l];
			// 		echo "<br>";
					
			// }
			// echo $tree[$i][$j][$l];
			
		}
}
?>


