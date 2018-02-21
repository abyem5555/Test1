<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTMLにPHPを組み込む</title>
</head>
<body>
    2400円を2個購入した場合の金額は
    <?php
    $kingaku1 = price(2400,2);
    echo "{$kingaku1}円"
    ?>
    <br>
    
    1200円を5個購入した場合の金額は
    <?php
    $kingaku2 = price(1200, 5);
    echo "{$kingaku2}円";
    ?>

    <?php
    function price($tanka, $kosu){
        $souryo = 250;
        $ryoukin = $tanka * $kosu;

        if ($ryoukin < 5000){
            $ryoukin += $souryo;
        }
        return $ryoukin;
    }
    ?>
</body>
</html>