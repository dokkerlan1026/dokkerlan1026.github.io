<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>九九乘法表生成器- Page 1</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>九九乘法表生成器- Page 1</h1>
    <form method="post">
        <label for="number">請輸入1-9之間的數字：</label>
        <input type="number" id="number" name="number" min="1" max="9" required>
        <input type="submit" value="生成乘法表">
    </form>

    <div class="button-container">
        <a href="page2.php" class="button">前往 Page 2</a> 
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $x = intval($_POST["number"]);
        if ($x >= 1 && $x <= 9) {
            echo "<h2>x = $x 的九九乘法表</h2>";
            echo "<table>";
            for ($i = 1; $i <= 9; $i++) {
                echo "<tr>";
                for ($j = 1; $j <= 9; $j++) {
                    $result = $i * $j;
                    $class = ($i == $x || $j == $x) ? "highlight" : "";
                    echo "<td class='$class'>$i × $j = $result</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>請輸入1到9之間的數字。</p>";
        }
    }
    ?>
</body>
</html>
