<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once DATABASE . '/connect.php';

function fetch($query, ...$params) {
  global $connection;

  $stmt = $connection->prepare($query);

  if (!empty($params)) {
    $paramTypes = '';
    $paramValues = [];

    foreach ($params as $param) {
      $paramTypes .= $param['type'];
      $paramValues[] = $param['value'];
    }

    $stmt->bind_param($paramTypes, ...$paramValues);
  }

  if (!$stmt->execute()) {
    $stmt->close();
    $connection->close();
    return false;
  }

  $result = $stmt->get_result();
  $data = $result->fetch_all(MYSQLI_ASSOC);

  $stmt->close();

  return $result->num_rows > 1 || empty($data) ? $data : $data[0];
}

function fetchSingle($query, ...$params) {
  global $connection;

  $stmt = $connection->prepare($query);

  if (!empty($params)) {
    $paramTypes = '';
    $paramValues = [];

    foreach ($params as $param) {
      $paramTypes .= $param['type'];
      $paramValues[] = $param['value'];
    }

    $stmt->bind_param($paramTypes, ...$paramValues);
  }

  if (!$stmt->execute()) {
    $stmt->close();
    $connection->close();
    return false;
  }

  $result = $stmt->get_result();
  $data = $result->fetch_all(MYSQLI_ASSOC);

  $stmt->close();

  return $data;
}

function insert($query, ...$params) {
  global $connection;

  $stmt = $connection->prepare($query);

  if (!empty($params)) {
    $paramTypes = '';
    $paramValues = [];

    foreach ($params as $param) {
      $paramTypes .= $param['type'];
      $paramValues[] = $param['value'];
    }

    $stmt->bind_param($paramTypes, ...$paramValues);
  }

  if (!$stmt->execute()) {
    $stmt->close();
    $connection->close();
    return false;
  }

  $stmt->close();
  return true;
}
