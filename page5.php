<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>九九乘法表生成器 - Page 5</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>九九乘法表生成器 - Page 5 (x=1直向列出，其他橫向列出)</h1>
    <form method="post">
        <label for="number">請輸入1-9之間的數字：</label>
        <input type="number" id="number" name="number" min="1" max="9" required>
        <input type="submit" value="生成乘法表">
    </form>
    <div class="button-container">
        <a href="page4.php" class="button">前往 Page 4</a> 
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $x = intval($_POST["number"]);
        if ($x >= 1 && $x <= 9) {
            echo "<h2>x = $x 的九九乘法表" . ($x == 1 ? " (直向列出)" : " (橫向列出)") . "</h2>";
            echo "<div class='multiplication-table" . ($x == 1 ? "" : " horizontal") . "'>";
            
            if ($x == 1) {
                // 当 x = 1 时，垂直排列
                echo "<div class='group'>";
                for ($i = 1; $i <= 9; $i++) {
                    echo "<div class='column'>";
                    for ($j = 1; $j <= 9; $j++) {
                        echo "<div class='cell'>$i × $j = " . ($i * $j) . "</div>";
                    }
                    echo "</div>";
                }
                echo "</div>";
            } else {
                // 当 x > 1 时，按 x 列排列，横向列出
                $groupCount = ceil(9 / $x);
                $groups = array_fill(0, $groupCount, []);
                
                for ($i = 1; $i <= 9; $i++) {
                    $groupIndex = ($i - 1) % $x;
                    $groups[$groupIndex][] = $i;
                }
                
                foreach ($groups as $index => $group) {
                    echo "<div class='group'>";
                    foreach ($group as $i) {
                        echo "<div class='column'>";
                        for ($j = 1; $j <= 9; $j++) {
                            echo "<div class='cell'>$i × $j = " . ($i * $j) . "</div>";
                        }
                        echo "</div>";
                    }
                    echo "</div>";
                    if ($index < count($groups) - 1) {
                        echo "<div class='spacer'></div>";
                    }
                }
            }
            
            echo "</div>";
        } else {
            echo "<p>請輸入1到9之間的數字。</p>";
        }
    }
    ?>
</body>
</html>
