<?php
require_once __DIR__.'/boot.php';

$user = null;

if (check_auth()) {
    // Получим данные пользователя по сохранённому идентификатору
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{ RIB Secure }</title>
   
  <link rel="stylesheet" href="css/bootstrap.css">
  <link href="/css/signin.css" rel="stylesheet">

</head>
<body>

<div class="container">
  <div class="row py-5">
    <div class="col-lg-6">

        <?php if ($user) { ?>

          <h1>Ну ты и соня. Тебя даже вчерашний шторм не разбудил. Говорят, мы уже приплыли в Морровинд. Нас выпустят, это точно <?=htmlspecialchars($user['username'])?>!</h1>

          <form class="mt-5" method="post" action="do_logout.php">
            <button type="submit" class="btn btn-primary">Выпустить</button>
          </form>

        <?php } else { ?>

            <?php flash(); ?>

<main class="form-signin w-100 m-auto">
  <form method="post" action="do_login.php">
    <img class="mb-4" src="../assets/brand/logo.webp" alt="" width="300" height="300">
     <div class="form-floating">
      <input type="text" class="form-control" id="username" name="username" required>
      <label for="floatingInput">Пользователь</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password">
      <label for="password">Пароль</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Входить сюда</button>
  </form>
</main>


        <?php } ?>

    </div>
  </div>
</div>

</body>
</html>
