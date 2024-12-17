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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datea = $_POST['datea'];
    $timea = $_POST['timea'];
    $placea = $_POST['placea'];
    $id_applicant = $_POST['id_applicant'];
    $id_employee = $_POST['id_employee'];
    $id_lawsuit = $_POST['id_lawsuit'];
    $sql = "INSERT INTO claim (datea, timea, placea, id_applicant, id_employee, id_lawsuit) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiii", $datea, $timea, $placea,  $id_applicant, $id_employee, $id_lawsuit);

    if ($stmt->execute()) {
        $message = "Новое заявление добавлено";
    } else {
        $message = "Ошибка: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить новоое заявление</title>
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
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="datea">Дата принятия:</label>
            <div class="input-box">
            <input type="date" id="datea" name="datea" required><br>
            </div>
            <label for="timea">Время принятия:</label>
            <div class="input-box">
            <input type="time" id="timea" name="timea" required><br>
            </div>
            <label for="placea">Место принятия:</label>
            <div class="input-box">
            <input type="text" id="placea" name="placea" required><br>
            </div>
            <label for="id_applicant">ID заявителя:</label>
            <div class="input-box">
                <input type="number" id="id_applicant" name="id_applicant" required><br>
            </div>
            <label for="id_employee">ID сотрудника:</label>
            <div class="input-box">
                <input type="number" id="id_employee" name="id_employee" required><br>
            </div>
            <label for="id_lawsuit">ID дела:</label>
            <div class="input-box">
                <input type="number" id="id_lawsuit" name="id_lawsuit" required><br>
            </div>
            <input type="submit" value="Добавить заявление" class="btn">
        </form>
        <div class="links">
            <p><a href="claim.php">Назад</a></p>
        </div>
    </div>
</body>
</html>