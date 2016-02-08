<html>
<head>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.12.0.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
<h1>Редактируемый список</h1>
        <input class="product" type="text" name="product" value="" />
        <button class="addProduct" name="addProduct">Добавить</button>
<h2>Список продуктов</h2>
<div class="error"></div>
<div class="allProduct">
    <?php
    while($rows = mysqli_fetch_assoc($result)){?>
        <div class="<?php echo 'wrapProd'.$rows['id']; ?>">
            <div class="products" id="<?php echo 'product'.$rows['id']; ?>"><?php echo $rows['product']; ?></div>
            <div class="edit"><img editFieldId="<?php echo $rows['id']; ?>" class="imgEdit" src="images/stock-edit.png" /></div>
            <div class="delete"><img class="imgDelete" src="images/delete.png" deleteId="<?php echo $rows['id']; ?>" /></div>
            <div class="clear"></div>
        </div>
    <?php } ?>

    </div>
</body>
</html>