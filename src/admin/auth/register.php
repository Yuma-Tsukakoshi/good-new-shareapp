<?php
//フォームからの値をそれぞれ変数に代入
require_once(dirname(__FILE__) . '/../../dbconnect.php');

$name = $_POST['name'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
//PASSWORD_DEFAULT:bcrypt アルゴリズムを用いてパスワードをハッシュ化する

//フォームに入力されたmailがすでに登録されていないかチェック
$sql = "SELECT * FROM users WHERE mail = :mail";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':mail',$_POST['mail']);
$stmt->execute();
$member = $stmt->fetch();
if ($member['mail'] === $_POST['mail']) {
    $msg = '同じメールアドレスが存在します。';
    $link = '<a href="http://localhost:8080/admin/auth/signup.php">戻る</a>';
} else {
    //登録されていなければinsert 
    $sql = "INSERT INTO users(name, kisei, tate,yoko,birthday,mail) VALUES (:name, :kisei, :tate, :yoko, :birthday, :mail)";
    $stmt = $pdo->prepare($sql);
    $params = [
        ':name' => $name, 
        ':kisei' => $_POST['kisei'], ':tate' => $_POST['tate'], 
        ':yoko' => $_POST['yoko'], ':birthday' => $_POST['birthday'], ':mail' => $_POST['mail']
    ];
    $stmt->execute($params);

    $sql = "INSERT INTO user_invitations(user_id, password) VALUES (:user_id, :password)";
    $stmt = $pdo->prepare($sql);
    $params = [
        ':user_id' => $pdo->lastInsertId(), 
        ':password' => $pass
    ];
    $stmt->execute($params);
    
    $msg = '登録が完了しました';
    $link = '<a href="http://localhost:8080/admin/auth/login_form.php">ログインページへ</a>';
}
?>

<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>
