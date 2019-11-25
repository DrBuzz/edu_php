<?php

abstract class Publication
{
    private $title, $text, $source;
    abstract public function getSource();
    abstract public function getContent();
    abstract public function getTitle();
    abstract public function getAll();
}

class News extends Publication {
    public function __construct ($ttl, $txt, $src){
        $this->title = $ttl;
        $this->text = $txt;
        $this->source = $src;
    }
    public function getSource(){
        return $this->source;
    }
    public function getContent(){
        return $this->text;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getAll(){
        return 0;
    }
}    

class Announce extends Publication {
    public function __construct ($ttl, $txt, $src){
        $this->title = $ttl;
        $this->text = $txt;
        $this->source = $src;
    }
    public function getSource(){
        return $this->source;
    }
    public function getContent(){
        return $this->text;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getAll(){
        return 0;
    }
}    

class MysqlConnection {
    private $pdo;
    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=mydb", 'newuser','password');
	    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $this->pdo->exec('set names utf8');
//$sql = "INSERT INTO users (name, age) VALUES (:name, :age)";
//$stmt = $pdo->prepare($sql);
    }
    public function create($table, $type, $title,$text,$source) {
        $sql = "INSERT INTO $table (title, text, $type) VALUES (:title,:text,:source)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':source', $source);
        $stmt->execute();

    }
    public function all($table) {
        $sql = "SELECT * FROM $table";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }
}

class NewsDB {
    public function create ($title, $text, $source) {
        $conn = new MysqlConnection();
        $conn->create("news", "link", $title, $text, $source);
        $res = new News($title, $text, $source);
        return $res;
    }
    public function all() {
        $conn = new MysqlConnection();
        $array = $conn->all("news");
        $newsArray =[];
        foreach ($array as $value) {
            $nws = new News($value["title"], $value["text"], $value["link"]);
            array_push($newsArray,$nws);
        }
        return $newsArray;
    }
}

class AnnounceDB {
    public function create ($title, $text, $source) {
        $conn = new MysqlConnection();
        $conn->create("announces", "author", $title, $text, $source);
        $res = new Announce($title, $text, $source);
        return $res;
    }
    public function all() {
        $conn = new MysqlConnection();
        $array = $conn->all("announces");
        $announcesArray =[];
        foreach ($array as $value) {
            $anns = new News($value["title"], $value["text"], $value["author"]);
            array_push($announcesArray,$anns);
        }
        return $announcesArray;
    }

}

function createFields(){
    $ndb = new NewsDB();
    $ndb->create("header 1", "text of the news article 1", "http://goodline.info");
    $ndb->create("header 2", "text of the news article 2", "http://a42.ru");
    $adb = new AnnounceDB();
    $adb->create("header 3", "text of the announce article 3", "Vladimir Putin");
    $adb->create("header 4", "text of the announce article 4", "Vladimir Lenin");
}

function allMethodWork(){
    $ndb = new NewsDB();
    $adb = new AnnounceDB();
    foreach ($ndb->all() as $record) {
        echo $record->getTitle() ." : ". $record->getContent() ." : ". $record->getSource() . "<br>";
    }
    foreach ($adb->all() as $record) {
        echo $record->getTitle() ." : ". $record->getContent() ." : ". $record->getSource() . "<br>";
    }

}

allMethodWork();
/*  Создание таблиц
CREATE TABLE news (
id INT(10) NOT NULL AUTO_INCREMENT, 
title VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,  
text TEXT,
link VARCHAR(200),
created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(`id`)
);

CREATE TABLE announces (
id INT(10) NOT NULL AUTO_INCREMENT, 
title VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,  
text TEXT,
author VARCHAR(200),
created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(`id`)
);
*/