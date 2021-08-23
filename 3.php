<?php

$numbers = [
    1789, 2035, 1899, 1456, 2013,
    1458, 2458, 1254, 1472, 2365,
    1456, 2265, 1457, 2456
];

echo "Enter numeric value to search for: ";
$input_num = readline();
$input_num = (int) $input_num;
if (in_array($input_num,$numbers))
{
    echo 'Your value is is array'.PHP_EOL;
}else{
    echo 'Value not found in array'.PHP_EOL;
}

//todo check if an array contains a value user entered