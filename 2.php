
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>php2</title>
</head>
<body>
<p>PHP 超级全局变量
PHP中预定义了几个超级全局变量（superglobals） ，这意味着它们在一个脚本的全部作用域中都可用。 你不需要特别说明，就可以在函数及类中使用。PHP 超级全局变量列表:
$GLOBALS<br>
$_SERVER<br>
$_REQUEST<br>
$_POST<br>
$_GET<br>
$_FILES<br>
$_ENV<br>
$_COOKIE<br>
$_SESSION<br>
本章节我们将讲解几个常用的超级全局变量,其余变量我们在接下来几个章节会介绍到。</p>
<p>PHP $GLOBALS
$GLOBALS 是PHP的一个超级全局变量组，在一个PHP脚本的全部作用域中都可以访问。
$GLOBALS 是一个包含了全部变量的全局组合数组。变量的名字就是数组的键。
以下实例介绍了如何使用超级全局变量 $GLOBALS:</p>
<?php
$x = 75;
$y = 25;

function addition()
{
$GLOBALS['z'] = $GLOBALS['x'] + $GLOBALS['y'];
}

addition();
echo $z;
?>
<p>PHP $_SERVER<br>
$_SERVER 是一个包含了诸如头信息(header)、路径(path)、以及脚本位置(script locations)等等信息的数组。这个数组中的项目由 Web 服务器创建。不能保证每个服务器都提供全部项目；服务器可能会忽略一些，或者提供一些没有在这里列举出来的项目。
以下实例中展示了如何使用$_SERVER中的元素:</p>
<?php 
echo '$_SERVER[\'PHP_SELF\']:'.$_SERVER['PHP_SELF'];
echo "<br>";
echo '$_SERVER[\'SERVER_NAME\']:'.$_SERVER['SERVER_NAME'];
echo "<br>";
echo '$_SERVER[\'HTTP_HOST\']:'.$_SERVER['HTTP_HOST'];
echo "<br>";
echo '$_SERVER[\'HTTP_REFERER\']:'.$_SERVER['HTTP_REFERER'];
echo "<br>";
echo '$_SERVER[\'HTTP_USER_AGENT\']:'.$_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo '$_SERVER[\'SCRIPT_NAME\']:'.$_SERVER['SCRIPT_NAME'];
?>
<p>下表列出了所有 $_SERVER 变量中的重要元素:<br>
元素/代码   描述<br>
$_SERVER['PHP_SELF']    当前执行脚本的文件名，与 document root 有关。例如，在地址为 http://example.com/test.php/foo.bar 的脚本中使用 $_SERVER['PHP_SELF'] 将得到 /test.php/foo.bar。__FILE__ 常量包含当前(例如包含)文件的完整路径和文件名。 从 PHP 4.3.0 版本开始，如果 PHP 以命令行模式运行，这个变量将包含脚本名。之前的版本该变量不可用。<br>
$_SERVER['GATEWAY_INTERFACE']   服务器使用的 CGI 规范的版本；例如，"CGI/1.1"。<br>
$_SERVER['SERVER_ADDR'] 当前运行脚本所在的服务器的 IP 地址。<br>
$_SERVER['SERVER_NAME'] 当前运行脚本所在的服务器的主机名。如果脚本运行于虚拟主机中，该名称是由那个虚拟主机所设置的值决定。(如: www.runoob.com)<br>
$_SERVER['SERVER_SOFTWARE'] 服务器标识字符串，在响应请求时的头信息中给出。 (如：Apache/2.2.24)<br>
$_SERVER['SERVER_PROTOCOL'] 请求页面时通信协议的名称和版本。例如，"HTTP/1.0"。<br>
$_SERVER['REQUEST_METHOD']  访问页面使用的请求方法；例如，"GET", "HEAD"，"POST"，"PUT"。<br>
$_SERVER['REQUEST_TIME']    请求开始时的时间戳。从 PHP 5.1.0 起可用。 (如：1377687496)<br>
$_SERVER['QUERY_STRING']    query string（查询字符串），如果有的话，通过它进行页面访问。<br>
$_SERVER['HTTP_ACCEPT'] 当前请求头中 Accept: 项的内容，如果存在的话。<br>
$_SERVER['HTTP_ACCEPT_CHARSET'] 当前请求头中 Accept-Charset: 项的内容，如果存在的话。例如："iso-8859-1,*,utf-8"。<br>
$_SERVER['HTTP_HOST']   当前请求头中 Host: 项的内容，如果存在的话。<br>
$_SERVER['HTTP_REFERER']    引导用户代理到当前页的前一页的地址（如果存在）。由 user agent 设置决定。并不是所有的用户代理都会设置该项，有的还提供了修改 HTTP_REFERER 的功能。简言之，该值并不可信。)<br>
$_SERVER['HTTPS']   如果脚本是通过 HTTPS 协议被访问，则被设为一个非空的值。<br>
$_SERVER['REMOTE_ADDR'] 浏览当前页面的用户的 IP 地址。<br>
$_SERVER['REMOTE_HOST'] 浏览当前页面的用户的主机名。DNS 反向解析不依赖于用户的 REMOTE_ADDR。<br>
$_SERVER['REMOTE_PORT'] 用户机器上连接到 Web 服务器所使用的端口号。<br>
$_SERVER['SCRIPT_FILENAME'] 当前执行脚本的绝对路径。<br>
$_SERVER['SERVER_ADMIN']    该值指明了 Apache 服务器配置文件中的 SERVER_ADMIN 参数。如果脚本运行在一个虚拟主机上，则该值是那个虚拟主机的值。(如：someone@runoob.com)<br>
$_SERVER['SERVER_PORT'] Web 服务器使用的端口。默认值为 "80"。如果使用 SSL 安全连接，则这个值为用户设置的 HTTP 端口。<br>
$_SERVER['SERVER_SIGNATURE']    包含了服务器版本和虚拟主机名的字符串。<br>
$_SERVER['PATH_TRANSLATED'] 当前脚本所在文件系统（非文档根目录）的基本路径。这是在服务器进行虚拟到真实路径的映像后的结果。<br>
$_SERVER['SCRIPT_NAME'] 包含当前脚本的路径。这在页面需要指向自己时非常有用。__FILE__ 常量包含当前脚本(例如包含文件)的完整路径和文件名。<br>
$_SERVER['SCRIPT_URI']  URI 用来指定要访问的页面。例如 "/index.html"。</p>
<p>
    PHP $_REQUEST<br>
PHP $_REQUEST 用于收集HTML表单提交的数据。<br>
以下实例显示了一个输入字段（input）及提交按钮(submit)的表单(form)。 当用户通过点击 "Submit" 按钮提交表单数据时, 表单数据将发送至<form>标签中 action 属性中指定的脚本文件。 在这个实例中，我们指定文件来处理表单数据。如果你希望其他的PHP文件来处理该数据，你可以修改该指定的脚本文件名。 然后，我们可以使用超级全局变量 $_REQUEST 来收集表单中的 input 字段数据:
</p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Name: <input type="text" name="fname">
<input type="submit">
</form>

<?php 
$name = $_REQUEST['fname'];
echo $name;
?>

<p>
PHP $_POST<br>
PHP $_POST 被广泛应用于收集表单数据，在HTML form标签的指定该属性："method="post"。
以下实例显示了一个输入字段（input）及提交按钮(submit)的表单(form)。 当用户通过点击 "Submit" 按钮提交表单数据时, 表单数据将发送至<form>标签中 action 属性中指定的脚本文件。 在这个实例中，我们指定文件来处理表单数据。如果你希望其他的PHP文件来处理该数据，你可以修改该指定的脚本文件名。 然后，我们可以使用超级全局变量 $_POST 来收集表单中的 input 字段数据:
</p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Name: <input type="text" name="fname">
<input type="submit">
</form>

<?php
$name = $_POST['fname'];
echo $name;
?>
<p>
    PHP $_GET<br>
PHP $_GET 同样被广泛应用于收集表单数据，在HTML form标签的指定该属性："method="get"。<br>
$_GET 也可以收集URL中发送的数据。<br>
假定我们有一个包含参数的超链接HTML页面：<br>
</p>
<a href="test_get.php?subject=PHP&web=runoob.com">Test $GET</a>

<p>PHP 循环<br>
在您编写代码时，您经常需要让相同的代码块一次又一次地重复运行。我们可以在代码中使用循环语句来完成这个任务。<br>
在 PHP 中，提供了下列循环语句：<br><br>
while - 只要指定的条件成立，则循环执行代码块<br>
do...while - 首先执行一次代码块，然后在指定的条件成立时重复这个循环<br>
for - 循环执行代码块指定的次数<br>
foreach - 根据数组中每个元素来循环代码块</p>

<?php
$i=1;
while($i<=5)
{
echo "The number is " . $i . "<br>";
$i++;
}
?>
<?php
$i=1;
do
{
$i++;
echo "The number is " . $i . "<br>";
}
while ($i<=5);
?>
<?php
for ($i=1; $i<=5; $i++)
{
echo "The number is " . $i . "<br>";
}
?>
<?php
$x=array("one","two","three");
foreach ($x as $value)
{
echo $value . "<br>";
}
?>

<p>PHP 函数<br>
PHP 的真正威力源自于它的函数。<br>
在 PHP 中，提供了超过 1000 个内建的函数。</p>
<?php
function writeName($fname)
{
echo $fname . " Refsnes.<br>";
}

echo "My name is ";
writeName("Kai Jim");
echo "My sister's name is ";
writeName("Hege");
echo "My brother's name is ";
writeName("Stale");
?>
<p>PHP 函数 - 返回值<br>
如需让函数返回一个值，请使用 return 语句</p>
<?php
function add($x,$y)
{
$total=$x+$y;
return $total;
}

echo "1 + 16 = " . add(1,16);
?>

<p>PHP 魔术变量<br>
PHP 向它运行的任何脚本提供了大量的预定义常量。<br>
不过很多常量都是由不同的扩展库定义的，只有在加载了这些扩展库时才会出现，或者动态加载后，或者在编译时已经包括进去了。<br>
有八个魔术常量它们的值随着它们在代码中的位置改变而改变。<br>
例如 __LINE__ 的值就依赖于它在脚本中所处的行来决定。这些特殊的常量不区分大小写，如下：</p>

<?php
echo '这是第 “ '  . __LINE__ . ' ” 行';
?>
<br>
<?php
echo '该文件位于 “ '  . __FILE__ . ' ” ';
?>
<br>
<?php
function test() {
    echo  '函数名为：' . __FUNCTION__ ;
}
test();
?>
<p>
    __CLASS__<br>
类的名称（PHP 4.3.0 新加）。自 PHP 5 起本常量返回该类被定义时的名字（区分大小写）。<br>
在 PHP 4 中该值总是小写字母的。类名包括其被声明的作用区域（例如 Foo\Bar）。注意自 PHP 5.4 起 __CLASS__ 对 trait 也起作用。当用在 trait 方法中时，__CLASS__ 是调用 trait 方法的类的名字
</p>

<?php
class test {
    function _print() {
        echo '类名为：'  . __CLASS__ . "<br>";
        echo  '函数名为：' . __FUNCTION__ ;
    }
}
$t = new test();
$t->_print();
?>
<p>
    __TRAIT__<br>
Trait 的名字（PHP 5.4.0 新加）。自 PHP 5.4.0 起，PHP 实现了代码复用的一个方法，称为 traits。<br>
Trait 名包括其被声明的作用区域（例如 Foo\Bar）。<br>
从基类继承的成员被插入的 SayWorld Trait 中的 MyHelloWorld 方法所覆盖。其行为 MyHelloWorld 类中定义的方法一致。优先顺序是当前类中的方法会覆盖 trait 方法，而 trait 方法又覆盖了基类中的方法。
</p>
<?php
class Base {
    public function sayHello() {
        echo 'Hello ';
    }
}

// trait SayWorld {
//     public function sayHello() {
//         parent::sayHello();
//         echo 'World!';
//     }
// }

// class MyHelloWorld extends Base {
//     use SayWorld;
// }

// $o = new MyHelloWorld();
// $o->sayHello();

?>
<p>__METHOD__<br>
类的方法名（PHP 5.0.0 新加）。返回该方法被定义时的名字（区分大小写）。<br>
实例:</p>
<?php
function test2() {
    echo  '函数名为：' . __METHOD__ ;
}
test2();
?>


<p>__NAMESPACE__<br />
当前命名空间的名称（区分大小写）。此常量是在编译时定义的（PHP 5.3.0 新增）。<br />
实例:</p>

<?php
// namespace MyProject;

// echo '命名空间为："', __NAMESPACE__, '"'; // 输出 "MyProject"
?>
<p>
    PHP 命名空间(namespace) <br />
PHP 命名空间(namespace)是在PHP 5.3中加入的，如果你学过C#和Java，那命名空间就不算什么新事物。 不过在PHP当中还是有着相当重要的意义。<br />
PHP 命名空间可以解决以下两类问题：<br />
用户编写的代码与PHP内部的类/函数/常量或第三方类/函数/常量之间的名字冲突。<br />
为很长的标识符名称(通常是为了缓解第一类问题而定义的)创建一个别名（或简短）的名称，提高源代码的可读性。
</p>

<?php
// namespace MyProject1;
// // MyProject1 命名空间中的PHP代码

// namespace MyProject2;
// // MyProject2 命名空间中的PHP代码

// // 另一种语法
// namespace MyProject3 {
//  // MyProject3 命名空间中的PHP代码
// }
?>
<p>在声明命名空间之前唯一合法的代码是用于定义源文件编码方式的 declare 语句。所有非 PHP 代码包括空白符都不能出现在命名空间的声明之前。</p>
<?php
// declare(encoding='UTF-8'); //定义多个命名空间和不包含在命名空间中的代码
// namespace MyProject {

// const CONNECT_OK = 1;
// class Connection { /* ... */ }
// function connect() { /* ... */  }
// }

// namespace { // 全局代码
// session_start();
// $a = MyProject\connect();
// echo MyProject\Connection::start();
// }
?>

<h1>PHP 面向对象</h1>
</body>
</html>
