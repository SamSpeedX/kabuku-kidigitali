<?php
$variable = "01234";

if (strpos($variable, '0') === 0) {
    $variable = trim($variable, 0);
}
echo $variable;
?>