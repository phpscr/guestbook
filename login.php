<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script type="text/javascript">

        function verifyName(inputName)
        {
            if(inputName.length > 7)
            {
                alert("输入的用户名长度不得超过7个字符");
                return false;
            }
            if (inputName.length == 0)
            {
                alert("输入的用户名不得为空");
                return false;
            }
        }

        function verifyPassword(inputpassword)
        {
            if(inputpassword.length > 16)
            {
                alert("输入的密码长度不得超过16个字符");
                return false;
            }
            if (inputpassword.length == 0)
            {
                alert("输入的密码不得为空");
                return false;
            }
        }

        function Validate()
        {
            var name=document.forms["login"]["name"].value;
            var password=document.forms["login"]["password"].value;

            verifyName(name.trim());
            verifyPassword(password);
        }

    </script>
</head>
</head>
<body>

<form action="control.php" method="post" name="login" onsubmit="return Validate();">
  <pre>
    帐 号 ：<input type="text" name="name" /><br>
    密 码 ：<input type="password" name="password" />
    <input type="submit" name="submit" value="登陆"/>
        <input type="hidden"  name="action"  value="login">
  </pre>
</form>

<a href="./register.php">注册</a>

</body>
</html>
