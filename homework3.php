<?php

function genPeople() {
$pdo = new PDO("mysql:host=localhost;dbname=my-db", 'newuser','password');
$sql = "INSERT INTO users (name, age) VALUES (:name, :age)";
$stmt = $pdo->prepare($sql);

   $charUpper = 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯ';
   $charLower = 'абвгдеёжзийклмнопрстуфхцчшщьыъэюя';
// mysql - говно
//   $charUpper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
//   $charLower = 'abcdefghijklmnopqrstuvwxyz';
   $length = 10;

   for ($l = 0; $l <1000; $l++) {
    $name = $charUpper[rand(0,32)]; //32 //25
     for ($i = 0; $i < $length; $i++) {
         $name .= $charLower[rand(0, 32)]; //32 //25
     }

    $age = rand(10,100);
   
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':age', $age);
    $stmt->execute();
   }

}

function getOver50() {
$pdo = new PDO("mysql:host=localhost;dbname=my-db", 'newuser','password');
$sql = "SELECT name FROM users WHERE age > 50";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $array;
}

function getAllAVandAB() {
$pdo = new PDO("mysql:host=localhost;dbname=my-db", 'newuser','password');
$sql = "SELECT name FROM users WHERE name like '%ab%' or name like '%av%'";
//$sql = "SELECT name FROM users WHERE name like '%аб%' or name like '%ав%'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
return json_encode($array);
}

function updAllOver70() {
$pdo = new PDO("mysql:host=localhost;dbname=my-db", 'newuser','password');
$sql = "SELECT id, name FROM users WHERE age > 70";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql = "update users set name = 'Pepito' where age >70";
$stmt = $pdo->prepare($sql);
$stmt->execute();
return json_encode($array);
}

function getDistinct() {
$pdo = new PDO("mysql:host=localhost;dbname=my-db", 'newuser','password');
$sql = "SELECT distinct name FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
return json_encode($array);
}


//genPeople(); //генерация 1000 случайных имен
//var_dump(getOver50()); //возвращаем массив юзернеймов старше 50
//echo getAllAVandAB(); //все строки, где в имени (name) есть буквосочетание “ав” или “аб”
//echo updAllOver70(); //изменяем все имена юзернеймов старше 70 на Pepito
//echo getDistinct(); //все уникальные имена (name) из таблицы users