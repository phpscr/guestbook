<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script type="text/javascript">

        function verifyTitle(inputtitle)
        {
            if (inputtitle.length == 0)
            {
                alert("输入的标题不得为空");
                return false;
            }
            else
            {
                return true;
            }
        }

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


        function Validate()
        {
            var name=document.forms["addMessage"]["name"].value;
            var title=document.forms["addMessage"]["title"].value;

            return (verifyName(name.trim())&&verifyTitle(title));
        }

    </script>
</head>
<body>

<pre>
    <form action="control.php" method="post" name="addMessage" onsubmit="return Validate();">
        Name:   <input type="text" name="name" />

        Title:  <input type="text" name="title" />

        Message:
        <textarea cols="50" name="content" rows="10"> </textarea>
        <input type="submit"  id="bb1" value="Submit"/>
        <input type="hidden" name="action" value="addMessage">
    </form>
</pre>
</body>

</html>







