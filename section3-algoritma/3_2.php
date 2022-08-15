<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

function getResult($target, $n, $min = 1)
{
    $arrs = [];
    $max = $target;

    if ($n === 1 && $target <= $max) {
        array_push($arrs, [$target]);
    } else {
        for ($i = $min; $i < $target / $n && $i <= $max; $i++) {
            $arrays = getResult($target - $i, $n - 1, $i + 1);
            for ($j = 0; $j < count($arrays); $j++) {
                $array = $arrays[$j];
                array_splice($array, 0, 0, $i);
                array_push($arrs, $array);
            }
        }
    }

    return $arrs;
}

print_r(getResult(8, 3));
?>
</body>

</html>