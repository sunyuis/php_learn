Jquery

总之jQuery的选择器不会返回undefined或者null，这样的好处是你不必在下一行判断 if (div === undefined)。
jQuery对象和DOM对象之间可以互相转化：
var div = $('#abc'); // jQuery对象
var divDom = div.get(0); // 假设存在div，获取第1个DOM元素
var another = $(divDom); // 重新把DOM包装为jQuery对象

通常很多节点有多个class，我们可以查找同时包含red和green的节点：
var a = $('.red.green'); // 注意没有空格！
// 符合条件的节点：
// <div class="red green">...</div>
// <div class="blue green red">...</div>
一个DOM节点除了id和class外还可以有很多属性，很多时候按属性查找会非常方便，比如在一个表单中按属性来查找：
var email = $('[name=email]'); // 找出<??? name="email">
var passwordInput = $('[type=password]'); // 找出<??? type="password">
var a = $('[items="A B"]'); // 找出<??? items="A B">
当属性的值包含空格等特殊字符时，需要用双引号括起来。
按属性查找还可以使用前缀查找或者后缀查找
var icons = $('[class^="icon-"]'); // 找出所有class包含至少一个以`icon-`开头的DOM
// 例如: class="icon-clock", class="abc icon-home"
组合查找就是把上述简单选择器组合起来使用。如果我们查找$('[name=email]')，很可能把表单外的<div name="email">也找出来，但我们只希望查找<input>，就可以这么写：
var emailInput = $('input[name=email]'); // 不会找出<div name="email">
同样的，根据tag和class来组合查找也很常见：
var tr = $('tr.red'); // 找出<tr class="red ...">...</tr>
多项选择器就是把多个选择器用,组合起来一块选：
要注意的是，选出来的元素是按照它们在HTML中出现的顺序排列的，而且不会有重复元素。例如，<p class="red green">不会被上面的$('p.red,p.green')选择两次。

过滤器（Filter）
过滤器一般不单独使用，它通常附加在选择器上，帮助我们更精确地定位元素。观察过滤器的效果：
$('ul.lang li'); // 选出JavaScript、Python和Lua 3个节点
$('ul.lang li:first-child'); // 仅选出JavaScript
$('ul.lang li:last-child'); // 仅选出Lua
$('ul.lang li:nth-child(2)'); // 选出第N个元素，N从1开始
$('ul.lang li:nth-child(even)'); // 选出序号为偶数的元素
$('ul.lang li:nth-child(odd)'); // 选出序号为奇数的元素

表单相关
针对表单元素，jQuery还有一组特殊的选择器：
:input：可以选择<input>，<textarea>，<select>和<button>；
:file：可以选择<input type="file">，和input[type=file]一样；
:checkbox：可以选择复选框，和input[type=checkbox]一样；
:radio：可以选择单选框，和input[type=radio]一样；
:focus：可以选择当前输入焦点的元素，例如把光标放到一个<input>上，用$('input:focus')就可以选出；
:checked：选择当前勾上的单选框和复选框，用这个选择器可以立刻获得用户选择的项目，如$('input[type=radio]:checked')；
:enabled：可以选择可以正常输入的<input>、<select>
等，也就是没有灰掉的输入；
:disabled：和:enabled正好相反，选择那些不能输入的。
此外，jQuery还有很多有用的选择器，例如，选出可见的或隐藏的元素：
$('div:visible'); // 所有可见的div
$('div:hidden'); // 所有隐藏的div

过滤
和函数式编程的map、filter类似，jQuery对象也有类似的方法。
filter()方法可以过滤掉不符合选择器条件的节点：
var langs = $('ul.lang li'); // 拿到JavaScript, Python, Swift, Scheme和Haskell
var a = langs.filter('.dy'); // 拿到JavaScript, Python, Scheme

map()方法把一个jQuery对象包含的若干DOM节点转化为其他对象：
var langs = $('ul.lang li'); // 拿到JavaScript, Python, Swift, Scheme和Haskell
var arr = langs.map(function () {
    return this.innerHTML;
}).get(); // 用get()拿到包含string的Array：['JavaScript', 'Python', 'Swift', 'Scheme', 'Haskell']

此外，一个jQuery对象如果包含了不止一个DOM节点，first()、last()和slice()方法可以返回一个新的jQuery对象，把不需要的DOM节点去掉：
var langs = $('ul.lang li'); // 拿到JavaScript, Python, Swift, Scheme和Haskell
var js = langs.first(); // JavaScript，相当于$('ul.lang li:first-child')
var haskell = langs.last(); // Haskell, 相当于$('ul.lang li:last-child')
var sub = langs.slice(2, 4); // Swift, Scheme, 参数和数组的slice()方法一
// 浏览器可视窗口大小:
$(window).width(); // 800
$(window).height(); // 600

// HTML文档大小:
$(document).width(); // 800
$(document).height(); // 3500

// 某个div的大小:
var div = $('#test-div');
div.width(); // 600
div.height(); // 300
div.width(400); // 设置CSS属性 width: 400px，是否生效要看CSS是否有效
div.height('200px'); // 设置CSS属性 height: 200px，是否生效要看CSS是否有效

键盘事件
键盘事件仅作用在当前焦点的DOM上，通常是<input>和<textarea>。
keydown：键盘按下时触发；
keyup：键盘松开时触发；
keypress：按一次键后触发。
focus：当DOM获得焦点时触发；
blur：当DOM失去焦点时触发；
change：当<input>、<select>或<textarea>的内容改变时触发；
submit：当<form>提交时触发；
ready：当页面被载入并且DOM树完成初始化后触发。

取消绑定

一个已被绑定的事件可以解除绑定，通过off('click', function)实现：
function hello() {
    alert('hello!');
}
a.click(hello); // 绑定事件
// 10秒钟后解除绑定:
setTimeout(function () {
    a.off('click', hello);
}, 10000);


事件参数
有些事件，如mousemove和keypress，我们需要获取鼠标位置和按键的值，否则监听这些事件就没什么意义了。所有事件都会传入Event对象作为参数，可以从Event对象上获取到更多的信息：
$(function () {
    $('#testMouseMoveDiv').mousemove(function (e) {
        $('#testMouseMoveSpan').text('pageX = ' + e.pageX + ', pageY = ' + e.pageY);
    });
});

取消绑定

一个已被绑定的事件可以解除绑定，通过off('click', function) 实现：

function hello() {
    alert('hello!');
}

a.click(hello); // 绑定事件

// 10秒钟后解除绑定:
setTimeout(function () {
    a.off('click', hello);
}, 10000);

这是因为两个匿名函数虽然长得一模一样，但是它们是两个不同的函数对象，off('click', function () {...})无法移除已绑定的第一个匿名函数。
为了实现移除效果，可以使用off('click')一次性移除已绑定的click事件的所有处理函数。
同理，无参数调用off()一次性移除已绑定的所有类型的事件处理函数


当用户在文本框中输入时，就会触发change事件。但是，如果用JavaScript代码去改动文本框的值，将不会触发change事件：
var input = $('#test-input');
input.val('change it!'); // 无法触发change事件

input.change()相当于input.trigger('change')，它是trigger()方法的简写

var button1 = $('#testPopupButton1');
var button2 = $('#testPopupButton2');
function popupTestWindow() {
    window.open('/');
}
button1.click(function () {
    popupTestWindow();
});
button2.click(function () {
    // 不立刻执行popupTestWindow()，100毫秒后执行:
    setTimeout(popupTestWindow, 100);
});
当用户点击button1时，click事件被触发，由于popupTestWindow()在click事件处理函数内执行，这是浏览器允许的，而button2的click事件并未立刻执行popupTestWindow()，延迟执行的popupTestWindow()将被浏览器拦截
var div = $('#test-animate');
div.animate({
    opacity: 0.25,
    width: '256px',
    height: '256px'
}, 3000); // 在3秒钟内CSS过渡到设定值

jQuery的动画效果还可以串行执行，通过delay()方法还可以实现暂停，这样，我们可以实现更复杂的动画效果，而代码却相当简单：

你可能会遇到，有的动画如slideUp()根本没有效果。这是因为jQuery动画的原理是逐渐改变CSS的值，如height从100px逐渐变为0。但是很多不是block性质的DOM元素，对它们设置height根本就不起作用，所以动画也就没有效果

用JavaScript写AJAX前面已经介绍过了，主要问题就是不同浏览器需要写不同代码，并且状态和错误处理写起来很麻烦。
用jQuery的相关对象来处理AJAX，不但不需要考虑浏览器问题，代码也能大大简化。

ajax
jQuery在全局对象jQuery（也就是$）绑定了ajax()函数，可以处理AJAX请求。ajax(url, settings)函数需要接收一个URL和一个可选的settings对象，常用的选项如下：
async：是否异步执行AJAX请求，默认为true，千万不要指定为false；
method：发送的Method，缺省为'GET'，可指定为'POST'、'PUT'等；
contentType：发送POST请求的格式，默认值为'application/x-www-form-urlencoded; charset=UTF-8'，也可以指定为text/plain、application/json；
data：发送的数据，可以是字符串、数组或object。如果是GET请求，data将被转换成query附加到URL上，如果是POST请求，根据contentType把data序列化成合适的格式；
headers：发送的额外的HTTP头，必须是一个object；
dataType：接收的数据格式，可以指定为'html'、'xml'、'json'、'text'等，缺省情况下根据响应的Content-Type猜测。

var jqxhr = $.ajax('/api/categories', {
    dataType: 'json'
}).done(function (data) {
    ajaxLog('成功, 收到的数据: ' + JSON.stringify(data));
}).fail(function (xhr, status) {
    ajaxLog('失败: ' + xhr.status + ', 原因: ' + status);
}).always(function () {
    ajaxLog('请求完成: 无论成功或失败都会调用');
});
对常用的AJAX操作，jQuery提供了一些辅助方法。由于GET请求最常见，所以jQuery提供了get()方法，可以这么写：
var jqxhr = $.get('/path/to/resource', {
    name: 'Bob Lee',
    check: 1
});

post
post()和get()类似，但是传入的第二个参数默认被序列化为application/x-www-form-urlencoded：
var jqxhr = $.post('/path/to/resource', {
    name: 'Bob Lee',
    check: 1
});

getJSON
由于JSON用得越来越普遍，所以jQuery也提供了getJSON()方法来快速通过GET获取一个JSON对象：
var jqxhr = $.getJSON('/path/to/resource', {
    name: 'Bob Lee',
    check: 1
}).done(function (data) {
    // data已经被解析为JSON对象了
});

jQuery的AJAX完全封装的是JavaScript的AJAX操作，所以它的安全限制和前面讲的用JavaScript写AJAX完全一样。
如果需要使用JSONP，可以在ajax()中设置jsonp: 'callback'，让jQuery实现JSONP跨域加载数据。


答案是肯定的。我们可以扩展jQuery来实现自定义方法。将来如果要修改高亮的逻辑，只需修改一处扩展代码。这种方式也称为编写jQuery插件。
$.fn.highlight1 = function () {
    // this已绑定为当前jQuery对象:
    this.css('backgroundColor', '#fffceb').css('color', '#d85030');
    return this;
}

注意到函数内部的this在调用时被绑定为jQuery对象，所以函数内部代码可以正常调用所有jQuery对象的方法。

细心的童鞋可能发现了，为什么最后要return this;？因为jQuery对象支持链式操作，我们自己写的扩展方法也要能继续链式下去：
$('span.hl').highlight1().slideDown();


紧接着用户对 highlight2()提出了意见：每次调用都需要传入自定义的设置，能不能让我自己设定一个缺省值，以后的调用统一使用无参数的 highlight2()？
也就是说，我们设定的默认值应该能允许用户修改。
那默认值放哪比较合适？放全局变量肯定不合适，最佳地点是 $.fn.highlight2 这个函数对象本身。
于是最终版的highlight()终于诞生了：

$.fn.highlight = function (options) {
    // 合并默认值和用户设定值:
    var opts = $.extend({}, $.fn.highlight.defaults, options);
    this.css('backgroundColor', opts.backgroundColor).css('color', opts.color);
    return this;
}
// 设定默认值:
$.fn.highlight.defaults = {
    color: '#d85030',
    backgroundColor: '#fff8de'
}


最终，我们得出编写一个jQuery插件的原则：
给$.fn绑定函数，实现插件的代码逻辑；
插件函数最后要return this;以支持链式调用；
插件函数要有默认值，绑定在 $.fn.<pluginName>.defaults上；
用户在调用时可传入设定值以便覆盖默认值。

针对特定元素的扩展
我们知道jQuery对象的有些方法只能作用在特定DOM元素上，比如 submit() 方法只能针对form。如果我们编写的扩展只能针对某些类型的DOM元素，应该怎么写？
还记得jQuery的选择器支持 filter()方法来过滤吗？我们可以借助这个方法来实现针对特定元素的扩展。

$('#main a').external();
然后按照上面的方法编写一个external扩展：
$.fn.external = function () {
    // return返回的each()返回结果，支持链式调用:
    return this.filter('a').each(function () {
        // 注意: each()内部的回调函数的this绑定为DOM本身!
        var a = $(this);
        var url = a.attr('href');
        if (url && (url.indexOf('http://')===0 || url.indexOf('https://')===0)) {
            a.attr('href', '#0')
             .removeAttr('target')
             .append(' <i class="uk-icon-external-link"></i>')
             .click(function () {
                if(confirm('你确定要前往' + url + '？')) {
                    window.open(url);
                }
            });
        }
    });
}


正如jQuery统一了不同浏览器之间的DOM操作的差异，让我们可以简单地对DOM进行操作，underscore则提供了一套完善的函数式编程的接口，让我们更方便地在JavaScript中实现函数式编程。
jQuery在加载时，会把自身绑定到唯一的全局变量$上，underscore与其类似，会把自身绑定到唯一的全局变量_上，这也是为啥它的名字叫underscore的原因

map/filter
和Array的map()与filter()类似，但是underscore的map()和filter()可以作用于Object。当作用于Object时，传入的函数为function (value, key)，第一个参数接收value，第二个参数接收key：























































































