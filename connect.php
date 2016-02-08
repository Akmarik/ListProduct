<?php
$link = new mysqli("localhost", "root", "", "listProduct");


$result = mysqli_query($link, "SELECT * FROM `product`");