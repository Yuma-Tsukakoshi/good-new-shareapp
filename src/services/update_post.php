<?php

require_once(dirname(__FILE__) . '/../dbconnect.php');

$params = [
  'id' => $_POST['id'],
  'post' => $_POST['post'],
];

$sql = "UPDATE good_new SET post = :post WHERE id = :id";

$pdo-> beginTransaction();
try{
  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);
  $pdo->commit();
  header("Location: "."http://localhost:8080/admin/index.php");
} catch (PDOException $e) {
  $pdo->rollBack();
  exit($e->getMessage());
}

?>
