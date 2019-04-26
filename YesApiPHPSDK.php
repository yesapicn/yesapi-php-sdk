<?php
/**
 * 小白接口客户端SDK包（PHP版）
 *
 * @author dogstar 20190404
 */

// TODO: 换成你的小白接口域名（可以在我的套餐页查看：http://open.yesapi.cn/?r=App/Mine）
defined('YESAPI_HOST') || define('YESAPI_HOST', 'http://api.yesapi.cn');

// TODO：换成你的app_key
defined('YESAPI_APP_KEY') || define('YESAPI_APP_KEY', '{你的app_key}');

// TODO：换成你的app_secrect
defined('YESAPI_APP_SECRECT') || define('YESAPI_APP_SECRECT', '{你的app_secrect}');

class YesApiPHPSDK {

    /**
     * 发起小白接口请求
     *
     * @param string    $service 小白接口服务名称
     * @param array     $params 请求参数
     * @param int       $timeoutMs 超时时间，单位为毫秒
     * @return array/FALSE
     */
    public static function request($service, $params, $timeoutMs = 3000) {
        $url = rtrim(YESAPI_HOST. '/') . '/?s=' . $service;

        // 生成签名
        unset($params['sign']);
        $params['s'] = $service;
        $params['app_key'] = YESAPI_APP_KEY;
        $params['sign'] = self::encryptAppKey($params, YESAPI_APP_SECRECT);

        $rs = self::doRequest($url, $params, $timeoutMs);
        $rsArr = json_decode($rs, true);

        return $rsArr;
    }

    protected static function doRequest($url, $data, $timeoutMs = 3000)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $timeoutMs);

        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $rs = curl_exec($ch);

        curl_close($ch);

        return $rs;
    }

    protected static function encryptAppKey($params, $appSecrect) {
        ksort($params);

        $paramsStrExceptSign = '';
        foreach ($params as $val) {
            $paramsStrExceptSign .= $val;
        }

        return strtoupper(md5($paramsStrExceptSign . $appSecrect));
    }
}

