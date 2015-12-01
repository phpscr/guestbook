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
                console.log("输入的用户名长度不得超过7个字符");
                return false;
            }
            else if (inputName.length == 0)
            {
                alert("输入的用户名不得为空");
                console.log("输入的用户名不得为空");
                return false;
            }
            else
            {
                return true;
            }


        }

        function verifyPassword(inputpassword)
        {
            if(inputpassword.length > 16)
            {
                alert("输入的密码长度不得超过16个字符");
                console.log("输入的密码长度不得超过16个字符");
                return false;
            }
            else if (inputpassword.length == 0)
            {
                alert("输入的密码不得为空");
                console.log("输入的密码不得为空");
                return false;
            }
            else
            {
                return true;
            }
        }

        function verifyAddress(inputemail)
        {
            var email = inputemail;
            var pattern = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
            flag = pattern.test(email);
            if(flag)
            {
                return true;
            }
            else
            {
                alert("您填写的邮箱地址不正确");
                console.log("您填写的邮箱地址不正确");
                return false;
            }
        }

        function Validate()
        {
            var name=document.forms["login"]["name"].value;
            var email=document.forms["login"]["email"].value;
            var password=document.forms["login"]["password"].value;

            return (verifyName(name.trim())&&verifyPassword(password)&&verifyAddress(email.trim()));

        }

    </script>
</head>
</head>
<body>

<form action="control.php" method="post" name="login" onsubmit="return Validate();">
  <pre>
    帐 号 ：<input type="text" name="name" /><br>
    密 码 ：<input type="password" name="password" /><br>
    邮 箱 ：<input type="text" name="email" /><br>
    <input type="submit" name="submit" value="注册"/>
    <input type="hidden" name="action" value="register">
  </pre>
</form>


</body>
</html>
