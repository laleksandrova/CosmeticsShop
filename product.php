<?php
require 'layout/init.inc.php';

$id = (int)$_REQUEST['id'];

if($id) {
	$query = "SELECT products.*, product_types.category, DATE_FORMAT(registration_date,'%d.%m.%Y г.') 
				AS date_formated "." FROM products JOIN product_types 
				ON products.product_type_id=product_types.product_type_id WHERE product_id=".$id;
	$result = $mysqli->query($query);
	$row_product = $result->fetch_assoc();
	$navigation = ' / <a href="products.php'.($row_product['product_type_id']?'?kid='.$row_product['product_type_id']:'').'">'
			.htmlspecialchars(stripcslashes($row_product['category'])).'</a>'
			.' / <a href="'.$_SERVER['PHP_SELF'].($id?'?id='.$id:'').'">'.htmlspecialchars(stripcslashes($row_product['name'])).'</a>';
	$page_title = 'Mагазин за био козметика - '.htmlspecialchars(stripcslashes($row_product['name']));
}

require 'layout/header.inc.php'; 

print'<div>	
	<table class="product-info-table">
		<tr>
			<td>
				<h2>'.htmlspecialchars(stripslashes($row_product['name'])).'</h2>';
				if($row_product["category"]){
					print'<div>Категория: '.htmlspecialchars(stripslashes($row_product["category"])).'</div>';
				}
				if($row_product["type"]){
					print'<div>Вид продукт: '.htmlspecialchars(stripslashes($row_product["type"])).'</div>';
				}
				if($row_product["price"]){
					print'<div>Цена: '.($row_product["price"]).' лв.</div>';
				}
				if($row_product["info"]){
					print'
						<div>Описание на продукта: '.htmlspecialchars(stripslashes($row_product["info"])).'</div>
					';
				}     
				print'<div>Дата на регистрация: '.($row_product["date_formated"]).'</div>		
			</td>
		</tr>
		<tr>
			<td>';
				$object_title = htmlspecialchars(stripslashes($row_product['name']).($row_product['type'])?', '.($row_product['type']):'');
				$pic = $product_pictures_dir.$row_product['picture'];
				$pic_exists = file_exists($pic); 
			print'<img class="img-product" src="'.$pic.'" alt="'.$object_title.'" title="'.$object_title.'">			
			</td>
		</tr>
	</table>             
</div>';

require 'layout/footer.inc.php'; 
?>