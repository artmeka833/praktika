<?php
if (isset($_POST['view_applicant'])) {
    header("Location: applicant.php");
    exit();
}
if (isset($_POST['view_employee'])) {
    header("Location: employee.php");
    exit();
}
if (isset($_POST['view_claim'])) {
    header("Location: claim.php");
    exit();
}
if (isset($_POST['view_lawsuit'])) {
    header("Location: lawsuit.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
        }

        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #1a73e8;
            font-size: 2.5em;
            margin-bottom: 30px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h2 {
            color: #1a73e8;
            font-size: 1.5em;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 1em;
            margin-bottom: 20px;
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

        @media (max-width: 600px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Панель администратора</h1>
        <div class="grid-container">
            <div class="card">
                <h2>Заявители</h2>
                <p>Управление информацией о заявителях</p>
                <form action="index.php" method="post">
                    <input type="submit" name="view_applicant" value="Просмотр" class="btn">
                </form>
            </div>
            <div class="card">
                <h2>Сотрудники</h2>
                <p>Управление информацией о заявителях</p>
                <form action="index.php" method="post">
                    <input type="submit" name="view_employee" value="Просмотр" class="btn">
                </form>
            </div>
            <div class="card">
                <h2>Заявления</h2>
                <p>Управление заявлениями</p>
                <form action="index.php" method="post">
                    <input type="submit" name="view_claim" value="Просмотр" class="btn">
                </form>
            </div>
            <div class="card">
                <h2>Дела</h2>
                <p>Управление делами</p>
                <form action="index.php" method="post">
                    <input type="submit" name="view_lawsuit" value="Просмотр" class="btn">
                </form>
            </div>
        </div>
    </div>
</body>
</html>