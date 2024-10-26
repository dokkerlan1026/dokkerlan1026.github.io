<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>九九乘法表生成器 - Page 3</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>九九乘法表生成器 - Page 3</h1>
    <form method="post">
        <label for="number">請輸入1-9之間的數字：</label>
        <input type="number" id="number" name="number" min="1" max="9" required>
        <input type="submit" value="生成乘法表">
    </form>
    <div class="button-container">
        <a href="page2.php" class="button">前往 Page 2</a> <a href="page4.php" class="button">前往 Page 4</a>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $x = intval($_POST["number"]);
        if ($x >= 1 && $x <= 9) {
            echo "<h2>x = $x 的九九乘法表</h2>";
            
            switch ($x) {
                case 1:
                    // 標準九九乘法表
                    echo "<table>";
                    for ($i = 1; $i <= 9; $i++) {
                        echo "<tr>";
                        for ($j = 1; $j <= 9; $j++) {
                            echo "<td>$i × $j = " . ($i * $j) . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    break;
                
                case 2:
                    // 先奇數後偶數的九九乘法表
                    echo "<table>";
                    // 奇數行
                    for ($i = 1; $i <= 9; $i += 2) {
                        echo "<tr>";
                        for ($j = 1; $j <= 9; $j++) {
                            echo "<td>$i × $j = " . ($i * $j) . "</td>";
                        }
                        echo "</tr>";
                    }
                    // 添加空白行
                    echo "<tr><td colspan='9' style='height: 20px;'></td></tr>";
                    // 偶數行
                    for ($i = 2; $i <= 8; $i += 2) {
                        echo "<tr>";
                        for ($j = 1; $j <= 9; $j++) {
                            echo "<td>$i × $j = " . ($i * $j) . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    break;
                
                case 3:
                    // 按 1,4,7 然後 2,5,8 最後 3,6,9 順序的九九乘法表
                    echo "<table>";
                    $groups = [[1,4,7], [2,5,8], [3,6,9]];
                    foreach ($groups as $index => $group) {
                        foreach ($group as $i) {
                            echo "<tr>";
                            for ($j = 1; $j <= 9; $j++) {
                                echo "<td>$i × $j = " . ($i * $j) . "</td>";
                            }
                            echo "</tr>";
                        }
                        // 在每组后添加空白行，除了最后一组
                        if ($index < count($groups) - 1) {
                            echo "<tr><td colspan='9' style='height: 20px;'></td></tr>";
                        }
                    }
                    echo "</table>";
                    break;
                
                default:
                    echo "<p>暫未實現 x = $x 的樣式，請輸入 1, 2 或 3。</p>";
            }
        } else {
            echo "<p>請輸入1到9之間的數字。</p>";
        }
    }
    ?>
</body>
</html>
