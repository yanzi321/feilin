<?php


namespace App\Models\Event;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\AddSmsTemplateRequest;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\DeleteSmsTemplateRequest;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\ModifySmsTemplateRequest;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\QuerySmsTemplateRequest;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\AddSmsSignRequest;
use Illuminate\Support\Facades\Config as ConfigEnv;

class Esign
{

    /**
     * @param $url
     * @param $data
     * @param $appID
     * @param $appSecret
     * @return mixed
     */
    public function doPost($url, $data, $appID, $stoken)
    {
        list($return_code, $return_content) = $this->http_post_data($url, $data, $appID,$stoken);

        return $return_content;
    }

    /**
     * @param $url
     * @param $data
     * @param $appID
     * @param $appSecret
     * @return array
     */
    public function http_post_data($url, $data, $appID, $stoken) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 跳过检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 跳过检查
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Tsign-Open-App-Id:".$appID, "X-Tsign-Open-Token:".$stoken, "Content-Type:application/json" ));
        ob_start();
        curl_exec($ch);
        $return_content = ob_get_contents();
        ob_end_clean();
        $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return array($return_code, $return_content);
    }

    //get方法

    /**
     * @param $url
     * @param $data
     * @return mixed
     */
    public function doGet($url, $data)
    {
        list($return_code, $return_content) = $this->curl_get_https($url, $data);
        return $return_content;
    }

    public function curl_get_https($url, $data) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 跳过检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 跳过检查
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json" ));
        ob_start();
        curl_exec($ch);
        $return_content = ob_get_contents();
        ob_end_clean();
        $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return array($return_code, $return_content);
    }

//    /**
//     * @param $url
//     * @param $data
//     * @return array
//     */
//    public function curl_get_https($appID,$stoken,$url, $data) {
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $url);
////        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 跳过检查
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 跳过检查
//        //curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json" ));
//
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Tsign-Open-App-Id:".$appID, "X-Tsign-Open-Token:".$stoken, "Content-Type:application/json" ));
//
//
//        ob_start();
//        curl_exec($ch);
//        $return_content = ob_get_contents();
//        ob_end_clean();
//        $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        return array($return_code, $return_content);
//    }

    public function sendHttpPUT($uploadUrls, $contentMd5, $fileContent){
        $header = array(
            'Content-Type:application/pdf',
            'Content-Md5:' . $contentMd5
        );

        $status = '';
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $uploadUrls);
        curl_setopt($curl_handle, CURLOPT_FILETIME, true);
        curl_setopt($curl_handle, CURLOPT_FRESH_CONNECT, false);
        curl_setopt($curl_handle, CURLOPT_HEADER, true); // 输出HTTP头 true
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_TIMEOUT, 5184000);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, 'PUT');

        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $fileContent);
        $result = curl_exec($curl_handle);
        $status = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);

        if ($result === false) {
            $status = curl_errno($curl_handle);
            $result = 'put file to oss - curl error :' . curl_error($curl_handle);
        }
        curl_close($curl_handle);
//    $this->debug($url, $fileContent, $header, $result);
        return $status;
    }


    public function sendHttpPUTCommon($url, $data, $appID, $stoken) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 跳过检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 跳过检查
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Tsign-Open-App-Id:".$appID, "X-Tsign-Open-Token:".$stoken, "Content-Type:application/json" ));
        ob_start();
        curl_exec($ch);
        $return_content = ob_get_contents();
        ob_end_clean();
//        $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return $return_content;
    }

    public function doGetWithToken($url, $data, $appID, $stoken){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 跳过检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 跳过检查
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Tsign-Open-App-Id:".$appID, "X-Tsign-Open-Token:".$stoken, "Content-Type:application/json" ));
        ob_start();
        curl_exec($ch);
        $return_content = ob_get_contents();
        ob_end_clean();
        return $return_content;
    }
    //获取鉴权token
    public function getToken($appId,$secret,$getToken){
        $grantType="client_credentials";
        $arr = array("appId"=>$appId,"secret"=>$secret,"grantType"=>$grantType);
        $data = json_encode($arr);
        $getToken=$getToken."?appId=$appId&secret=$secret&grantType=client_credentials";
        $return_content = $this->doGet($getToken,$data);
        //var_dump("获取鉴权Token：：：".$return_content);
        $result = (array)json_decode($return_content,true);
        $data2 = $result['data'];
        $stokren = $data2['token'];
        echo '获取到的鉴权token：：'.$stokren;
        echo "\n";
        echo '获取鉴权Token----------------结束';
        echo "\n";
        return $stokren;
    }

}
