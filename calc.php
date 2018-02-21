<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>計算</title>
</head>
<body>
    <?php
    $item1 = $_POST["item1"];
    $item2 = $_POST["item2"];
    
    $result = $item1 + $item2;

    echo "結果は{$result}です。"
    ?>
</body>

</html>