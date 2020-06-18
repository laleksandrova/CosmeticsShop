<?php 
require 'layout/init.inc.php'; 
$link_text = '';
$kid =  (int)$_REQUEST['kid'];

if($kid) { 
	$query = "SELECT * FROM product_types WHERE product_type_id=".$kid; 
	$result = $mysqli->query($query);
	$row = $result->fetch_assoc();
	$link_text = htmlspecialchars(stripcslashes($row['category']));
}

$navigation = ' / <a href="'.$_SERVER['PHP_SELF'].($kid?'?kid='.$kid:'').'">'.$link_text.'</a>';
$page_title = $link_text.' - Био козметика';

require 'layout/header.inc.php';

print'<h1>'.$link_text.'</h1>';
  $query = "SELECT products.*, product_types.category FROM products "
  		." JOIN product_types ON products.product_type_id=product_types.product_type_id "
  		.($kid?" WHERE products.product_type_id=".$kid:"")." ORDER BY product_id ASC";
  $result = $mysqli->query($query);
  $num_results = $result->num_rows;

  if($num_results>0) {
		print'<table class="table-view"><tr>';
		$j=0;

		while($row = $result->fetch_assoc()) {
			print'<td>';
				$object_title = htmlspecialchars(stripslashes($row['name'].($row['type']?', '.$row['type']:'')));
				$small_pic = $product_pictures_dir.$product_pictures_small_prefix.$row['picture'];
				$small_pic_exists = file_exists($small_pic); 

				print'<a href="product.php?id='.$row['product_id'].'">
						<img class="img-product" src="'.$small_pic.'" alt="'.$object_title.'" title="'.$object_title.'">
					 </a>              
				<h2 class="product-name">'.htmlspecialchars(stripslashes($row['name'])).'</h2>';
				if($row["type"]) {
					print'<div class="product-type">Вид: '.htmlspecialchars(stripslashes($row["type"])).'</div>';
				}
				if($row["price"]) {
					print'<div class="product-price">'.$row["price"].' лв.</div>';
				}
				print'<a href="product.php?id='.$row["product_id"].'" class="more-info">Повече информация</a>
			</td>';

			$i=0;
			if($j==2) {
				if(($i+1)<$num_results)
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