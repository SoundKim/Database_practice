<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>KU GYM</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="workout_list.php" method="post">
    <div class='navbar fixed'>
        <div class='container'>
            <a class='pull-left title' href="index.php">KU GYM</a>
            <ul class='pull-right'>
                <li>
                    <input type="text" name="search_keyword" placeholder="운동검색">
                </li>
                <li><a href='workout_list.php'>운동 목록</a></li>
                <li><a href='workout_form.php'>운동 등록</a></li>
                <li><a href='program_list.php'>프로그램 목록</a></li>
                <li><a href='program_form.php'>프로그램 등록</a></li>
                <li><a href='schedule_list.php'>스케줄 목록</a></li>
                <li><a href='schedule_form.php'>스케줄 등록</a></li>
            </ul>
        </div>
    </div>
</form>
