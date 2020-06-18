<?php 
print'
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>'.$page_title.'</title>
    <link href="styles/style.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates:400,500i,700|Playfair+Display:400,400i,900" rel="stylesheet">

</head>

<body>

    <div class="wrapper"> 
        <div class="header-menu">
            <a href="." class="header-menu-a">начало</a>';		

            if(!isset($_SESSION['users_type'])){

                print '
                    <span>
                        <a href="login.php" class="purple-btn">вход</a>
                    </span>
                ';			
            } 
            else {
            if($_SESSION['users_type']==1){	
                print '
                    <span>
                        <a href="products_edit.php" class="header-menu-a">продукти</a>
                        <a href="product_edit.php" class="header-menu-a">добави продукт</a>
                    </span>
                ';	
            }
            print '
                <span>
                    <a href="logout.php" class="purple-btn">изход</a>
                </span>
            ';
            }
            print'  

        </div>
            <div class="sidebar-menu">
                <div class="sidebar-menu-nav"> ';           

                $result = $mysqli->query("SELECT * FROM product_types");

                while($row = $result->fetch_assoc()){
                    print'
                        <a href="products.php?kid= '.$row['product_type_id'].' "class="sidebar-menu-a">
                            '.htmlspecialchars(stripslashes($row['category'])).'
                        </a>
                    ';
                }               
                print'
                </div>
            </div>

            <div class="main">
                <div id="navigation"> 
                    <a class="href-nav" href=".">начало</a>
                    '.$navigation.'

            </div>
            ';
?>