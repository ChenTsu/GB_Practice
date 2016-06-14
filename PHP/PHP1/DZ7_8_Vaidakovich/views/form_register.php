<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h1>Форма регистрации</h1>
<h3>Пожалуйста, введите свои данные.</h3>
<?= $form_registration_warning; //формируется в register.php ?>
<form method="post">
    <input type="hidden" name="action" value="register"/>
    <label ><input type="text" name="username" value="" required /> Имя пользователя</label><br>
    <label><input type="password" name="password" required> Пароль</label><br>
    <input type="submit" value="Зарегистрироваться"/>
</form>
</body>
</html>