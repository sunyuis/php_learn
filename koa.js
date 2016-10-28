koa 1.0

随着新版Node.js开始支持ES6，Express的团队又基于ES6的generator重新编写了下一代web框架koa。和Express相比，koa 1.0使用generator实现异步，代码看起来像同步的：

var koa = require('koa');
var app = koa();

app.use('/test', function *() {
    yield doReadFile1();
    var data = yield doReadFile2();
    this.body = data;
});

app.listen(3000);


用generator实现异步比回调简单了不少，但是generator的本意并不是异步。Promise才是为异步设计的，但是Promise的写法……想想就复杂。为了简化异步代码，ES7（目前是草案，还没有发布）引入了新的关键字async和await，可以轻松地把一个function变为异步模式：
async function () {
    var data = await fs.read('/file1');
}
这是JavaScript未来标准的异步代码，非常简洁，并且易于使用。


koa2
koa团队并没有止步于koa 1.0，他们非常超前地基于ES7开发了koa2，和koa 1相比，koa2完全使用Promise并配合async来实现异步。
koa2的代码看上去像这样：
app.use(async (ctx, next) => {
    await next();
    var data = await doReadFile();
    ctx.response.type = 'text/plain';
    ctx.response.body = data;
});

出于兼容性考虑，目前koa 2仍支持generator的写法，但下一个版本将会去掉。
























































































































































