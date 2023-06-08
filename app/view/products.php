<!DOCTYPE html>
<html>
<body>

<h1>PRODUCTS:</h1>

<?php

    foreach($data as $product) {
        echo '<h3> '.$product['name']. '</h3>';
    }

?>


</body>
</html>