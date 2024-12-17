<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mvd";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['delete_record'])) {
    $record_id = $_POST['record_id'];
    $sql = "DELETE FROM claim WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $record_id);
    if ($stmt->execute()) {
        $message = "Запись удалена";
    } else {
        $message = "Ошибка удаления: " . $conn->error;
    }
    $stmt->close();
}
$sql = "SELECT id, datea, timea, placea, id_applicant, id_employee, id_lawsuit  FROM claim";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление информацией о заявлениях</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #3498db;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e8f4fd;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: #ffffff;
        }

        .btn-edit {
            background-color: #2ecc71;
            color: #ffffff;
            text-decoration: none;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
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

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 15px;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                content: attr(data-label);
                position: absolute;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Управление информацией о заявлениях</h1>
        <?php
        if (isset($message)) {
            echo "<div class='message'>$message</div>";
        }
        ?>
        <table>
            <thead><tr><th>ID</th><th>Дата принятия</th><th>Время принятия</th><th>Место принятия</th><th>ID заявителя</th><th>ID сотрудника</th><th>ID дела</th><th>Операции</th></tr></thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td data-label='ID'>".$row["id"]."</td>";
                        echo "<td data-label='Дата принятия'>".$row["datea"]."</td>";
                        echo "<td data-label='Время принятия'>".$row["timea"]."</td>";
                        echo "<td data-label='Место принятия'>".$row["placea"]."</td>";
                        echo "<td data-label='ID заявителя'>".$row["id_applicant"]."</td>";
                        echo "<td data-label='ID сотрудника'>".$row["id_employee"]."</td>";
                        echo "<td data-label='ID дела'>".$row["id_lawsuit"]."</td>";
                        echo "<td data-label='Операции'>
                                <div class='actions'>
                                    <form method='post' onsubmit='return confirm(\"Удалить запись?\");'>
                                        <input type='hidden' name='record_id' value='".$row["id"]."'>
                                        <button type='submit' name='delete_record' class='btn btn-delete'>Удалить</button>
                                    </form>
                                    <a href='change_claim.php?id=".$row["id"]."' class='btn btn-edit'>Изменить</a>
                                </div>
                              </td>";
                        echo "</tr>";
                    }
                }
                                ?>
            </tbody>
        </table>
        <div class="links">
            <a href="index.php">Назад</a>
            <a href="new_claim.php">Добавить новое заявление</a>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>