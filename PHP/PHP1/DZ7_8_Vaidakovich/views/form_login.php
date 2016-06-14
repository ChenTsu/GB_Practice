<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Страница авторизации</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h1>Введите ваши данные.</h1>
<?= $form_login_warning; ?>
<form method="post" action="">
    <input type="hidden" name="action" value="login"/>
    <label ><input type="text" name="username" value="" required /> Имя пользователя</label><br>
    <label><input type="password" name="userpassword" required> Пароль</label><br>
    <label> <input type="checkbox" value="1" name="remember"/> Запомнить меня </label><br>
    <input type="submit" value="Войти"/>
</form>
<form method="post" action="../register.php">
    <input type="submit" value="Регистрация"/>
</form>
</body>
</html>