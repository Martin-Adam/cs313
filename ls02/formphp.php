<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Results</title>
</head>
<body>
<?php
if (isset($_SESSION["poke"])){
	echo "is set";
}
else {
?>
Your Answers:
<br>
1: <?php echo $_POST["poke"]; ?>
<br>
<br>
2:
<br>
<?php

$stuff = '';
if (isset($_POST['pokemon'])){
	foreach($_POST['pokemon'] as $poke) {
		$stuff .= $poke.'<br>';
		echo $poke.'<br>';
	}
}
?>
<br>
3: <?php echo $_POST["ulti"]; ?>
<br>
<br>
4: <?php echo $_POST["hash"];
echo '<p>Results:';

$myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
$txt = file_get_contents("newfile.txt");
fclose($myfile);
if ($txt == ''){
	$poke = $_POST["poke"];
//	Sets results for Poke

	if ($poke == "Yes"){
		$txt = 'Poke: Y 1 N 0';
	}
	else {
		$txt = 'Poke: Y 0 N 1';
	}
//	Sets results for Games	
	if ($stuff != ''){
		if (strpos($stuff, 'ed<br>')){
			$txt .= ' Game: R 1';
		}
		else {
			$txt .= ' Game: R 0';
		}
		if(strpos($stuff, 'Blue')){
			$txt .= ' B 1';
		}
		else {
			$txt .= ' B 0';
		}
		if(strpos($stuff, 'Yellow')){
			$txt .= ' Y 1';
		}
		else {
			$txt .= ' Y 0';
		}
	}
	else {
		$txt .= ' Game: R 0 B 0 Y 0';
	}
	
//Sets results for ultimate question
	if ($_POST["ulti"] == 'Yes'){
		$txt .= ' Ulti: Y 1 N 0';
	}
	else {
		$txt .= ' Ulti: Y 0 N 1';
	}
	
//Sets results for ultimate question
	if ($_POST["hash"] == 'Yes'){
		$txt .= ' Hash: Y 1 N 0';
	}
	else {
		$txt .= ' Hash: Y 0 N 1';
	}
}
else {
	$txt = '';
}

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $txt);
fclose($myfile);


$myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
$txt = file_get_contents("newfile.txt");
fclose($myfile);
echo '<br>'.$txt;
}
?>
</p>
</body>
</html>
