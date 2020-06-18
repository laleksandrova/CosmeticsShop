<?php  
 $confirm=NULL;
 if ($_POST) 
	{
	  if ($_POST['conf']=='YES') 
	  { 
		$navigation = ' / <a href="products_edit.php">Продукти</a>'; 
		$confirm='y';
	  }
	} 	
if ($_GET) 
	{ 
		$id=$_GET['id']; 
	} else {
		$id=NULL; 
	}
require 'layout/init.inc.php'; 
	if ($confirm==NULL) { $navigation = ' / <a href="'.$_SERVER['PHP_SELF'].'">Продукти</a>'; } 
	$page_title = 'Продукти - Био магазин';
require 'layout/header.inc.php'; 

	if ($confirm=='y') { 
	 $mysqli->query("DELETE FROM products WHERE product_id=".(int)$_POST['id']); 
	 $aff_rows = $mysqli->affected_rows; 
		if($aff_rows){
			print'<div class="infoBlock">Изтрити записи: '.$aff_rows.'</div>';
		}else{
			print'<div class="errorBlock">Няма изтрити записи</div>';
			$confirm=NULL;
		}
	}	


 if ($id!=NULL) { 
		print'<div class="errorBlock"">
			<table><tr>
			 <td style="color: white;"><b>Потвърдете изтриване на продукти:</b></td> 
			 <form method="post" name="conf" action="'.$_SERVER['PHP_SELF'].'" class="form">
			 <input type="hidden" name="id" value="'.$id.'">
			 <td><input type="submit" name="conf" value="YES"></td>
			 <td><input type="submit" name="conf" value="CANCEL"></td>	
			 </form>
			 </tr></table>
			</div>';
	} 

$result = $mysqli->query("SELECT * FROM products");

if($result->num_rows>0){
	print'<table class="table-list">
		<tr>
			<th>Редактиране</th>
			<th>Снимка</th>
			<th>Пореден номер и име</th>
			<th>Изтриване</th>
		</tr>'; 
	while($row = $result->fetch_assoc()){
		$small_pic = $product_pictures_dir.$product_pictures_small_prefix.$row['picture'];
		$small_pic_exists = file_exists($small_pic); 
		$name = htmlspecialchars(stripcslashes($row['name']));		
		print'<tr>
			<td><a href="product_edit.php?id='.$row['product_id'].'"><img src="images/icons/edit.png" alt="Редактиране" title="Редактиране"</a></td>
			<td>';
			if ($small_pic_exists) { print'<img src="'.$small_pic.'" title="'.$name.'" alt="'.$name.'">';}
		print'</td> 
			<td>'.$row['product_id'].'. '.$name.'</td>
			<td><a href="'.$_SERVER['PHP_SELF'].'?id='.$row['product_id'].'"><img src="images/icons/delete.png" alt="Изтриване" title="Изтриване"</a></td>	
		</tr>'; 
	}
	print'</table>';
}
require 'layout/footer.inc.php'; 
 ?>