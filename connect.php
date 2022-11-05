<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-10-10 19:34:22
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-10-10 19:59:20
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
*/
include("config.php");
function select_db($mysqlselect,$token) {
  $pdo=new PDO("mysql:host=".host,username,password);
  $mysqlselect=$pdo->prepare($mysqlselect);
  $mysqlselect->execute(array(':token'=>$token));
  $getone=$mysqlselect->fetch();
  return $getone;
  }
echo select_db("select username,token from users where token=:token","");

?>
