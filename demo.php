<?php
// 使用前，请修改YesApiPHPSDK.php文件，配置你自己的：接口域名、app_key和app_secrect

// 引入文件
require_once dirname(__FILE__) . '/YesApiPHPSDK.php';

// 请求小白接口
$rs = YesApiPHPSDK::request('App.Hello.World', array('name' => 'dogstar'), 3000);

// 输出结果
print_r($rs);
