<?php 
require 'layout/init.inc.php';

$errorMessage = NULL;
$page_title = 'Вход - Био козметика';
$navigation = ' / <a href="'.$_SERVER['PHP_SELF'].'">Вход</a>';

if($_POST){
	$_POST['username'] = $mysqli->escape_string(trim($_POST['username']));
	$_POST['pass'] = $mysqli->escape_string(trim($_POST['pass'])); 
	$query = "SELECT * FROM users WHERE username='".$_POST['username']."' AND pass='".$_POST['pass']."'";
	$result = $mysqli->query($query);

	if($row = $result->fetch_assoc()) {
		$_SESSION['users_type'] = $row['users_type']; 		
		header("Location: products_edit.php"); 
		exit;
	} else {  
		$errorMessage = 'Невалидни потребителско име и/или парола! Моля опитайте пак.';
	}
}	

require 'layout/header.inc.php';

print'<div align="center">';

if($errorMessage!=NULL){
	print'<div class="errorBlock">'.$errorMessage.'</div>';
}

print'<form method="post" name="f" action="'.$_SERVER['PHP_SELF'].'" class="formLogin">
		<div class="form-title">Вход</div>
			<div class="form-row">
			<label for="usernameid">Потребителско име</label>
			<input type="text" maxlength="16" name="username" id="usernameid" value="">
		</div>
		<div class="form-row">
			<label for="passid">Парола</label>
			<input type="password" maxlength="16" name="pass" id="passid" value="">
		</div>
		<div class="form-row">
			<input class="purple-btn" type="submit" name="submit" value="Вход">
		</div>    
	</form>
</div>';

require 'layout/footer.inc.php'; 
?> 