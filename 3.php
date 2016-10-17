<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>面向对象</title>
</head>
<body>
    <p>面向对象内容<br />
类 − 定义了一件事物的抽象特点。类的定义包含了数据的形式以及对数据的操作。<br />
对象 − 是类的实例。<br />
成员变量 − 定义在类内部的变量。该变量的值对外是不可见的，但是可以通过成员函数访问，在类被实例化为对象后，该变量即可称为对象的属性。<br />
成员函数 − 定义在类的内部，可用于访问对象的数据。<br />
继承 − 继承性是子类自动共享父类数据结构和方法的机制，这是类之间的一种关系。在定义和实现一个类的时候，可以在一个已经存在的类的基础之上来进行，把这个已经存在的类所定义的内容作为自己的内容，并加入若干新的内容。<br />
父类 − 一个类被其他类继承，可将该类称为父类，或基类，或超类。<br />
子类 − 一个类继承其他类称为子类，也可称为派生类。<br />
多态 − 多态性是指相同的操作或函数、过程可作用于多种类型的对象上并获得不同的结果。不同的对象，收到同一消息可以产生不同的结果，这种现象称为多态性。<br />
重载 − 简单说，就是函数或者方法有同样的名称，但是参数列表不相同的情形，这样的同名不同参数的函数或者方法之间，互相称之为重载函数或者方法。<br />
抽象性 − 抽象性是指将具有一致的数据结构（属性）和行为（操作）的对象抽象成类。一个类就是这样一种抽象，它反映了与应用有关的重要性质，而忽略其他一些无关内容。任何类的划分都是主观的，但必须与具体的应用有关。<br />
封装 − 封装是指将现实世界中存在的某个客体的属性与行为绑定在一起，并放置在一个逻辑单元内。<br />
构造函数 − 主要用来在创建对象时初始化对象， 即为对象成员变量赋初始值，总与new运算符一起使用在创建对象的语句中。<br />
析构函数 − 析构函数(destructor) 与构造函数相反，当对象结束其生命周期时（例如对象所在的函数已调用完毕），系统自动执行析构函数。析构函数往往用来做"清理善后" 的工作（例如在建立对象时用new开辟了一片内存空间，应在退出前在析构函数中用delete释放）。<br />
下图中我们通过 Car 类 创建了三个对象：Mercedes, Bmw, 和 Audi。</p>
<?php
class myClass {
  var $var1;
  var $var2 = "constant string";
  function myfunc ($arg1, $arg2) {
     return $arg1 + $arg2 ;
  }
}
?>
<p>类使用 class 关键字后加上类名定义。<br />
类名后的一对大括号({})内可以定义变量和方法。<br />
类的变量使用 var 来声明, 变量也可以初始化值。<br />
函数定义类似 PHP 函数的定义，但函数只能通过该类及其实例化的对象访问。</p>

<?php
class Site {
  /* 成员变量 */
  var $url;
  var $title;
  
  /* 成员函数 */
  function setUrl($par){
     $this->url = $par;
  }
  
  function getUrl(){
     echo $this->url . PHP_EOL;
  }
  
  function setTitle($par){
     $this->title = $par;
  }
  
  function getTitle(){
     echo $this->title . PHP_EOL;
  }
}
?>
<p>变量 $this 代表自身的对象。
PHP_EOL 为换行符</p>


</body>
</html>