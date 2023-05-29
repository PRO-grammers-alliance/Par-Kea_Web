<?php
$numeros = range(1, 9);
$CODIGO = "";
while (strlen($CODIGO) < 10) {
    
    $numRand = rand(0, count($numeros) - 1);
    $CODIGO = $CODIGO .  $numeros[$numRand];
}

echo $CODIGO;