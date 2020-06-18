<?php 

require 'layout/init.inc.php';

$errorMessage = NULL;
$infoMessage = NULL;
$operation_type = 'Добави продукт';

if($_REQUEST){ 
	$id = (int)$_REQUEST['id'];
} else { 
	$id = NULL; 
} 

if($_POST) { 
	$operation_type = 'Добави продукт';
	$id = $mysqli->escape_string(trim($_POST['id']));
	$name = $mysqli->escape_string(trim($_POST['name']));
	$product_type_id = $mysqli->escape_string($_POST['product_type_id']); 
	$type = $mysqli->escape_string(trim($_POST['type']));
	$price = $mysqli->escape_string((int)trim($_POST['price']));
	$info = $mysqli->escape_string(trim($_POST['info']));
	$picture = $mysqli->escape_string(trim($_POST['picture']));

	if(!$_POST['name'] || !$_POST['picture']) {
		$errorMessage = 'Моля, попълнете задължителните полета!';
	} else {	
		$picture=$picture.'.jpg';
		if($id){ 
			$query = "UPDATE products SET "
			." name= ".($name?"'".$name."'":"NULL").", "
			." product_type_id= ".($product_type_id?"'".$product_type_id."'":"NULL").", "
			." type= ".($type?"'".$type."'":"NULL").", "
			." price= ".($price?"'".$price."'":"NULL").", "
			." picture= ".($picture?"'".$picture."'":"NULL").", "
			." info= ".($info?"'".$info."'":"NULL")
			." WHERE product_id=".$id." AND product_id>5";
	    } else { 
			$query = "INSERT INTO products(name, product_type_id, type, price, picture, info) VALUES ("
			.($name?"'".$name."'":"NULL").", "
			.($product_type_id?"'".$product_type_id."'":"NULL").", "
			.($type?"'".$type."'":"NULL").", "
			.($price?"'".$price."'":"NULL").", "
			.($picture?"'".$picture."'":"NULL").", "
			.($info?"'".$info."'":"NULL").")";	
        }
	$mysqli->query($query); 
	$id = $id?$id:$mysqli->insert_id;
	$infoMessage = 'Продуктът е добавен успешно!';
    }
} 
else {  } 

if($id) { 
	$query = "SELECT * FROM products WHERE product_id=".$id;
	$result = $mysqli->query($query);

	if($row = $result->fetch_assoc()) {
		$operation_type = 'Добави продукт';
		$name = $row['name'];
		$product_type_id = $row['product_type_id'];
		$type = $row['type'];
		$price = $row['price'];
		$info = $row['info'];
		$picture = $row['picture'];
	}
}

$navigation = ' / <a href="products_edit.php">Продукти</a>'.' / '.$operation_type;
$page_title = $operation_type.' - Био козметика';

require 'layout/header.inc.php';

print' <div> ';	
if($id>=1 && $id<=5) {
	print'<div class="customError">(За първите 5 продукта e забраненa операцията промяна.)</div>';
} 
if($errorMessage) {
	print'<div class="errorBlock">'.$errorMessage.'</div>';
} 
if($infoMessage) {
	print'<div class="infoBlock">'.$infoMessage.'</div>';
} 	

//produkti-edit-forma

if($_POST || $_REQUEST) {  
print'

<form class="formProductEdit" method="post" name="f" action="'.$_SERVER['PHP_SELF'].'" >

<div class="container">
	<div class="left">
		<input type="hidden" name="id" value="'.$id.'">
		<input type="hidden" name="picture" value="'.$picture.'">
	';
		$small_pic = $product_pictures_dir.$product_pictures_small_prefix.$picture;
		$small_pic_exists = file_exists($small_pic); 

	print $small_pic_exists?'
		<div class="form-row"><img src="'.$small_pic.'" title="" alt=""></div>':'
	';


	print'
	</div>
	<div class="right">
		<div class="form-row">
			<label for="name">* Име</label>
			<input type="text" maxlength="64" name="name" id="name" value="'.htmlspecialchars(stripslashes($name)).'">
		</div>
		<div class="form-row">
			<label for="product_type_id">* Категория</label>
			<select name="product_type_id" id="product_type_id">';
				$query = 'SELECT * FROM product_types ORDER BY category';
				$result = $mysqli->query($query);

				while($row = $result->fetch_assoc()) {	
				$sel=''; 
				if($row['product_type_id']==$product_type_id) {$sel=' selected';}
				print' <option value="'.$row['product_type_id'].'"'.$sel.'>'.htmlspecialchars(stripslashes($row["category"])).'</option> ';
				}
				print'
			</select>
		</div>
		<div class="form-row">
			<label for="type">Вид</label>
			<input type="text" maxlength="32" name="type" id="type" value="'.htmlspecialchars(stripslashes($type)).'">
		</div>
		<div class="form-row">
			<label for="price">Цена (цяло число)</label>
			<input type="text" maxlength="4" name="price" id="price" value="'.htmlspecialchars(stripslashes($price)).'"> лв.
		</div>  ';

		$picture=str_replace('.jpg','',$picture);

		print'
			<div class="form-row">
				<label for="picture">* Снимка</label>
				<input type="text" maxlength="64" name="picture" id="picture" value="'.htmlspecialchars(stripslashes($picture)).'"> .jpg
			</div>	
			<div class="form-row">	    
				<label for="info">Описание</label>   
			</div>
			<div class="form-row">
				<textarea name="info" id="info" cols="30" rows="5">'.htmlspecialchars(stripslashes($info)).'</textarea>
			</div>
			 
	</div>

	<div>
		<input class="purple-btn" style="margin-top: 15px;" type="submit" name="submit" value="Запис">
	</div> 

</div>

</form>

';} 

//dobavi produkt

else {
print'

<form method="post" name="new" action="'.$_SERVER['PHP_SELF'].'" class="formProductEdit"">
	<input type="hidden" name="id" value="">
	<div class="form-title">'.$operation_type.'</div>

	<div class="form-row">
		<label for="name">* Име</label>
		<input type="text" maxlength="64" name="name" id="name" value="">
	</div>
	<div class="form-row">
		<label for="product_type_id">* Вид</label>
		<select name="product_type_id" id="product_type_id">';
			$query = 'SELECT * FROM product_types ORDER BY product_type_id';
			$result = $mysqli->query($query);
			while($row = $result->fetch_assoc()){
			print'<option value="'.$row['product_type_id'].'">'.htmlspecialchars(stripslashes($row["category"])).'</option>';
			}
		print'</select>
	</div>
	<div class="form-row">
		<label for="type">Вид</label>
		<input type="text" maxlength="32" name="type" id="type" value="">
	</div>
	<div class="form-row">
		<label for="price">Цена</label>
		<input placeholder="Цяло число" type="text" maxlength="4" name="price" id="price" value=""> лв.
	</div>
	<div class="form-row">
		<label for="picture">* Снимка</label>
		<input type="text" maxlength="64" name="picture" id="picture" value=""> .jpg
	</div>
	<div class="form-row">	    
		<label for="info">Описание на продукта</label>   
	</div>
	<div class="form-row">
		<textarea name="info" id="info"></textarea>
	</div>
	<div class="form-row">
		<input type="submit" name="submit" value="Запис">
	</div>    
</form>';}

print'</div>';

require 'layout/footer.inc.php'; 

?>