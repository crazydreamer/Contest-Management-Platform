### 前言

开发使用的框架是Laravel最新4.2版本，关于Laravel这个框架，了解和学习可以到http://v4.golaravel.com/docs/4.2 查看。
不过首先需要对MVC框架有基本的概念和理解。

Web Server使用的是nginx，不过影响不太大，apache也可以。如果跑在nginx需要配置文件的话，可以单独找我要。

数据库MySQL，我在我的VPS上跑了一个，开发的时候可以使用线上的配置，也可以本地搭一个，速度能快一点。配置下面有。

既然已经看到了这里，说明你已经注册完了github帐号，我们的代码管理就使用它来完成，我使用分布式版本控制软件的经验也不是很多，
这也是我第一次完整的试图多人合作完成开发任务，所以具体的实践需要我们共同探索


###项目总体规划
####第一期（已完成）

实现基本的新闻站功能，包括发布、管理、查看、搜索新闻等功能

首页

1.分类新闻展示，可以根据不同新闻分类拉取对应数量的新闻

2.完成用户（学生，教师）的前端注册页面，添加注册按钮，JQuery完成表单验证（此项可适当推迟完成）


后台

1.暂不需要通过具备权限的帐号发布新闻，管理新闻分类、批量编辑、修改新闻各项属性

只需要几个简单的接口，对新闻分类、新闻正文的CURD

2.考虑一下“竞赛”这个对象所可能涉及到的属性，设计数据库并在后台预留菜单和相关页面


####第二期（deadline 2015-3-8）

参考第一期新闻完成的规划，对竞赛这个对象进行前后台页面和逻辑实现，这样前端页面看起来已经完成度超过50%了。

####第三期

添加权限验证路由，完成角色权限分配，对一二期中已完成的逻辑添加权限验证。基本逻辑实现。

####动态需求

1.整理文件相关操作，储存资料，规划好作品附件的存储，命名，验证、展示等一系列逻辑，选择适当时机加入。

2.随时优化前端页面布局，调整CSS以使页面看起来尽可能和谐。

###数据库

MySQL 106.185.40.8:3306 phpMyAdmin http://db.bydell.com

user:platform_dev password:DEV123

database:platform_dev

###### 数据库的设计目前并不完整，并且结构会伴随开发的进展随时调整，如果在开发时遇到需要调整的地方，请及时告知，并在修改前备份数据库。

* 涉及到时间的统一用timestamp
* 数据库编码使用UTF8-general-ci

### 路由

目前对于路由这一块的考虑暂时不是很成熟，在开发是先对每个需要暴露出来的结构指定单独的路由，最后在项目相对成熟的时候再进行整体路由的设计。
大概在第二期中进行吧。所以目前在开发时需要创建的路由写好注释即可，命名时尽量简短，并用英文，不要使用拼音。

banner   =>   首页|最新公告|竞赛列表|*在线报名|*作品提交|获奖作品|优秀作品|综合查询

（注：标*号为目前具体业务流程尚不明确）

/ 首页

/post 公告

/contest 竞赛列表

/query 全站搜索和综合查询 使用相同的路由，调用不同的查询接口。

/manage 管理后台

### HTML & CSS

前段这一块目前我用的BOOTSTRAP简单的设计了一下结构，对于css样式没有太多的设计经验，所以肯定有使用不科学和不美观的地方。

最致命的一点是目前部分CSS特性没有考虑浏览器兼容，而且页面的流式布局会随着窗口尺寸的变化而面临走形的风险，需要有人来优化这一块。

###模块

这一部分内容很多，还在整理，会在后面及时更新。

###目录结构

关于Laravel框架的目录结构，下面这篇Blog有比较详细的介绍。我们项目中用到的外部文件（css，js，img等）都放在/public/类型名下的目录里。

http://ijiaober.github.io/2014/08/09/laravel/Architecture-of-Laravel/
