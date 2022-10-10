<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-10-10 19:51:26
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-10-10 22:10:41
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
include("config.php");
try {
    $conn = new PDO("mysql:host=".host, username, password);
    // 设置 PDO 错误模式为异常
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
    START TRANSACTION;
    SET time_zone = \"+00:00\";
    CREATE DATABASE `omelette`;
    USE OMELETTE;
    CREATE TABLE `users` (
      `username` varchar(20) NOT NULL,
      `password` varchar(1000) NOT NULL,
      `token` varchar(32)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    // 使用 exec() ，因为没有结果返回
    $conn->exec($sql);

    echo "数据库创建成功<br>";
}
catch(PDOException $e)
{
    echo "数据库创建失败<br>";
    echo  $e->getMessage();
}

?>