<?php
  // Не нажата кнопка submit -> уходим
  if(!isset($_POST['submit'])) {
    exit;
  }

  if (empty($_POST['email'])) {
    $err[] = 'This field can't be empty!';
  }

  if (empty($_POST['password1'])) {
    $err[] = 'This field can't be empty!';
  }

  if($_POST['password1'] != $_POST['password2']) {
    $err[] = 'Wrong password';
  }

  if (count($err) > 0) {
    exit;
  }

  $servername = "localhost"; // локалхост
  $username = "root"; // имя пользователя
  $password = "8956562132"; // пароль если существует
  $dbname = "may_project"; // база данных

  // Создание соединения
  $conn = new mysqli($servername, $username, $password, $dbname);
  // check connection
  if (mysqli_connect_errno()) {
    $err[] = 'Connect failed: '. mysqli_connect_error();
    exit;
  }

  function getUserId($conn, $email) {
    $results = $conn->query("SELECT id FROM users WHERE `e-mail`='$email' LIMIT 1");
    return $results->fetch_assoc()['id'];
  }

  $id = getUserId($conn, $_POST['email']);

  if (!$id) {
    //Получаем ХЕШ соли
    $salt = salt();

    //Солим пароль
    $pass = md5(md5($_POST['password']).$salt);

    $sql = "INSERT INTO users (`e-mail`, `age`, `gender`, `salt`, `password`)
            VALUES (
              '". escape_str($_POST['email']) ."',
              ". $_POST['age'] .",
              ". $_POST['gender'] .",
              '". $salt ."',
              '". $pass ."',
            )";
    $conn->query($sql);

    $id = getUserId($conn, $_POST['email']);

    // header('Location: ?mode=reg&status=ok');
    // exit;
  }

  // header('Location: ?mode=reg&status=fail');

  // Закрыть подключение
  $conn->close();
?>
