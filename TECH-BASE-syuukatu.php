<html>
<head>
<meta charset="utf-8">
</head>
<form method="POST" action="" >


<?php

////-----------制作途中！！！！

//---------------------データベース接続を行う-----------------------
$dsn='mysql:dbname=dango12345';
$user='dango12345';
$password='dango12345';
$pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));


$name = $_POST['name'];
$comments = $_POST['comments'];
$date =date("Y/m/d H:i:s");
$hidden_edit_number = $_POST['hidden_edit_number'];
$password =  $_POST['password'];

//-----------------------テーブル作成-----------------------------
$sql="CREATE TABLE IF NOT EXISTS table1"
."("
."id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,"
."name char(32),"
."comments TEXT,"
."date TEXT,"
."password TEXT"
.");";
$stmt=$pdo->query($sql);


//--------------------データを入力する------------------------------------
$name = $_POST['name'];
$comments = $_POST['comments'];
$date =date("Y/m/d H:i:s");
$hidden_edit_number = $_POST['hidden_edit_number'];
$password =  $_POST['password'];


if(!empty($_POST["comments"])){
if(!empty($_POST["name"])){
if(!empty($_POST["password"])){
if(!empty($_POST["hidden_edit_number"])){
$sql=$pdo->prepare("INSERT INTO table1(name,comments,date,password)VALUES(:name,:comments,:date,:password)");
$sql->bindParam(':name',$name,PDO::PARAM_STR);
$sql->bindParam(':comments',$comment,PDO::PARAM_STR);
$sql->bindParam(':date',$date,PDO::PARAM_STR);
$sql->bindParam(':password',$pass,PDO::PARAM_STR);
$sql->execute();
}
}
}
}
//------------------------削除機能-----------------------------------
$delete_number = $_POST['delete_number'];
if(!empty($_POST["delete_number"])){
if(!empty($_POST["password"])){
$sql=$pdo->prepare('SELECT id,password FROM table1 WHERE id = :id');
$sql->bindParam(':id',$delete_number,PDO::PARAM_INT);
$sql->execute();
$result =$sql->fetch();
$gantzggg=$result['password'];

if($gantzggg==$password){
$sql='delete from table1 where id=:id';
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':id',$delete_number,PDO::PARAM_INT);
$stmt->execute();
}elseif($gantzggg!==$password){
echo("<h5>正しいパスワードを入力してください</h5>");
}
}
}
//--------------------編集機能--------------------------------------------------
if(!empty($_POST["edit_number"])){
if(!empty($_POST["password"])){
$sql=$pdo->prepare('SELECT id,password FROM table1 WHERE id = :id');
$sql->bindParam(':id',$edit_number,PDO::PARAM_INT);
$sql->execute();
$result =$sql->fetch();
$gantzggg=$result['password'];

if($gantzggg==$password){
if(!empty($_POST["edit_number"])){       
$sql=$pdo->prepare('SELECT id,name,comments FROM table1 WHERE id = :edit_number');
$sql->bindParam(':edit_number',$edit_number,PDO::PARAM_INT);
$sql->execute();
$result =$sql->fetch();
$edit_name=$result['name'];
$edit_comments=$result['comments'];
$edit_number=$result['id'];
}
}elseif($gantzggg!==$pass){
echo("<h5>正しいパスワードを入力してください</h5>");
}
}
}

if(!empty($_POST['name'])){
if(!empty($_POST['comments'])){
if(!empty($_POST['hidden_edit_number'])){      
$sql='update table1 set name=:name,comments=:comments,date=:date where id=:hidden_edit_number';
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':name',$name,PDO::PARAM_STR);
$stmt->bindParam(':comments',$comment,PDO::PARAM_STR);
$stmt->bindParam(':date',$date,PDO::PARAM_STR);
$stmt->bindParam(':hidden_edit_number',$editnumber,PDO::PARAM_INT);
$stmt->execute();
}
}
}
//---------------------------------------------------------------------------------------
?>


<input type="text" name="name" placeholder="名前" value="<?php echo $edit_name; ?>"><br />
<input type="text" name="comments" placeholder="コメント" value="<?php echo $edit_comments; ?>">
<input type="submit" value="送信"><br /><br />
<input type="hidden" name="hidden_edit_number" value="<?php echo $hidden_edit_number; ?>">
<input type="text" name="delete_number" placeholder="削除対象番号" >
<input type="submit" value="削除"><br /><br />
<input type="text" name="edit_number" placeholder="編集番号">
<input type="submit" value="送信"><br />
<input type="password" name="password" placeholder="削除&編集&投稿パスワード">
<input type="submit" value="送信"><br /><br />

<?php
//---------------------------------データを表示する----------------------------------------
$sql='SELECT*FROM table1 ORDER BY id ASC';
$stmt=$pdo->query($sql);
$results=$stmt->fetchAll();
foreach($results as $hairetu){
echo $row['id'].',';
echo $row['name'].',';
echo $row['comments'].',';
echo $row['date'].'<br>';
}
?>
</form>
</html>