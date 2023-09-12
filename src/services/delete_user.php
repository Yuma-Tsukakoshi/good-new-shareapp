<?php

require_once(dirname(__FILE__) . '/../dbconnect.php');

$pdo-> beginTransaction();

try{
    $sql = "UPDATE good_new SET exist = false WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt -> bindValue(':id', $_GET['id']);
    $stmt->execute();
    $pdo->commit();
    // Headerで状態のリダイレクトを返す⇒それを受け取って、index.phpで非同期処理
    // リンクの指定先を、ユーザー一覧にする
    header("Location: "."http://localhost:8080/admin/users/users.php");
    exit();
} catch (PDOException $e) {
    $pdo->rollBack();
}