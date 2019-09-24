<?php
session_start();
$height=array();
$nodes=array();
$node=array();
$data="jkfd
fdsfs
fdfclose
trt
bvcb
nhgj
trdfxc";
if ($_GET['p']) {
	$p=$_GET['p'];
	create($p);
}else if ($_GET['i']) {
	$p=$_GET['i'];
	insert($p);
}else if ($_GET['d']) {
	$d=$_GET['d'];
	delete($d);
}else if ($_GET['s']) {
	$s=$_GET['s'];
	search($s);
}

function create($p){
	global $data;
	global $height,$node,$nodes;
	$maxLeaf=$p-1;
	$minLeaf=round(($p-1)/2);
	$data=explode(PHP_EOL, $data);
	sort($data);
	print_r($data);
	$nodes=row($nodes,$node,$data,$minLeaf,$maxLeaf);
	print_r($nodes);
	// $nodes2=row($nodes,$node,$data,$minLeaf,$maxLeaf);
	// print_r($nodes2);

	if (sizeof($nodes>2)) {
		$data2=array();
		for ($i=0; $i < sizeof($nodes)-1; $i++) { 
			array_push($data2, end($nodes[$i]));
		}
	}

	echo "<br>";
	echo "data2 updated ";
	print_r($data2);

	$_SESSION['pointer']=$p;
}
function insert($i){
	create($_SESSION['pointer']);
	global $nodes,$node;
	// while () {
	// 	# code...
	// }



}
function row($nodes,$node,$data,$minLeaf,$maxLeaf){
	for ($i=0; $i < sizeof($data); $i++) { 
		if (sizeof($node)==$maxLeaf) {
			array_push($nodes,$node);
			$node=array();
		}
		array_push($node,$data[$i]);
	}
	if (!empty($node)) {
		if (sizeof($node)<$minLeaf) {
			$loop=$minLeaf-sizeof($node);
			$last_nodes=array_pop($nodes);
			echo "<br>";
			echo "last_nodes ";
			print_r($last_nodes);
			echo "<br>";
			echo "last_node ";
			print_r($node);
			for ($i=0; $i < $loop; $i++) { 
				$last_node=array_pop($last_nodes);
				array_unshift($node, $last_node);
			}

			echo "<br>";
			echo "last_nodes updated ";
			print_r($last_nodes);
			echo "<br>";
			echo "last_node updated ";
			print_r($node);
			echo "<br>";

			array_push($nodes, $last_nodes);
			array_push($nodes, $node);
		}else{
			array_push($nodes,$node);
		}
	}
	return $nodes;
}
?>


<form method="GET" action="">
	pointer: <input type="number" name="p">
	insert: <input type="text" name="i">
	delete: <input type="text" name="d">
	search: <input type="number" name="s">
	<input type="submit" value="submit">
</form>