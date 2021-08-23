<?php
$numbers = [];
$numbersClone = [];

foreach (range(0,9) as $elem)
{
    array_push($numbers , rand(0,100));
}

foreach ($numbers as $val)
{
    array_push($numbersClone,$val);
}

$numbers[count($numbers) -1] = -7;


function printer(array $arr):string
{
    $string = '';
    foreach ($arr as $val)
    {
        $string .= $val.' ';
    }
    return $string;
}
echo PHP_EOL.'Array 1: ';
echo printer($numbers) ;
echo PHP_EOL.'Array 2: ';
echo  printer($numbersClone);

echo PHP_EOL;

