<!DOCTYPE html>
<html>
<head>
	<title>1</title>
	<meta charset="utf-8">
</head>
<body style='margin-bottom: 300px;'>

	<?php 
		$x=5; // 全局变量 
		function myTest() 
		{ 
		    $y=10; // 局部变量 
		    echo "<p>测试函数内变量:<p>"; 
		    echo "变量 x 为: $x"; 
		    echo "<br>"; 
		    echo "变量 y 为: $y"; 
		}  
		myTest(); 
		echo "<p>测试函数外变量:<p>"; 
		echo "变量 x 为: $x"; 
		echo "<br>"; 
		echo "变量 y 为: $y"; 
	?>

<p>在以上实例中 myTest() 函数定义了 $x 和 $y 变量。 $x 变量在函数外声明，所以它是全局变量 ， $y 变量在函数内声明所以它是局部变量。
当我们调用myTest()函数并输出两个变量的值, 函数将会输出局部变量 $y 的值，但是不能输出 $x 的值，因为 $x 变量在函数外定义，无法在函数内使用，如果要在一个函数中访问一个全局变量，需要使用 global 关键字。
然后我们在myTest()函数外输出两个变量的值，函数将会输出全局部变量 $x 的值，但是不能输出 $y 的值，因为 $y 变量在函数中定义</p>
<p style="color:red;">在函数内调用函数外定义的全局变量，我们需要在函数中的变量前加上 global 关键字：</p>
<?php
	$x=5;$y=10;
	function myTest2(){
		$GLOBALS['y']=$GLOBALS['x']+$GLOBALS['y'];
	} 
	myTest2();
	echo $y;
?>
<p>PHP 将所有全局变量存储在一个名为 $GLOBALS[index] 的数组中。 index 保存变量的名称。这个数组可以在函数内部访问，也可以直接用来更新全局变量。</p>
<p>Static 作用域
当一个函数完成时，它的所有变量通常都会被删除。然而，有时候您希望某个局部变量不要被删除。
要做到这一点，请在您第一次声明变量时使用 static 关键字：</p>
<?php

function myTest3()
{
static $x=0;
echo $x;
$x++;
}

myTest3();
myTest3();
myTest3();

?>
<p>echo 和 print 区别:
echo - 可以输出一个或多个字符串
print - 只允许输出一个字符串，返回值总为 1
提示：echo 输出的速度比 print 快， echo 没有返回值，print有返回值1。</p>
<?php
$txt1="Learn PHP";
$txt2="w3cschool.cc";
$cars=array("Volvo","BMW","Toyota");

echo $txt1;
echo "<br>";
echo "Study PHP at $txt2";
echo "My car is a {$cars[0]}";
?>
<br>
<?php
$txt1="Learn PHP";
$txt2="w3cschool.cc";
$cars=array("Volvo","BMW","Toyota");

print $txt1;
print "<br>";
print "Study PHP at $txt2";
print "My car is a {$cars[0]}";
?>
<p>php数据类型</p>
<p>String（字符串）, Integer（整型）, Float（浮点型）, Boolean（布尔型）, Array（数组）, Object（对象）, NULL（空值）。</p>
<?php 
$x = 5985;
var_dump($x);
echo "<br>"; 
$x = -345; // 负数 
var_dump($x);
echo "<br>"; 
$x = 0x8C; // 十六进制数
var_dump($x);
echo "<br>";
$x = 047; // 八进制数
var_dump($x);
?>
<br>
<?php 
$x = 10.365;
var_dump($x);
echo "<br>"; 
$x = 2.4e3;
var_dump($x);
echo "<br>"; 
$x = 8E-5;
var_dump($x);
?>
<br>
<?php 
$cars=array("Volvo","BMW","Toyota");
var_dump($cars);
?>
<p> PHP var_dump() 函数返回变量的数据类型和值：</p>
<p>在 PHP 中，对象必须声明。
首先，你必须使用class关键字声明类对象。类是可以包含属性和方法的结构。
然后我们在类中定义数据类型，然后在实例化的类中使用数据类型：</p>

<?php
class Car
{
  var $color;
  function Car($color="green") {
    $this->color = $color;
  }
  function what_color() {
    return $this->color;
  }
}
?>
<?php
$x="Hello world!";
$x=null;
var_dump($x);
?>
<p>php 常量，常量值被定义后，在脚本的其他任何地方都不能被改变。常量是一个简单值的标识符。该值在脚本中不能改变。
一个常量由英文字母、下划线、和数字组成,但数字不能作为首字母出现。 (常量名不需要加 $ 修饰符)。
注意： 常量在整个脚本中都可以使用。</p>
<p>设置常量，使用 define() 函数，函数语法如下：
bool define ( string $name , mixed $value [, bool $case_insensitive = false ] )
该函数有三个参数:
name：必选参数，常量名称，即标志符。
value：必选参数，常量的值。
case_insensitive ：可选参数，如果设置为 TRUE，该常量则大小写不敏感。默认是大小写敏感的。
以下实例我们创建一个 区分大小写的常量, 常量值为 "欢迎访问 Runoob.com"：</p>
<?php
// 区分大小写的常量名
define("GREETING", "我是一个常量",true );  //true 大小写不敏感
echo GREETING;    // 输出 "欢迎访问 Runoob.com"
echo '<br>';

echo greeting;   // 输出 "greeting"
echo '<br>';
echo GREETING;    // 输出 "欢迎访问 Runoob.com"
?>
<p>常量是全局的
常量在定义后，默认是全局变量，可以在整个运行的脚本的任何地方使用。
以下实例演示了在函数内使用常量，即便常量定义在函数外也可以正常使用常量。</p>

<p>PHP strlen() 函数
有时知道字符串值的长度是很有用的。
strlen() 函数返回字符串的长度（字符数）。
下面的实例返回字符串 "Hello world!" 的长度：</p>
<?php 
echo 'hello word!的长度为:';
echo strlen("Hello world!"); 
?>
<p>PHP strpos() 函数
strpos() 函数用于在字符串内查找一个字符或一段指定的文本。
如果在字符串中找到匹配，该函数会返回第一个匹配的字符位置。如果未找到匹配，则返回 FALSE。
下面的实例在字符串 "Hello world!" 中查找文本 "world"：</p>
<?php 
echo 'world在hello world中的位置';
echo strpos("Hello world!","world"); 
?>
<p>提示：在上面的实例中，字符串 "world" 的位置是 6。之所以是 6 而不是 7 的原因是，字符串中第一个字符的位置是 0，而不是 1</p>
<P>PHP 运算符</P>
<p>++ x	预递增	x 加 1，然后返回 x<br>
x ++	后递增	返回 x，然后 x 加 1<br>
-- x	预递减	x 减 1，然后返回 x<br>
x --	后递减	返回 x，然后 x 减 1</p>
<p>
	x + y	集合	x 和 y 的集合<br>
x == y	相等	如果 x 和 y 具有相同的键/值对，则返回 true<br>
x === y	恒等	如果 x 和 y 具有相同的键/值对，且顺序相同类型相同，则返回 true<br>
x != y	不相等	如果 x 不等于 y，则返回 true<br>
x <> y	不相等	如果 x 不等于 y，则返回 true<br>
x !== y	不恒等	如果 x 不等于 y，则返回 true<br>
</p>
<?php
$test = '菜鸟教程';
// 普通写法
$username = isset($test) ? $test : 'nobody';
echo $username, PHP_EOL;

// PHP 5.3+ 版本写法
$username = $test ?: 'nobody';
echo $username, PHP_EOL;
?>

<?php
// 如果 $_GET['user'] 不存在返回 'nobody'，否则返回 $_GET['user'] 的值 php7
//$username = $_GET['user'] ?? 'nobody';
// 类似的三元运算符
$username = isset($_GET['user']) ? $_GET['user'] : 'nobody';
?>
<?php
// 整型
echo 1 <= 1; // 0
echo 1 <= 2; // -1
echo 2 <= 1; // 1

// 浮点型
echo 1.5 <= 1.5; // 0
echo 1.5 <= 2.5; // -1
echo 2.5 <= 1.5; // 1
 
// 字符串
echo "a" <= "a"; // 0
echo "a" <= "b"; // -1
echo "b" <= "a"; // 1
?>
</body>
</html>