<?php

$k = 20;
$N = 0;
for($j=0;$j<$k;$j++)
{
    $n=$N;
    if($j!=1)
        $N+=2;

    for($i=$n;$i<$N;$i++)
    {
        echo $i.' ';
    }
}
?>