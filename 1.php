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
<p>
函数  描述<br>
addcslashes()   返回在指定的字符前添加反斜杠的字符串。<br>
addslashes()    返回在预定义的字符前添加反斜杠的字符串。<br>
bin2hex()   把 ASCII 字符的字符串转换为十六进制值。<br>
chop()  移除字符串右侧的空白字符或其他字符。<br>
chr()   从指定 ASCII 值返回字符。<br>
chunk_split()   把字符串分割为一连串更小的部分。<br>
convert_cyr_string()    把字符串由一种 Cyrillic 字符集转换成另一种。<br>
convert_uudecode()  对 uuencode 编码的字符串进行解码。<br>
convert_uuencode()  使用 uuencode 算法对字符串进行编码。<br>
count_chars()   返回字符串所用字符的信息。<br>
crc32() 计算一个字符串的 32 位 CRC（循环冗余校验）。<br>
crypt() 单向的字符串加密法（hashing）。<br>
echo()  输出一个或多个字符串。<br>
explode()   把字符串打散为数组。<br>
fprintf()   把格式化的字符串写入到指定的输出流。<br>
get_html_translation_table()    返回 htmlspecialchars() 和 htmlentities() 使用的翻译表。<br>
hebrev()    把希伯来（Hebrew）文本转换为可见文本。<br>
hebrevc()   把希伯来（Hebrew）文本转换为可见文本，并把新行（\n）转换为 <br>。<br>
hex2bin()   把十六进制值的字符串转换为 ASCII 字符。<br>
html_entity_decode()    把 HTML 实体转换为字符。<br>
htmlentities()  把字符转换为 HTML 实体。<br>
htmlspecialchars_decode()   把一些预定义的 HTML 实体转换为字符。<br>
htmlspecialchars()  把一些预定义的字符转换为 HTML 实体。<br>
implode()   返回一个由数组元素组合成的字符串。<br>
join()  implode() 的别名。<br>
lcfirst()   把字符串中的首字符转换为小写。<br>
levenshtein()   返回两个字符串之间的 Levenshtein 距离。<br>
localeconv()    返回本地数字及货币格式信息。<br>
ltrim() 移除字符串左侧的空白字符或其他字符。<br>
md5()   计算字符串的 MD5 散列。<br>
md5_file()  计算文件的 MD5 散列。<br>
metaphone() 计算字符串的 metaphone 键。<br>
money_format()  返回格式化为货币字符串的字符串。<br>
nl_langinfo()   返回指定的本地信息。<br>
nl2br() 在字符串中的每个新行之前插入 HTML 换行符。<br>
number_format() 通过千位分组来格式化数字。<br>
ord()   返回字符串中第一个字符的 ASCII 值。<br>
parse_str() 把查询字符串解析到变量中。<br>
print() 输出一个或多个字符串。<br>
printf()    输出格式化的字符串。<br>
quoted_printable_decode()   把 quoted-printable 字符串转换为 8 位字符串。<br>
quoted_printable_encode()   把 8 位字符串转换为 quoted-printable 字符串。<br>
quotemeta() 引用元字符。<br>
rtrim() 移除字符串右侧的空白字符或其他字符。<br>
setlocale() 设置地区信息（地域信息）。<br>
sha1()  计算字符串的 SHA-1 散列。<br>
sha1_file() 计算文件的 SHA-1 散列。<br>
similar_text()  计算两个字符串的相似度。<br>
soundex()   计算字符串的 soundex 键。<br>
sprintf()   把格式化的字符串写入一个变量中。<br>
sscanf()    根据指定的格式解析来自一个字符串的输入。<br>
str_getcsv()    把 CSV 字符串解析到数组中。<br>
str_ireplace()  替换字符串中的一些字符（大小写不敏感）。<br>
str_pad()   把字符串填充为新的长度。<br>
str_repeat()    把字符串重复指定的次数。<br>
str_replace()   替换字符串中的一些字符（大小写敏感）。<br>
str_rot13() 对字符串执行 ROT13 编码。<br>
str_shuffle()   随机地打乱字符串中的所有字符。<br>
str_split() 把字符串分割到数组中。<br>
str_word_count()    计算字符串中的单词数。<br>
strcasecmp()    比较两个字符串（大小写不敏感）。<br>
strchr()    查找字符串在另一字符串中的第一次出现。（strstr() 的别名。）<br>
strcmp()    比较两个字符串（大小写敏感）。<br>
strcoll()   比较两个字符串（根据本地设置）。<br>
strcspn()   返回在找到任何指定的字符之前，在字符串查找的字符数。<br>
strip_tags()    剥去字符串中的 HTML 和 PHP 标签。<br>
stripcslashes() 删除由 addcslashes() 函数添加的反斜杠。<br>
stripslashes()  删除由 addslashes() 函数添加的反斜杠。<br>
stripos()   返回字符串在另一字符串中第一次出现的位置（大小写不敏感）。<br>
stristr()   查找字符串在另一字符串中第一次出现的位置（大小写不敏感）。<br>
strlen()    返回字符串的长度。<br>
strnatcasecmp() 使用一种"自然排序"算法来比较两个字符串（大小写不敏感）。<br>
strnatcmp() 使用一种"自然排序"算法来比较两个字符串（大小写敏感）。<br>
strncasecmp()   前 n 个字符的字符串比较（大小写不敏感）。<br>
strncmp()   前 n 个字符的字符串比较（大小写敏感）。<br>
strpbrk()   在字符串中搜索指定字符中的任意一个。<br>
strpos()    返回字符串在另一字符串中第一次出现的位置（大小写敏感）。<br>
strrchr()   查找字符串在另一个字符串中最后一次出现。<br>
strrev()    反转字符串。<br>
strripos()  查找字符串在另一字符串中最后一次出现的位置(大小写不敏感)。<br>
strrpos()   查找字符串在另一字符串中最后一次出现的位置(大小写敏感)。<br>
strspn()    返回在字符串中包含的特定字符的数目。<br>
strstr()    查找字符串在另一字符串中的第一次出现（大小写敏感）。<br>
strtok()    把字符串分割为更小的字符串。<br>
strtolower()    把字符串转换为小写字母。<br>
strtoupper()    把字符串转换为大写字母。<br>
strtr() 转换字符串中特定的字符。<br>
substr()    返回字符串的一部分。<br>
substr_compare()    从指定的开始位置（二进制安全和选择性区分大小写）比较两个字符串。<br>
substr_count()  计算子串在字符串中出现的次数。<br>
substr_replace()    把字符串的一部分替换为另一个字符串。<br>
trim()  移除字符串两侧的空白字符和其他字符。<br>
ucfirst()   把字符串中的首字符转换为大写。<br>
ucwords()   把字符串中每个单词的首字符转换为大写。<br>
vfprintf()  把格式化的字符串写到指定的输出流。<br>
vprintf()   输出格式化的字符串。<br>
vsprintf()  把格式化字符串写入变量中。v
wordwrap()  按照指定长度对字符串进行折行处理。</p>
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
<p>PHP Switch 语句
switch 语句用于根据多个不同条件执行不同动作。</p>

<?php
$favcolor="red";
switch ($favcolor)
{
case "red":
    echo "你喜欢的颜色是红色!";
    break;
case "blue":
    echo "你喜欢的颜色是蓝色!";
    break;
case "green":
    echo "你喜欢的颜色是绿色!";
    break;
default:
    echo "你喜欢的颜色不是 红, 蓝, 或绿色!";
}
?>
<p>PHP 数组
数组能够在单个变量中存储多个值：</p>
<?php
$cars=array("Volvo","BMW","Toyota");
echo "I like " . $cars[0] . ", " . $cars[1] . " and " . $cars[2] . ".";
?>
<p>在 PHP 中创建数组<br>
在 PHP 中，array() 函数用于创建数组：<br>
array();<br>
在 PHP 中，有三种类型的数组：<br>
数值数组 - 带有数字 ID 键的数组<br>
关联数组 - 带有指定的键的数组，每个键关联一个值<br>
多维数组 - 包含一个或多个数组的数组</p>
<p>获取数组的长度 - count() 函数
count() 函数用于返回数组的长度（元素的数量）：</p>
<?php
$cars=array("Volvo","BMW","Toyota");
echo count($cars);
?>
<p>遍历数值数组
遍历并打印数值数组中的所有值，您可以使用 for 循环，如下所示：</p>
<?php
$cars=array("Volvo","BMW","Toyota");
$arrlength=count($cars);

for($x=0;$x<$arrlength;$x++)
{
echo $cars[$x];
echo "<br>";
}
?>
<p>PHP 关联数组<br>
关联数组是使用您分配给数组的指定的键的数组。<br>
这里有两种创建关联数组的方法：<br>
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");<br>
or:<br>
$age['Peter']="35";<br>
$age['Ben']="37";<br>
$age['Joe']="43";<br>
随后可以在脚本中使用指定的键：</p>
<?php
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
echo "Peter is " . $age['Peter'] . " years old.";
?>
<p>遍历关联数组
遍历并打印关联数组中的所有值，您可以使用 foreach 循环，如下所示：</p>
<?php
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");

foreach($age as $key=>$value)
{
echo "Key=" . $key . ", Value=" . $value;
echo "<br>";
}
?>
<p>PHP 数组排序<br>
数组中的元素可以按字母或数字顺序进行降序或升序排列。<br>
PHP - 数组排序函数<br>
在本章中，我们将一一介绍下列 PHP 数组排序函数：<br>
sort() - 对数组进行升序排列<br>
rsort() - 对数组进行降序排列<br>
asort() - 根据关联数组的值，对数组进行升序排列<br>
ksort() - 根据关联数组的键，对数组进行升序排列<br>
arsort() - 根据关联数组的值，对数组进行降序排列<br>
krsort() - 根据关联数组的键，对数组进行降序排列</p>
<p>sort() - 对数组进行升序排列
下面的实例将 $cars 数组中的元素按照字母升序排列：</p>
<?php
$cars=array("Volvo","BMW","Toyota");
sort($cars);
?>
<p>下面的实例将 $numbers 数组中的元素按照数字升序排列：</p>
<?php
$numbers=array(4,6,2,22,11);
sort($numbers);
?>
<p>rsort() - 对数组进行降序排列</p>
<?php
$cars=array("Volvo","BMW","Toyota");
rsort($cars);
?>
<p>下面的实例将 $numbers 数组中的元素按照数字降序排列：</p>
<?php
$numbers=array(4,6,2,22,11);
rsort($numbers);
?>
<p>asort() - 根据数组的值，对数组进行升序排列
下面的实例根据数组的值，对关联数组进行升序排列：</p>
<?php
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
asort($age);
?>
<p>ksort() - 根据数组的键，对数组进行升序排列</p>
<?php
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
ksort($age);
?>
<p>arsort() - 根据数组的值，对数组进行降序排列</p>
<?php
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
arsort($age);
?>
<p>krsort() - 根据数组的键，对数组进行降序排列</p>
<?php
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
krsort($age);
?>
<p>array()  创建数组。<br>
array_change_key_case() 返回其键均为大写或小写的数组。<br>
array_chunk()   把一个数组分割为新的数组块。<br>
array_column()  返回输入数组中某个单一列的值。<br>
array_combine() 通过合并两个数组（一个为键名数组，一个为键值数组）来创建一个新数组。<br>
array_count_values()    用于统计数组中所有值出现的次数。<br>
array_diff()    比较数组，返回两个数组的差集（只比较键值）。<br>
array_diff_assoc()  比较数组，返回两个数组的差集（比较键名和键值）。<br>
array_diff_key()    比较数组，返回两个数组的差集（只比较键名）。<br>
array_diff_uassoc() 比较数组，返回两个数组的差集（比较键名和键值，使用用户自定义的键名比较函数）。<br>
array_diff_ukey()   比较数组，返回两个数组的差集（只比较键名，使用用户自定义的键名比较函数）。<br>
array_fill()    用给定的键值填充数组。<br>
array_fill_keys()   用给定的指定键名的键值填充数组。<br>
array_filter()  用回调函数过滤数组中的元素。<br>
array_flip()    反转/交换数组中的键名和对应关联的键值。<br>
array_intersect()   比较数组，返回两个数组的交集（只比较键值）。<br>
array_intersect_assoc() 比较数组，返回两个数组的交集（比较键名和键值）。<br>
array_intersect_key()   比较数组，返回两个数组的交集（只比较键名）。<br>
array_intersect_uassoc()    比较数组，返回两个数组的交集（比较键名和键值，使用用户自定义的键名比较函数）。<br>
array_intersect_ukey()  比较数组，返回两个数组的交集（只比较键名，使用用户自定义的键名比较函数）。<br>
array_key_exists()  检查指定的键名是否存在于数组中。<br>
array_keys()    返回数组中所有的键名。<br>
array_map() 将用户自定义函数作用到给定数组的每个值上，返回新的值。<br>
array_merge()   把一个或多个数组合并为一个数组。<br>
array_merge_recursive() 递归地把一个或多个数组合并为一个数组。<br>
array_multisort()   对多个数组或多维数组进行排序。<br>
array_pad() 将指定数量的带有指定值的元素插入到数组中。<br>
array_pop() 删除数组中的最后一个元素（出栈）。<br>
array_product() 计算数组中所有值的乘积。<br>
array_push()    将一个或多个元素插入数组的末尾（入栈）。<br>
array_rand()    从数组中随机选出一个或多个元素，返回键名。<br>
array_reduce()  通过使用用户自定义函数，迭代地将数组简化为一个字符串，并返回。<br>
array_replace() 使用后面数组的值替换第一个数组的值。<br>
array_replace_recursive()   递归地使用后面数组的值替换第一个数组的值。<br>
array_reverse() 将原数组中的元素顺序翻转，创建新的数组并返回。<br>
array_search()  在数组中搜索给定的值，如果成功则返回相应的键名。<br>
array_shift()   删除数组中的第一个元素，并返回被删除元素的值。<br>
array_slice()   返回数组中的选定部分。<br>
array_splice()  把数组中的指定元素去掉并用其它值取代。<br>
array_sum() 返回数组中所有值的和。<br>
array_udiff()   比较数组，返回两个数组的差集（只比较键值，使用一个用户自定义的键名比较函数）。<br>
array_udiff_assoc() 比较数组，返回两个数组的差集（比较键名和键值，使用内建函数比较键名，使用用户自定义函数比较键值）。<br>
array_udiff_uassoc()    比较数组，返回两个数组的差集（比较键名和键值，使用两个用户自定义的键名比较函数）。<br>
array_uintersect()  比较数组，返回两个数组的交集（只比较键值，使用一个用户自定义的键名比较函数）。<br>
array_uintersect_assoc()    比较数组，返回两个数组的交集（比较键名和键值，使用内建函数比较键名，使用用户自定义函数比较键值）。<br>
array_uintersect_uassoc()   比较数组，返回两个数组的交集（比较键名和键值，使用两个用户自定义的键名比较函数）。<br>
array_unique()  删除数组中重复的值。<br>
array_unshift() 在数组开头插入一个或多个元素。<br>
array_values()  返回数组中所有的值。<br>
array_walk()    对数组中的每个成员应用用户函数。<br>
array_walk_recursive()  对数组中的每个成员递归地应用用户函数。<br>
arsort()    对关联数组按照键值进行降序排序。<br>
asort() 对关联数组按照键值进行升序排序。<br>
compact()   创建一个包含变量名和它们的值的数组。<br>
count() 返回数组中元素的数目。<br>
current()   返回数组中的当前元素。<br>
each()  返回数组中当前的键／值对。<br>
end()   将数组的内部指针指向最后一个元素。<br>
extract()   从数组中将变量导入到当前的符号表。<br>
in_array()  检查数组中是否存在指定的值。<br>
key()   从关联数组中取得键名。<br>
krsort()    对关联数组按照键名降序排序。<br>
ksort() 对关联数组按照键名升序排序。<br>
list()  把数组中的值赋给一些数组变量。<br>
natcasesort()   用"自然排序"算法对数组进行不区分大小写字母的排序。<br>
natsort()   用"自然排序"算法对数组排序。<br>
next()  将数组中的内部指针向后移动一位。<br>
pos()   current() 的别名。<br>
prev()  将数组的内部指针倒回一位。<br>
range() 创建一个包含指定范围的元素的数组。<br>
reset() 将数组的内部指针指向第一个元素。<br>
rsort() 对数值数组进行降序排序。<br>
shuffle()   把数组中的元素按随机顺序重新排列。<br>
sizeof()    count() 的别名。<br>
sort()  对数值数组进行升序排序。<br>
uasort()    使用用户自定义的比较函数对数组中的键值进行排序。<br>
uksort()    使用用户自定义的比较函数对数组中的键名进行排序。<br>
usort() 使用用户自定义的比较函数对数组进行排序。</p>
</body>
</html>
