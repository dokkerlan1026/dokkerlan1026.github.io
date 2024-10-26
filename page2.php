<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>九九乘法表生成器- Page 2</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>九九乘法表生成器- Page 2</h1>
    <form method="post">
        <label for="number">請輸入1-9之間的數字：</label>
        <input type="number" id="number" name="number" min="1" max="9" required>
        <input type="submit" value="生成乘法表">
    </form>
    <div class="button-container">
        <a href="index.php" class="button">前往 Page 1</a> <a href="page3.php" class="button">前往 Page 3</a>
    </div>
  
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $x = intval($_POST["number"]);
        if ($x >= 1 && $x <= 9) {
            echo "<h2>x = $x 的九九乘法表</h2>";
            echo "<table>";
            
            switch ($x) {
                case 1:
                    // 樣式1：標準九九乘法表
                    for ($i = 1; $i <= 9; $i++) {
                        echo "<tr>";
                        for ($j = 1; $j <= 9; $j++) {
                            $result = $i * $j;
                            //$class = ($i == $x || $j == $x) ? "highlight" : "";
                            //echo "<td class='$class'>$i × $j = $result</td>";
                            echo "<td >$i × $j = $result</td>";
                        }
                        echo "</tr>";
                    }
                    
                    break;
                case 2:
                    // 樣式2：倒三角形式
                    for ($i = 1; $i <= 9; $i++) {
                        echo "<tr>";
                        for ($j = 1; $j <= 9; $j++) {
                            $result = $i * $j;
                            //$class = ($i == $x || $j == $x) ? "highlight" : "";
                            //echo "<td class='$class'>$i × $j = $result</td>";
                            echo "<td >$j × $i = $result</td>";
                        }
                        echo "</tr>";
                    }
                    break;
                case 3:
                    // 樣式3：只顯示對角線及以下
                    for ($i = 1; $i <= 9; $i++) {
                        echo "<tr>";
                        for ($j = 1; $j <= 9; $j++) {
                            echo "<td >$i × $j </td>";
                        }
                        
                        echo "</tr>";
                    }
                    echo "<table>";
                    echo "<br>";
                    echo "</tr>";
                    for ($i = 1; $i <= 9; $i++) {
                        echo "<tr>";
                        for ($j = 1; $j <= 9; $j++) {
                            $result = $i * $j;
                            echo "<td >  &nbsp $result &nbsp   </td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    break;
                // ... 可以繼續添加更多樣式 ...
                default:
                    echo "<tr><td>暫未實現 x = $x 的樣式</td></tr>";
            }
            
            echo "</table>";
        } else {
            echo "<p>請輸入1-9之間的數字。</p>";
        }
    }
    ?>
</body>
</html>



