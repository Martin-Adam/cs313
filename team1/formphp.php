<html>
<body>

Your name: <?php echo $_POST["name"]; ?>
<br>
Your email address is: <?php echo $_POST["email"]; ?>
<br>
<br>
Major: <?php echo $_POST["major"]; ?>
<br>
Visted:
<br>
<?php
foreach($_POST['places'] as $place) {
     echo $place.'<br>';
}
?>
<br>
<br>
Comments:
<br>
<?php echo $_POST["comment"]; ?>
</body>
</html>
