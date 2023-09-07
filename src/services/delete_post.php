<?php

require_once(dirname(__FILE__) . '/../dbconnect.php');

$pdo-> beginTransaction();
try{
  $sql = "DELETE FROM good_new WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt -> bindValue(':id', $_GET['id']);
  $stmt->execute();
  $pdo->commit();
  // Headerで状態のリダイレクトを返す⇒それを受け取って、index.phpで非同期処理
  header("Location: "."http://localhost:8080/admin/index.php");
} catch (PDOException $e) {
  $pdo->rollBack();
}
