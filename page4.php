<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>九九乘法表生成器 - Page 4</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>九九乘法表生成器 - Page 4 (直向列出)</h1>
    <form method="post">
        <label for="number">請輸入1-9之間的數字：</label>
        <input type="number" id="number" name="number" min="1" max="9" required>
        <input type="submit" value="生成乘法表">
    </form>
    <div class="button-container">
        <a href="page3.php" class="button">前往 Page 3</a> <a href="page5.php" class="button">前往 Page 5</a> 
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $x = intval($_POST["number"]);
        if ($x >= 1 && $x <= 9) {
            echo "<h2>x = $x 的九九乘法表 (直向列出)</h2>";
            echo "<div class='multiplication-table'>";
            
            switch ($x) {
                case 1:
                    // 標準九九乘法表
                    echo "<div class='group'>";
                    for ($i = 1; $i <= 9; $i++) {
                        echo "<div class='column'>";
                        for ($j = 1; $j <= 9; $j++) {
                            echo "<div class='cell'>$i × $j = " . ($i * $j) . "</div>";
                        }
                        echo "</div>";
                    }
                    break;
                
                case 2:
                    // 先奇數後偶數的九九乘法表
                    echo "<div class='group'>";
                    // 奇數列
                    for ($i = 1; $i <= 9; $i += 2) {
                        echo "<div class='column'>";
                        for ($j = 1; $j <= 9; $j++) {
                            echo "<div class='cell'>$i × $j = " . ($i * $j) . "</div>";
                        }
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "<div class='spacer'></div>";
                    echo "<div class='group'>";
                    // 偶數列
                    for ($i = 2; $i <= 8; $i += 2) {
                        echo "<div class='column'>";
                        for ($j = 1; $j <= 9; $j++) {
                            echo "<div class='cell'>$i × $j = " . ($i * $j) . "</div>";
                        }
                        echo "</div>";
                    }
                    echo "</div>";
                    break;
                
                case 3:
                    // 按 1,4,7 然後 2,5,8 最後 3,6,9 順序的九九乘法表
                    $groups = [[1,4,7], [2,5,8], [3,6,9]];
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
                    break;
                case 4:
                    // 按 1,5,9 然後 2,6然後3,7最後 4,8 順序的九九乘法表
                    $groups = [[1,5,9], [2,6], [3,7], [4,8]];
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
                    break;
                
                default:
                    echo "<p>暫未實現 x = $x 的樣式，請輸入 1, 2, 3 或 4。</p>";
            }
            
            echo "</div>";
        } else {
            echo "<p>請輸入1到9之間的數字。</p>";
        }
    }
    ?>
</body>
</html>
