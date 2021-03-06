<?php 
require 'layout/init.inc.php'; 

$page_title = 'Магазин за био козметика'; 
$navigation = NULL;
$kid=1;

require 'layout/header.inc.php';  

print'<h3>И това е само малка част...</h3>';

$query = "SELECT products.*, product_types.category FROM products 
		JOIN product_types ON products.product_type_id=product_types.product_type_id"
		.($kid?" WHERE products.product_type_id=".$kid:"")." ORDER BY product_id DESC LIMIT 5";
$result = $mysqli->query($query);
$num_results = $result->num_rows;

if($num_results > 0) {
	print'<table class="table-view"></tr>';
	$j=0;

	while($row = $result->fetch_assoc()) {
		print'<td>';
			$object_title = htmlspecialchars(stripslashes($row['name'].($row['type']?', '.$row['type']:'')));
			$small_pic = $product_pictures_dir.$product_pictures_small_prefix.$row['picture'];
			$small_pic_exists = file_exists($small_pic); 

			print'
			<a href="product.php?id='.$row['product_id'].'">
				<img class="img-product" src="'.$small_pic.'" alt="'.$object_title.'" title="'.$object_title.'">
			</a>              
			<h2 class="product-name">'.htmlspecialchars(stripslashes($row['name'])).'</h2>';

			if($row["type"]) {
				print'<div class="product-type">'
				.htmlspecialchars(stripslashes($row["type"])).'</div>';
			}

			if($row["price"]) {
				print'<div class="product-price">'.$row["price"].' лв.</div>';
			}

			print'<a href="product.php?id='.$row["product_id"].'" class="more-info">Повече информация</a>
		</td>';

		$i=0;
		if($j==2) {
			if(($i+1) < $num_results)
				print '</tr><tr>';
				$j = 0;
		}
		else
			$j++;  
	}
	print'</tr></table>';
}

require 'layout/footer.inc.php'; 
?>