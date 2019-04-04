# YesApi-PHP-SDK
小白接口（YesApi.cn）PHP SDK包。

项目地址：https://github.com/yesapicn/yesapi-php-sdk

## 安装

在Github上下载源代码，引入OkayApiClient.php文件即可使用。

## 使用

使用很简单，只需要传入接口服务名称（指明请求调用哪个接口）、接口参数（不同接口的不同参数），就可以完成对小白接口的调用。

以下简单使用示例，可以参考demo.php文件。

```php
<?php

// 引入文件
require_once dirname(__FILE__) . '/YesApiPHPSDK.php';

// 请求小白接口
$rs = YesApiPHPSDK::request('App.Hello.World', array('name' => 'dogstar'), 3000);

// 输出结果
print_r($rs);
```

上面例程会输出：
```
Array
(
    [ret] => 200
    [data] => Array
    (
        [err_code] => 0
        [err_msg] => 
        [title] => Hi dogstar，欢迎使用小白接口！
    )

    [msg] => 当前小白接口：App.Hello.World
)
```

## 注意

使用前，请修改YesApiPHPSDK.php文件，配置你自己的：接口域名、app_key和app_secrect。

如果不知道自己的小白配置，可前往我的套餐页查看：http://open.yesapi.cn/?r=App/Mine。

