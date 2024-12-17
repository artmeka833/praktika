<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mvd";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$message = '';
$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $odate = $_POST['odate'];
    $cdate = $_POST['cdate'];
    $court_decision = $_POST['court_decision'];
    $sql = "UPDATE lawsuit SET odate=?, cdate=?, court_decision=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $odate, $cdate, $court_decision,  $id);

    if ($stmt->execute()) {
        $message = "Дело изменено";
    } else {
        $message = "Ошибка: " . $stmt->error;
    }
    $stmt->close();
} else if ($id) {
    $sql = "SELECT * FROM lawsuit WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $class = $result->fetch_assoc();
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменить информацию о деле</title>
    <link rel="stylesheet" href="style_tb.css">
    <style>
        body { 
        font-family: Arial, sans-serif; 
        background-color: #f4f4f4; 
        margin: 0; 
        padding: 0; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        min-height: 100vh; 
        background-size: cover;
        background-position: center;
    } 
    .wrapper {
        width: 80%; 
        max-width: 800px; 
        background: rgb(255, 255, 255);
        color: black;
        border-radius: 5px;
        padding: 30px 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .wrapper form {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}
    h1 {
        text-align: center;
    }
    form {
        margin-top: 20px;
    }   
    a {
        color: #000000;
        text-decoration: none;
        font-weight: 600;
    }
        .wrapper .link{
    font-size: 14.5px;
    text-align: center;
    margin-top: 20px;
 }
 .wrapper .input-box{
    width: 70%;
    height: 50px;
    margin: 15px 0;
    position: relative;
}
.input-box input{
    width: 100%; 
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    border: 2px solid rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    font-size: 16px;
    color: rgb(0, 0, 0);
    padding: 0 20px;
 }
 .wrapper label {
            color: black;
            font-weight: bold;
            text-transform: uppercase;
            padding: 12px 15px;
            text-align: left;
}
.btn {
            display: inline-block;
            background-color: #1a73e8;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #155db1;
        }
        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #3498db;
            text-decoration: none;
            margin: 0 10px;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <?php
        if ($message) {
            echo "<p>$message</p>";
        }
        if (isset($class)) {
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="hidden" name="id" value="<?php echo $class['id']; ?>">
            <label for="odate">Дата открытия:</label>
            <div class="input-box">
            <input type="date" id="odate" name="odate" value="<?php echo $class['odate']; ?>" required><br>
            </div>
            <label for="cdate">Время закрытия:</label>
            <div class="input-box">
            <input type="date" id="cdate" name="cdate" value="<?php echo $class['cdate']; ?>" required><br>
            </div>
            <label for="court_decision">Решение суда:</label>
            <div class="input-box">
                <input type="text" id="court_decision" name="court_decision" value="<?php echo $class['court_decision'];?>" required><br>
            </div>
            <input type="submit" class="btn" value="Обновить информацию о деле">
        </form>
        <?php
        } else {
            echo "<p>Ничего не найдено</p>";
        }
        ?>
        <div class="links">
            <p><a href="lawsuit.php">Назад</a></p>
        </div>
    </div>
</body>
</html>