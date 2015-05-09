<?php
session_start();
if(isset($_SESSION['pokemon'])){
	
	$myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
	$txt = file_get_contents("newfile.txt");
	fclose($myfile);
	if($txt != ''){
	$str = $txt;
	preg_match_all('!\d+!', $str, $matches);
	
	$txt = 'Poke: Y '.$matches[0][0].' N '.$matches[0][1]
	.' Game: R '.$matches[0][2].' B '.$matches[0][3].' Y '.$matches[0][4]
	.' Ulti: Y '.$matches[0][5].' F '.$matches[0][6].' N '.$matches[0][7]
	.' Hash: Y '.$matches[0][8].' N '.$matches[0][9];
	
	echo $txt;
	}
	else {
		echo 'Poke: Y 0 N 0 Game: R 0 B 0 Y 0 Ulti: Y 0 F 0 N 0 Hash: Y 0 N 0';
	}
	echo '<br><a href="survey.php">Go Back</a>';
}
else {
if(isset($_POST['submit']) && $_POST['submit'] == 'submit'){
$_SESSION['poke'] = $_POST['poke'];

if (isset($_POST['pokemon'])){
	foreach($_POST['pokemon'] as $poke) {
		$_SESSION['pokemon'] .= $poke.'<br>';
	}
}
else {
	$_SESSION['pokemon'] = '';
}

$_SESSION["ulti"] = $_POST["ulti"];

$_SESSION["hash"] = $_POST["hash"];
}
?>
<!DOCTYPE HTML>
<html> 
<head>
<title>Survey is not a lie</title>
</head>
<body>
<?php
if (!isset($_REQUEST['poke'])){
?>
<form action="" method="post">
<p>
1. Do you like Pokemon?
<br>
<input type="radio" name="poke" value="Yes" checked>Yes
<br>
<input type="radio" name="poke" value="No">No
</p>

<p>
2. What Pokemon games have you played?
<br>
<input type="checkbox" name="pokemon[]" value="Red">Red
<br>
<input type="checkbox" name="pokemon[]" value="Blue">Blue
<br>
<input type="checkbox" name="pokemon[]" value="Yellow">Yellow
</p>

<p>
3. What is the answer to life the universe and everything?
<br>
<input type="radio" name="ulti" value="Yes" checked>Yes
<br>
<input type="radio" name="ulti" value="42">42
<br>
<input type="radio" name="ulti" value="No">No
</p>

<p>
4. Do you like #(Hashtags)?
<br>
<input type="radio" name="hash" value="Yes" checked>Yes
<br>
<input type="radio" name="hash" value="No">No
</p>

<input type="submit" name="submit" value="submit">
<input type="submit" name="request" value="request">
</form>
<?php } elseif(isset($_POST['request']) && $_POST['request'] == 'request') {
	$myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
	$txt = file_get_contents("newfile.txt");
	fclose($myfile);
	if($txt != ''){
	$str = $txt;
	preg_match_all('!\d+!', $str, $matches);
	
	$txt = 'Poke: Y '.$matches[0][0].' N '.$matches[0][1]
	.' Game: R '.$matches[0][2].' B '.$matches[0][3].' Y '.$matches[0][4]
	.' Ulti: Y '.$matches[0][5].' F '.$matches[0][6].' N '.$matches[0][7]
	.' Hash: Y '.$matches[0][8].' N '.$matches[0][9];
	
	echo $txt;
	}
	else {
		echo 'Poke: Y 0 N 0 Game: R 0 B 0 Y 0 Ulti: Y 0 F 0 N 0 Hash: Y 0 N 0';
	}
	echo '<br><a href="survey.php">Go Back</a>';
} else {?>
Your Answers:
<br>
1: <?php echo $_REQUEST['poke']; ?>
<br>
<br>
2:
<br>
<?php

if (isset($_REQUEST['pokemon'])){
	foreach($_REQUEST['pokemon'] as $poke) {
		echo $poke.'<br>';
	}
}
?>
<br>
3: <?php echo $_REQUEST["ulti"]; ?>
<br>
<br>
4: <?php echo $_REQUEST["hash"];
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
	if (isset($_REQUEST['pokemon'])){
		$stuff = implode("",$_REQUEST['pokemon']);
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
		$txt .= ' Ulti: Y 1 F 0 N 0';
	}
	elseif ($_POST["ulti"] == '42'){
		$txt .= ' Ulti: Y 0 F 1 N 0';
	}
	else {
		$txt .= ' Ulti: Y 0 F 0 N 1';
	}
	
//Sets results for ultimate question
	if ($_REQUEST["hash"] == 'Yes'){
		$txt .= ' Hash: Y 1 N 0';
	}
	else {
		$txt .= ' Hash: Y 0 N 1';
	}
}
else {
	$str = $txt;
	preg_match_all('!\d+!', $str, $matches);
	//////////////////////////////////////////////////////////////////////////////////////////////////////

	$poke = $_REQUEST["poke"];
//	Sets results for Poke

	if ($poke == "Yes"){
		$num = $matches[0][0] + 1;
		$txt = 'Poke: Y '. $num .' N '.$matches[0][1];
	}
	else {
		$num = $matches[0][1] + 1;
		$txt = 'Poke: Y '.$matches[0][0].' N '.$num;
	}
	
//	Sets results for Games	
	if (isset($_REQUEST['pokemon'])){
		$stuff = implode("",$_REQUEST['pokemon']);
		if (strpos($stuff, 'ed<br>')){
			$num = $matches[0][2] + 1;
			$txt .= ' Game: R '.$num;
		}
		else {
			$txt .= ' Game: R '.$matches[0][2];
		}
		if(strpos($stuff, 'Blue')){
			$num = $matches[0][3] + 1;
			$txt .= ' B '.$num;
		}
		else {
			$txt .= ' B '.$matches[0][3];
		}
		if(strpos($stuff, 'Yellow')){
			$num = $matches[0][4] + 1;
			$txt .= ' Y '.$num;
		}
		else {
			$txt .= ' Y '.$matches[0][4];
		}
	}
	else {
		$txt .= ' Game: R '.$matches[0][2].' B '.$matches[0][3].' Y '.$matches[0][4];
	}
	
//Sets results for ultimate question
	if ($_REQUEST["ulti"] == 'Yes'){
		$num = $matches[0][5] + 1;
		$txt .= ' Ulti: Y '.$num .' F '.$matches[0][6].' N '.$matches[0][7];
	}
	elseif ($_REQUEST["ulti"] == '42'){
		$num = $matches[0][6] + 1;
		$txt .= ' Ulti: Y '.$matches[0][5].' F '.$num .' N '.$matches[0][7];
	}
	else {
		$num = $matches[0][7] + 1;
		$txt .= ' Ulti: Y '.$matches[0][5].' F '.$matches[0][6].' N '.$num;
	}
	
//Sets results for ultimate question
	if ($_REQUEST["hash"] == 'Yes'){
		$num = $matches[0][8] + 1;
		$txt .= ' Hash: Y '.$num .' N '.$matches[0][9];
	}
	else {
		$num = $matches[0][0] + 1;
		$txt .= ' Hash: Y '.$matches[0][8].' N '.$num;
	}
}

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $txt);
fclose($myfile);


$myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
$txt = file_get_contents("newfile.txt");
fclose($myfile);
echo '<br>'.$txt;

 }
}?>
</body>
</html>
