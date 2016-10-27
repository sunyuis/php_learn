<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>php表单</title>
</head>
<body>

<?php
// 定义变量并默认设置为空值
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["name"]))
    {
        $nameErr = "名字是必需的";
    }
    else
    {
        $name = test_input($_POST["name"]);
        // 检测名字是否只包含字母跟空格
        if (!preg_match("/^[a-zA-Z ]*$/",$name))
        {
            $nameErr = "只允许字母和空格"; 
        }
    }
    
    if (empty($_POST["email"]))
    {
      $emailErr = "邮箱是必需的";
    }
    else
    {
        $email = test_input($_POST["email"]);
        // 检测邮箱是否合法
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
        {
            $emailErr = "非法邮箱格式"; 
        }
    }
    
    if (empty($_POST["website"]))
    {
        $website = "";
    }
    else
    {
        $website = test_input($_POST["website"]);
        // 检测 URL 地址是否合法
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website))
        {
            $websiteErr = "非法的 URL 的地址";
        }
    }
    
    if (empty($_POST["comment"]))
    {
        $comment = "";
    }
    else
    {
        $comment = test_input($_POST["comment"]);
    }
    
    if (empty($_POST["gender"]))
    {
        $genderErr = "性别是必需的";
    }
    else
    {
        $gender = test_input($_POST["gender"]);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

    <div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
           名字: <input type="text" name="name" value="<?php echo $name;?>">
           <span class="error">* <?php echo $nameErr;?></span>
           <br><br>
           E-mail: <input type="text" name="email" value="<?php echo $email;?>">
           <span class="error">* <?php echo $emailErr;?></span>
           <br><br>
           网址: <input type="text" name="website" value="<?php echo $website;?>">
           <span class="error"><?php echo $websiteErr;?></span>
           <br><br>
           备注: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
           <br><br>
           性别:
           <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="female">女
           <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>  value="male">男
           <span class="error">* <?php echo $genderErr;?></span>
           <br><br>
           <input type="submit" name="submit" value="Submit">
           <input type="reset" name="reset" value="reset">
           <input type="reset" name="button" id="button" value="重置" />
        </form>
    </div>

<?php
echo "<h2>您输入的内容是:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>
<p>PHP Date() - 格式化日期</p>
<?php
echo date("Y/m/d") . "<br>";
echo date("Y.m.d") . "<br>";
echo date("Y-m-d");
?>
<p>PHP 包含文件</p>
<p>在 PHP 中，您可以在服务器执行 PHP 文件之前在该文件中插入一个文件的内容。<br />

include 和 require 语句用于在执行流中插入写在其他文件中的有用的代码。<br />

include 和 require 除了处理错误的方式不同之外，在其他方面都是相同的：<br />

    require 生成一个致命错误（E_COMPILE_ERROR），在错误发生后脚本会停止执行。<br />
    include 生成一个警告（E_WARNING），在错误发生后脚本会继续执行。
</p>  
<?php include 'header.php'; ?>
<h1>欢迎来到我的主页!</h1>
<p>一些文本。</p>
<p>
  打开文件<br />

fopen() 函数用于在 PHP 中打开文件。<br />

此函数的第一个参数含有要打开的文件的名称，第二个参数规定了使用哪种模式来打开文件：
</p>
<?php
$file=fopen("welcome.txt","w");
?>
<p>
  文件可能通过下列模式来打开：<br />
模式  描述<br />
r   只读。在文件的开头开始。<br />
r+  读/写。在文件的开头开始。<br />
w   只写。打开并清空文件的内容；如果文件不存在，则创建新文件。<br />
w+  读/写。打开并清空文件的内容；如果文件不存在，则创建新文件。<br />
a   追加。打开并向文件末尾进行写操作，如果文件不存在，则创建新文件。<br />
a+  读/追加。通过向文件末尾写内容，来保持文件内容。<br />
x   只写。创建新文件。如果文件已存在，则返回 FALSE 和一个错误。<br />
x+  读/写。创建新文件。如果文件已存在，则返回 FALSE 和一个错误。
</p>

<?php
$file = fopen("test.txt","r");

//执行一些代码

fclose($file);
?> 
<h1><blink>thisisa</blink></h1>
<script>
  
</script>
</body>
</html>