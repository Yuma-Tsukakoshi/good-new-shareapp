<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="
  ../admin.css">
  <link href="../../vendor/tailwind/tailwind.output.css" rel="stylesheet">
  <title>新規登録完了</title>
</head>

<body>
  <h1>新規登録ユーザー充てにメールを送信しました。</h1>
  <a href="http://localhost:8080/admin/index.php">管理者画面トップページへ</a>

  <?php
  require_once(dirname(__FILE__) . '/../../dbconnect.php');

  // メール送信
  $to = $_POST['mail'];
  $subject = "ユーザー新規登録ありがとうございます";
  $message = "ご登録いただきありがとうございます。\n";
  $message .= "こちらのログイン画面URLから管理者一覧をご確認ください。\n";
  $message .= "http://localhost:8080/agent/agent_auth/agent_login.php";
  $headers = "From: admin@mail.com";

  $result = mail($to, $subject, $message, $headers);

  if ($result) {
    echo "メールが送信されました";
  } else {
    echo "メールの送信に失敗しました";
  }


  ?>

</body>

</html>
