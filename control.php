<?php

$dbh = new PDO('mysql:host=localhost;dbname=guestbook', 'root', '');

$stmt_select = $dbh->prepare("select * from user where `name` =? and `password`=?");

$stmt_select_one_message = $dbh->prepare("select * from message where `id`=?");


$stmt_insert = $dbh->prepare("insert into user(`name`, `password`, `email`) value(?, ?,?)");

$stmt_addMessage = $dbh->prepare("insert into message(`author`, `title`, `content`, `createTime`) value(?, ?,?,now())");

$stmt_list = $dbh->prepare('select * from message');

$stmt_delete = $dbh->prepare('delete  from message where `id` = ?');

$stmt_update = $dbh->prepare('update message set author=?, title = ?, content=?, updateTime=now() where `id` = ?');

    function select_one_message($dbh, $stmt, $id)
    {
        $stmt->bindParam(1, $id);
        $stmt->execute();

        if ($stmt->errorCode() != '00000'){
            $ret = $stmt->errorInfo()[2];
            return $ret;
        }
        else
        {
            $ret =  $stmt->fetchAll();
            // print_r($stmt);
            if (empty($ret)) {
                $ret = "message is empty";
            }
            return $ret;
        }
    }

    function login($dbh, $stmt, $username, $password)
    {

        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);

        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                echo "登陆成功";
                $ret ="OK";
            }
            else
            {
                echo "登陆失败";
                $ret ="FAIL";
            }
        }
        return $ret;
    }

    function register($dbh, $stmt, $userArr)
    {
        $username = $userArr['username'];
        $password = $userArr['password'];
        $email = $userArr['email'];
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        $stmt->bindParam(3, $email);

        $stmt->execute();
        if ($stmt->errorCode() != '00000'){
            $ret = $stmt->errorInfo()[2];

        }
        else
        {
            $ret = "OK";

        }

        return $ret;
    }

    function addMessage($dbh, $stmt, $message)
    {
        $author = $message['author'];
        $title = $message['title'];
        $content = $message['content'];

        $stmt->bindParam(1, $author);
        $stmt->bindParam(2, $title);
        $stmt->bindParam(3, $content);

        $stmt->execute();
        if ($stmt->errorCode() != '00000'){
            $ret = $stmt->errorInfo()[2];
        }
        else
        {
            $ret = "OK";
        }

        return $ret;
    }

    function listMessage($dbh, $stmt)
    {
        $stmt->execute();

        if ($stmt->errorCode() != '00000'){
            $ret = $stmt->errorInfo()[2];
            return $ret;
        }
        else
        {
            $ret =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($ret)) {
                $ret = "message is empty";
            }
            return $ret;
        }
    }

    function deleteMessage($dbh, $stmt, $id)
    {
        $stmt->bindParam(1, $id);
        $stmt->execute();
        if ($stmt->errorCode() != '00000'){
            $ret = $stmt->errorInfo()[2];
            return $ret;
        }
        else
        {
            $ret = "delete ok";
            return $ret;
        }
    }


    function listTemplate($arr)
    {
        if (empty($arr)) {
            return;
        }
        else
        {
            // print_r($arr);
            foreach ($arr as $key => $value) {
                $title = $value['title'];
                $user = $value['author'];
                $content =$value['content'];
                $createTime =$value['createTime'];
                $updateTime =$value['updateTime'];
                $id=$value['id'];

                $temp_file = "temp.html"; //临时文件，也可以是模板文件
                $fp = fopen($temp_file, "r"); //只读打开模板
                $str = fread($fp, filesize($temp_file));//读取模板中内容
                $str = str_replace("{title}", $title, $str);//替换内容
                $str = str_replace("{user}", $user, $str);//替换内容
                $str = str_replace("{content}", $content, $str);//替换内容
                $str = str_replace("{createTime}", $createTime, $str);//替换内容
                $str = str_replace("{updateTime}", $updateTime, $str);//替换内容
                $str = str_replace("{id}", $id, $str);//替换内容
                fclose($fp);
                echo $str;
            }

        }

    }

    function updateMessage($dbh, $stmt, $message)
    {

        $stmt->bindParam(1, $message['author']);
        $stmt->bindParam(2, $message['title']);
        $stmt->bindParam(3, $message['content']);
        $stmt->bindParam(4, $message['id']);
        $stmt->execute();


        if ($stmt->errorCode() != '00000'){
            $ret = $stmt->errorInfo()[2];
            return $ret;
        }
        else
        {
            $ret = "update ok";
            return $ret;
        }

    }

if (isset($_POST['action'])) {
    $action=$_POST['action'];


    if ($action=='login') {
        $username=$_POST['name'];
        $password=$_POST['password'];

        $ret = login($dbh, $stmt_select, $username, $password);

        if ($ret=="OK") {
            echo "<script>window.location.href='./list.php';</script>";
        }
        else
        {
            echo $ret;
        }

    }
    if ($action=='register') {

        $username=$_POST['name'];
        $password=$_POST['password'];
        $email=$_POST['email'];

        $userArr['username']=$username;
        $userArr['password']=$password;
        $userArr['email']=$email;

        $a =register($dbh, $stmt_insert, $userArr);
        if ($a=="OK") {
            echo "<script>window.location.href='./login.php';</script>";
        }
        else
        {
            echo $a;
        }

    }
    if ($action=='addMessage') {

        $username=$_POST['name'];
        $email=$_POST['title'];
        $content=$_POST['content'];

        $message['author']=$username;
        $message['title']=$email;
        $message['content']=$content;

        $ret = addMessage($dbh, $stmt_addMessage, $message);

        if ($ret=="OK") {
            echo "<script>window.location.href='./list.php';</script>";
        }
        else
        {
            echo $ret;
        }
    }
    if ($action=='updateMessage') {
        # code...
        $username=$_POST['name'];
        $email=$_POST['title'];
        $content=$_POST['content'];
        $id=$_POST['id'];

        $message['author']=$username;
        $message['title']=$email;
        $message['content']=$content;
        $message['id']=$id;

        // print_r($message);
        $ret = updateMessage($dbh, $stmt_update, $message);
        // print_r($ret);

        if ($ret=="update ok") {
            echo "<script>window.location.href='./list.php';</script>";
        }
        else
        {
            echo $ret;
        }

    }
}
else if (isset($_REQUEST['id'])) {
    $id=$_REQUEST['id'];

    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
        if ($action=="update") {
            // echo "update  lsldf ";

            $ret = select_one_message($dbh, $stmt_select_one_message, $id);
            // print_r($ret);
            $author=$ret[0]['author'];
            // print_r($author);
            $title=$ret[0]['title'];
            $content=$ret[0]['content'];

            $str=<<<HTML
<pre>
    <form action="control.php" method="post" name="addMessage" onsubmit="return Validate();">
        Name:   <input type="text" name="name" value="$author"/>

        Title:  <input type="text" name="title" value="$title"/>

        Message:
        <textarea cols="50" name="content" rows="10">$content</textarea>
        <input type="submit"  id="bb1" value="Submit"/>
        <input type="hidden" name="action" value="updateMessage">
        <input type="hidden" name="id" value="$id">
    </form>
</pre>
HTML;
            echo $str;




        }
        else if ($action=="delete") {

            // echo "delete sadfsda ";
            $ret = deleteMessage($dbh, $stmt_delete, $id);

                if ($ret == "delete ok") {
                    echo "<script>window.location.href='./list.php';</script>";
                }
                else
                {
                    echo $ret;
                }
        }
    }


}
else
{
    $a = listMessage($dbh, $stmt_list);
    // var_dump($a);

    if ($a =="message is empty") {
        echo "list is empty\n";
        echo "<a href='./add.php'>添加一条留言</a>";
    }
    else
    {
        $ret = listTemplate($a);
    }

}
