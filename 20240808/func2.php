<?php

function distance($x1, $y1, $x2, $y2)
{
    return sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
}

//echo distance(3, 5, 6, 1);