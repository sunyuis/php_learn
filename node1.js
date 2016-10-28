

在计算机程序的开发过程中，随着程序代码越写越多，在一个文件里代码就会越来越长，越来越不容易维护。为了编写可维护的代码，我们把很多函数分组，分别放到不同的文件里，这样，每个文件包含的代码就相对较少，很多编程语言都采用这种组织代码的方式。在Node环境中，一个.js文件就称之为一个模块（module）。

最大的好处是大大提高了代码的可维护性。其次，编写代码不必从零开始。当一个模块编写完毕，就可以被其他地方引用。我们在编写程序的时候，也经常引用其他模块，包括Node内置的模块和来自第三方的模块
使用模块还可以避免函数名和变量名冲突。相同名字的函数和变量完全可以分别存在不同的模块中，因此，我们自己在编写模块时，不必考虑名字会与其他模块冲突。


在上一节，我们编写了一个 hello.js文件，这个 hello.js文件就是一个模块，模块的名字就是文件名（去掉.js后缀），所以 hello.js文件就是名为hello的模块。
我们把 hello.js改造一下，创建一个函数，这样我们就可以在其他地方调用这个函数：
'use strict';
var s = 'Hello';
function greet(name) {
    console.log(s + ', ' + name + '!');
}

module.exports = greet;
函数 greet()是我们在hello模块中定义的，你可能注意到最后一行是一个奇怪的赋值语句，它的意思是，把函数 greet 作为模块的输出暴露出去，这样其他模块就可以使用 greet函数了。

问题是其他模块怎么使用hello模块的这个greet函数呢？我们再编写一个 main.js文件，调用hello模块的greet函数：

'use strict';
// 引入hello模块:
var greet = require('./hello');
var s = 'Michael';
greet(s); // Hello, Michael!

注意到引入hello模块用Node提供的require函数：
var greet = require('./hello');

引入的模块作为变量保存在greet变量中，那greet变量到底是什么东西？其实变量 greet 就是在 hello.js中我们用module.exports = greet;输出的greet函数。所以，main.js就成功地引用了hello.js 模块中定义的 greet()函数，接下来就可以直接使用它了。
在使用 require()引入模块的时候，请注意模块的相对路径。因为 main.js和hello.js位于同一个目录，所以我们用了当前目录.：
var greet = require('./hello'); // 不要忘了写相对目录!
如果只写模块名：
var greet = require('hello');
则Node会依次在内置模块、全局模块和当前模块下查找 hello.js，你很可能会得到一个错误：

CommonJS规范
这种模块加载机制被称为CommonJS规范。在这个规范下，每个 .js文件都是一个模块，它们内部各自使用的变量名和函数名都互不冲突，例如，hello.js和main.js都申明了全局变量var s = 'xxx'，但互不影响。 
一个模块想要对外暴露变量（函数也是变量），可以用 module.exports = variable;，一个模块要引用其他模块暴露的变量，用var ref = require('module_name');就拿到了引用模块的变量。


要在模块中对外输出变量，用：
module.exports = variable;
输出的变量可以是任意对象、函数、数组等等。
要引入其他模块输出的对象，用：
var foo = require('other_module');

基本模块
因为 Node.js是运行在服务区端的JavaScript环境，服务器程序和浏览器程序相比，最大的特点是没有浏览器的安全限制了，而且，服务器程序必须能接收网络请求，读写文件，处理二进制内容，所以， Node.js内置的常用模块就是为了实现基本的服务器功能。这些模块在浏览器环境中是无法被执行的，因为它们的底层代码是用C/C++在 Node.js运行环境中实现的
在前面的JavaScript课程中，我们已经知道，JavaScript有且仅有一个全局对象，在浏览器中，叫window对象。而在Node.js环境中，也有唯一的全局对象，但不叫window，而叫global，这个对象的属性和方法也和浏览器环境的window不同

process也是Node.js提供的一个对象，它代表当前 Node.js进程。通过process对象可以拿到许多有用信息：
> process === global.process;
true
> process.version;
'v5.2.0'
> process.platform;
'darwin'
> process.arch;
'x64'
> process.cwd(); //返回当前工作目录
'/Users/michael'
> process.chdir('/private/tmp'); // 切换当前工作目录
undefined
> process.cwd();
'/private/tmp'


Node.js 内置的 fs模块 就是文件系统模块，负责读写文件。
和所有其它JavaScript模块不同的是，fs模块同时提供了异步和同步的方法。
回顾一下什么是异步方法。因为JavaScript的单线程模型，执行IO操作时，JavaScript代码无需等待，而是传入回调函数后，继续执行后续JavaScript代码。比如 jQuery提供的 getJSON()操作：

同步操作的好处是代码简单，缺点是程序将等待IO操作，在等待时间内，无法响应其它任何事件。而异步读取不用等待IO操作，但代码较麻烦。
异步读文件

按照JavaScript的标准，异步读取一个文本文件的代码如下：
'use strict';
var fs = require('fs');
fs.readFile('sample.txt', 'utf-8', function (err, data) {
    if (err) {
        console.log(err);
    } else {
        console.log(data);
    }
});
异步读取时，传入的回调函数接收两个参数，当正常读取时，err参数为null，data参数为读取到的String。当读取发生错误时，err参数代表一个错误对象，data为undefined。这也是 Node.js 标准的回调函数：第一个参数代表错误信息，第二个参数代表结果。后面我们还会经常编写这种回调函数。

如果我们要读取的文件不是文本文件，而是二进制文件，怎么办？
下面的例子演示了如何读取一个图片文件：
'use strict';
var fs = require('fs');
fs.readFile('sample.png', function (err, data) {
    if (err) {
        console.log(err);
    } else {
        console.log(data);
        console.log(data.length + ' bytes');
    }
});
当读取二进制文件时，不传入文件编码时，回调函数的data参数将返回一个Buffer对象。在 Node.js中，Buffer对象就是一个包含零个或任意个字节的数组（注意和Array不同）。
Buffer对象可以和String作转换，例如，把一个Buffer对象转换成String：

// Buffer -> String
var text = data.toString('utf-8');
console.log(text);
或者把一个String转换成Buffer：
// String -> Buffer
var buf = new Buffer(text, 'utf-8');
console.log(buf);

同步读文件
除了标准的异步读取模式外，fs也提供相应的同步读取函数。同步读取的函数和异步函数相比，多了一个Sync后缀，并且不接收回调函数，函数直接返回结果。用fs模块同步读取一个文本文件的代码如下：
'use strict';
var fs = require('fs');
var data = fs.readFileSync('sample.txt', 'utf-8');
console.log(data);


可见，原异步调用的回调函数的data被函数直接返回，函数名需要改为readFileSync，其它参数不变。
如果同步读取文件发生错误，则需要用 try...catch 捕获该错误：
try {
    var data = fs.readFileSync('sample.txt', 'utf-8');
    console.log(data);
} catch (err) {
    // 出错了
}

写文件
将数据写入文件是通过 fs.writeFile() 实现的：
'use strict';
var fs = require('fs');
var data = 'Hello, Node.js';
fs.writeFile('output.txt', data, function (err) {
    if (err) {
        console.log(err);
    } else {
        console.log('ok.');
    }
});

writeFile() 的参数依次为文件名、数据和回调函数。如果传入的数据是 String，默认按 UTF-8 编码写入文本文件，如果传入的参数是 Buffer，则写入的是二进制文件。回调函数由于只关心成功与否，因此只需要一个 err 参数。
和 readFile()类似，writeFile() 也有一个同步方法，叫writeFileSync()： 
'use strict';
var fs = require('fs');
var data = 'Hello, Node.js';
fs.writeFileSync('output.txt', data);

stat
如果我们要获取文件大小，创建时间等信息，可以使用 fs.stat()，它返回一个Stat对象，能告诉我们文件或目录的详细信息：

'use strict';
var fs = require('fs');
fs.stat('sample.txt', function (err, stat) {
    if (err) {
        console.log(err);
    } else {
        // 是否是文件:
        console.log('isFile: ' + stat.isFile());
        // 是否是目录:
        console.log('isDirectory: ' + stat.isDirectory());
        if (stat.isFile()) {
            // 文件大小:
            console.log('size: ' + stat.size);
            // 创建时间, Date对象:
            console.log('birth time: ' + stat.birthtime);
            // 修改时间, Date对象:
            console.log('modified time: ' + stat.mtime);
        }
    }
});
运行结果如下：
isFile: true
isDirectory: false
size: 181
birth time: Fri Dec 11 2015 09:43:41 GMT+0800 (CST)
modified time: Fri Dec 11 2015 12:09:00 GMT+0800 (CST)

stat()也有一个对应的同步函数 statSync()，请试着改写上述异步代码为同步代码。


异步还是同步
在fs模块中，提供同步方法是为了方便使用。那我们到底是应该用异步方法还是同步方法呢？
由于Node环境执行的JavaScript代码是服务器端代码，所以，绝大部分需要在服务器运行期反复执行业务逻辑的代码，必须使用异步代码，否则，同步代码在执行时期，服务器将停止响应，因为JavaScript只有一个执行线程。
服务器启动时如果需要读取配置文件，或者结束时需要写入到状态文件时，可以使用同步代码，因为这些代码只在启动和结束时执行一次，不影响服务器正常运行时的异步执行。

stream
stream是Node.js提供的又一个仅在服务区端 可用的模块，目的是支持“流”这种数据结构。 
什么是流？流是一种抽象的数据结构。想象水流，当在水管中流动时，就可以从某个地方（例如自来水厂）源源不断地到达另一个地方（比如你家的洗手池）。我们也可以把数据看成是数据流，比如你敲键盘的时候，就可以把每个字符依次连起来，看成字符流。这个流是从键盘输入到应用程序，实际上它还对应着一个名字：标准输入流（stdin）。
如果应用程序把字符一个一个输出到显示器上，这也可以看成是一个流，这个流也有名字：标准输出流（stdout）。流的特点是数据是有序的，而且必须依次读取，或者依次写入，不能像Array那样随机定位。
有些流用来读取数据，比如从文件读取数据时，可以打开一个文件流，然后从文件流中不断地读取数据。有些流用来写入数据，比如向文件写入数据时，只需要把数据不断地往文件流中写进去就可以了。

在 Node.js 中，流也是一个对象，我们只需要响应流的事件就可以了：data事件表示流的数据已经可以读取了，end事件表示这个流已经到末尾了，没有数据可以读取了，error事件表示出错了。

下面是一个从文件流读取文本内容的示例：
'use strict';
var fs = require('fs');
// 打开一个流:
var rs = fs.createReadStream('sample.txt', 'utf-8');
rs.on('data', function (chunk) {
    console.log('DATA:')
    console.log(chunk);
});
rs.on('end', function () {
    console.log('END');
});
rs.on('error', function (err) {
    console.log('ERROR: ' + err);
})

要注意，data事件可能会有多次，每次传递的chunk是流的一部分数据。
要以流的形式写入文件，只需要不断调用 write()方法，最后以 end()结束：
'use strict';
var fs = require('fs');

var ws1 = fs.createWriteStream('output1.txt', 'utf-8');
ws1.write('使用Stream写入文本数据...\n');
ws1.write('END.');
ws1.end();

var ws2 = fs.createWriteStream('output2.txt');
ws2.write(new Buffer('使用Stream写入二进制数据...\n', 'utf-8'));
ws2.write(new Buffer('END.', 'utf-8'));
ws2.end();
所有可以读取数据的流都继承自 stream.Readable，所有可以写入的流都继承自 stream.Writable。


pipe

就像可以把两个水管串成一个更长的水管一样，两个流也可以串起来。一个Readable流和一个Writable流串起来后，所有的数据自动从Readable流进入Writable流，这种操作叫pipe。
在 Node.js中，Readable 流有一个 pipe()方法，就是用来干这件事的。
让我们用 pipe()把一个文件流和另一个文件流串起来，这样源文件的所有数据就自动写入到目标文件里了，所以，这实际上是一个复制文件的程序：

'use strict';
var fs = require('fs');
var rs = fs.createReadStream('sample.txt');
var ws = fs.createWriteStream('copied.txt');

rs.pipe(ws);
默认情况下，当Readable流的数据读取完毕，end事件触发后，将自动关闭Writable流。如果我们不希望自动关闭Writable流，需要传入参数：
readable.pipe(writable, { end: false });


Node.js开发的目的就是为了用JavaScript编写Web服务器程序。因为JavaScript实际上已经统治了浏览器端的脚本，其优势就是有世界上数量最多的前端开发人员。如果已经掌握了JavaScript前端开发，再学习一下如何将JavaScript应用在后端开发，就是名副其实的全栈了。

HTTP服务器
要开发HTTP服务器程序，从头处理TCP连接，解析HTTP是不现实的。这些工作实际上已经由 Node.js 自带的 http 模块完成了。应用程序并不直接和HTTP协议打交道，而是操作http模块提供的request和response对象。
request对象封装了HTTP请求，我们调用request对象的属性和方法就可以拿到所有HTTP请求的信息；
response对象封装了HTTP响应，我们操作response对象的方法，就可以把HTTP响应返回给浏览器。

用 Node.js实现一个HTTP服务器程序非常简单。我们来实现一个最简单的 Web 程序 hello.js，它对于所有请求，都返回Hello world!：
'use strict';

// 导入http模块:
var http = require('http');
// 创建http server，并传入回调函数:
var server = http.createServer(function (request, response) {
    // 回调函数接收request和response对象,
    // 获得HTTP请求的method和url:
    console.log(request.method + ': ' + request.url);
    // 将HTTP响应200写入response, 同时设置Content-Type: text/html:
    response.writeHead(200, {'Content-Type': 'text/html'});
    // 将HTTP响应的HTML内容写入response:
    response.end('<h1>Hello world!</h1>');
});

// 让服务器监听8080端口:
server.listen(8080);

console.log('Server is running at http://127.0.0.1:8080/');


文件服务器
让我们继续扩展一下上面的Web程序。我们可以设定一个目录，然后让Web程序变成一个文件服务器。要实现这一点，我们只需要解析 request.url 中的路径，然后在本地找到对应的文件，把文件内容发送出去就可以了

解析URL需要用到 Node.js提供的 url 模块，它使用起来非常简单，通过 parse()将一个字符串解析为一个Url对象：
'use strict';

var url = require('url');
console.log(url.parse('http://user:pass@host.com:8080/path/to/file?query=string#hash'));

结果如下：
Url {
  protocol: 'http:',
  slashes: true,
  auth: 'user:pass',
  host: 'host.com:8080',
  port: '8080',
  hostname: 'host.com',
  hash: '#hash',
  search: '?query=string',
  query: 'query=string',
  pathname: '/path/to/file',
  path: '/path/to/file?query=string',
  href: 'http://user:pass@host.com:8080/path/to/file?query=string#hash' }

处理本地文件目录需要使用 Node.js提供的path模块，它可以方便地构造目录：
'use strict';
var path = require('path');
// 解析当前目录:
var workDir = path.resolve('.'); // '/Users/michael'
// 组合完整的文件路径:当前目录+'pub'+'index.html':
var filePath = path.join(workDir, 'pub', 'index.html');
// '/Users/michael/pub/index.html'

最后，我们实现一个文件服务器 file_server.js：

'use strict';
var
    fs = require('fs'),
    url = require('url'),
    path = require('path'),
    http = require('http');

// 从命令行参数获取root目录，默认是当前目录:
var root = path.resolve(process.argv[2] || '.');

console.log('Static root dir: ' + root);

// 创建服务器:
var server = http.createServer(function (request, response) {
    // 获得URL的path，类似 '/css/bootstrap.css':
    var pathname = url.parse(request.url).pathname;
    // 获得对应的本地文件路径，类似 '/srv/www/css/bootstrap.css':
    var filepath = path.join(root, pathname);
    // 获取文件状态:
    fs.stat(filepath, function (err, stats) {
        if (!err && stats.isFile()) {
            // 没有出错并且文件存在:
            console.log('200 ' + request.url);
            // 发送200响应:
            response.writeHead(200);
            // 将文件流导向response:
            fs.createReadStream(filepath).pipe(response);
        } else {
            // 出错了或者文件不存在:
            console.log('404 ' + request.url);
            // 发送404响应:
            response.writeHead(404);
            response.end('404 Not Found');
        }
    });
});

server.listen(8080);

console.log('Server is running at http://127.0.0.1:8080/');
没有必要手动读取文件内容。由于response对象本身是一个Writable Stream，直接用pipe()方法就实现了自动读取文件内容并输出到HTTP响应。

crypto
crypto模块的目的是为了提供通用的加密和哈希算法。用纯JavaScript代码实现这些功能不是不可能，但速度会非常慢。Nodejs用C/C++实现这些算法后，通过cypto这个模块暴露为JavaScript接口，这样用起来方便，运行速度也快。

MD5和SHA1
MD5是一种常用的哈希算法，用于给任意数据一个“签名”。这个签名通常用一个十六进制的字符串表示：
const crypto = require('crypto');
const hash = crypto.createHash('md5');
// 可任意多次调用update():
hash.update('Hello, world!');
hash.update('Hello, nodejs!');

console.log(hash.digest('hex')); // 7e1977739c748beac0c0fd14fd26a544

update()方法默认字符串编码为 UTF-8，也可以传入 Buffer。
如果要计算SHA1，只需要把'md5'改成'sha1'，就可以得到SHA1的结果1f32b9c9932c02227819a4151feed43e131aca40。
还可以使用更安全的sha256和sha512。

Hmac
Hmac算法也是一种哈希算法，它可以利用MD5或SHA1等哈希算法。不同的是，Hmac还需要一个密钥：
const crypto = require('crypto');
const hmac = crypto.createHmac('sha256', 'secret-key');
hmac.update('Hello, world!');
hmac.update('Hello, nodejs!');
console.log(hmac.digest('hex')); // 80f7e22570...
只要密钥发生了变化，那么同样的输入数据也会得到不同的签名，因此，可以把Hmac理解为用随机数“增强”的哈希算法。

AES
AES是一种常用的对称加密算法，加解密都用同一个密钥。crypto模块提供了AES支持，但是需要自己封装好函数，便于使用：
const crypto = require('crypto');
function aesEncrypt(data, key) {
    const cipher = crypto.createCipher('aes192', key);
    var crypted = cipher.update(data, 'utf8', 'hex');
    crypted += cipher.final('hex');
    return crypted;
}

function aesDecrypt(encrypted, key) {
    const decipher = crypto.createDecipher('aes192', key);
    var decrypted = decipher.update(encrypted, 'hex', 'utf8');
    decrypted += decipher.final('utf8');
    return decrypted;
}

var data = 'Hello, this is a secret message!';
var key = 'Password!';
var encrypted = aesEncrypt(data, key);
var decrypted = aesDecrypt(encrypted, key);
console.log('Plain text: ' + data);
console.log('Encrypted text: ' + encrypted);
console.log('Decrypted text: ' + decrypted);

运行结果如下：
Plain text: Hello, this is a secret message!
Encrypted text: 8a944d97bdabc157a5b7a40cb180e7...
Decrypted text: Hello, this is a secret message!
可以看出，加密后的字符串通过解密又得到了原始内容。

注意到AES有很多不同的算法，如aes192，aes-128-ecb，aes-256-cbc等，AES除了密钥外还可以指定IV（Initial Vector），不同的系统只要IV不同，用相同的密钥加密相同的数据得到的加密结果也是不同的。加密结果通常有两种表示方法：hex和base64，这些功能Nodejs全部都支持，但是在应用中要注意，如果加解密双方一方用Nodejs，另一方用Java、PHP等其它语言，需要仔细测试。如果无法正确解密，要确认双方是否遵循同样的AES算法，字符串密钥和IV是否相同，加密后的数据是否统一为hex或base64格式。

Diffie-Hellman
DH算法是一种密钥交换协议，它可以让双方在不泄漏密钥的情况下协商出一个密钥来。DH算法基于数学原理，比如小明和小红想要协商一个密钥，可以这么做：
小明先选一个素数和一个底数，例如，素数p=23，底数g=5（底数可以任选），再选择一个秘密整数a=6，计算A=g^a mod p=8，然后大声告诉小红：p=23，g=5，A=8；
小红收到小明发来的p，g，A后，也选一个秘密整数b=15，然后计算B=g^b mod p=19，并大声告诉小明：B=19；
小明自己计算出s=B^a mod p=2，小红也自己计算出s=A^b mod p=2，因此，最终协商的密钥s为2。
在这个过程中，密钥2并不是小明告诉小红的，也不是小红告诉小明的，而是双方协商计算出来的。第三方只能知道p=23，g=5，A=8，B=19，由于不知道双方选的秘密整数a=6和b=15，因此无法计算出密钥2。


用crypto模块实现DH算法如下：
const crypto = require('crypto');
// xiaoming's keys:
var ming = crypto.createDiffieHellman(512);
var ming_keys = ming.generateKeys();
var prime = ming.getPrime();
var generator = ming.getGenerator();
console.log('Prime: ' + prime.toString('hex'));
console.log('Generator: ' + generator.toString('hex'));
// xiaohong's keys:
var hong = crypto.createDiffieHellman(prime, generator);
var hong_keys = hong.generateKeys();
// exchange and generate secret:
var ming_secret = ming.computeSecret(hong_keys);
var hong_secret = hong.computeSecret(ming_keys);
// print secret:
console.log('Secret of Xiao Ming: ' + ming_secret.toString('hex'));
console.log('Secret of Xiao Hong: ' + hong_secret.toString('hex'));
运行后，可以得到如下输出：
$ node dh.js 
Prime: a8224c...deead3
Generator: 02
Secret of Xiao Ming: 695308...d519be
Secret of Xiao Hong: 695308...d519be
注意每次输出都不一样，因为素数的选择是随机的。

证书
crypto模块也可以处理数字证书。数字证书通常用在SSL连接，也就是Web的https连接。一般情况下，https连接只需要处理服务器端的单向认证，如无特殊需求（例如自己作为Root给客户发认证证书），建议用反向代理服务器如Nginx等Web服务器去处理证书。






























