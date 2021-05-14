ThinkPHP 6.0
===============

> 运行环境要求PHP7.1+，兼容PHP8.0。

[官方应用服务市场](https://market.topthink.com) | [`ThinkAPI`——官方统一API服务](https://docs.topthink.com/think-api)

ThinkPHPV6.0版本由[亿速云](https://www.yisu.com/)独家赞助发布。

## 主要新特性

* 采用`PHP7`强类型（严格模式）
* 支持更多的`PSR`规范
* 原生多应用支持
* 更强大和易用的查询
* 全新的事件系统
* 模型事件和数据库事件统一纳入事件系统
* 模板引擎分离出核心
* 内部功能中间件化
* SESSION/Cookie机制改进
* 对Swoole以及协程支持改进
* 对IDE更加友好
* 统一和精简大量用法

## 安装

在www目录下

~~~
$ composer -vvv create-project topthink/think tp6-learn 6.0.*
~~~

- `-vvv` 表示安装时显示进度

- `tp6-learn` 是你要安装的应用目录

如果需要更新框架使用
~~~
composer update topthink/framework
~~~

## 运行

切换到项目根目录

```
$ cd tp6-learn
```

运行

```
$ php think run
```

指定端口运行

```
$ php think run -p 80
```

## 配置

- 重命名根目录的example.env为.env
  
- nginx配置
  在public目录下新建 nginx.htaccess 并写入：
  ```
  location / {
       if (!-e $request_filename){
          rewrite  ^(.*)$  /index.php?s=$1  last;   break;
       }
    }
  ```
  
- apache配置
  在public目录下新建 .htaccess 并写入：
  ```
  <IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteBase /
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php?/$1 [QSA,PT,L]
  </IfModule>
  ```

- 全局数据表字段缓存
    ```
    执行 php think optimize:schema 命令生成
    database配置中的fields_cache改为true
    ```
  
- 可开启延迟路由解析, 提高解析性能(route.php中url_lazy_route改为true)
  
- 可强制使用路由 route.php中url_route_must改为true
  
- 使用json格式日志 log.php中json改为true

- 自定义异常处理
  在app目录下的ExceptionHandle.php


## 文档

[完全开发手册](https://www.kancloud.cn/manual/thinkphp6_0/content)

## 参与开发

请参阅 [ThinkPHP 核心框架包](https://github.com/top-think/framework)。

## 版权信息

ThinkPHP遵循Apache2开源协议发布，并提供免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2006-2020 by ThinkPHP (http://thinkphp.cn)

All rights reserved。

ThinkPHP® 商标和著作权所有者为上海顶想信息科技有限公司。

更多细节参阅 [LICENSE.txt](LICENSE.txt)
