<?php
namespace app\index\controller;
use think\Request;
class Index
{
    public function index()
    {
        return '';
    }

    public function send(Request $request){
    	// return '发送微信消息';
    	// $name = $request->param('name');
	    $formid = $request->param('formid');
	    $temid = 'kejY-zfeJvm51u8zCQbcUoXZyDv8HONG7Ch0v8n3yu8';
	    $page = 'pages/index/index';
	    $openid = $request->param('openid');
	    // if(!$openid||!$formid)die('failed!');
	    // $key1 = '中奖通知';//发送的消息
	    // $key2 = '123456';
	    // $key3 = '1000元';
	    // $key4 = '3月28日12:00-3月30日12：00';
	    
	    $access_token = $this->returnAssKey();
	    $url = 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token='.$access_token;
	    $data = array(//这里一定要按照微信给的格式
	        "touser"=>$openid,
	        "template_id"=>$temid,
	        "page"=>$page,
	        "form_id"=>$formid,
	        "data"=>array(
	            "keyword1"=>array(
	                "value"=>$request->param('keyword1'),
	                "color"=>"#173177"
	            ),
	            "keyword2"=>array(
	                "value"=>$request->param('keyword2'),
	                "color"=>"#173177"
	            ),
	            "keyword3"=>array(
	                "value"=>$request->param('keyword3'),
	                "color"=>"#173177"
	            ),
	            "keyword4"=>array(
	                "value"=>$request->param('keyword4'),
	                "color"=>"#173177"
	            ),
	            "keyword5"=>array(
	                "value"=>$request->param('keyword5'),
	                "color"=>"#173177"
	            ),
	            "keyword6"=>array(
	                "value"=>$request->param('keyword6'),
	                "color"=>"#173177"
	            ),
	            "keyword7"=>array(
	                "value"=>$request->param('keyword7'),
	                "color"=>"#173177"
	            ),
	            "keyword8"=>array(
	                "value"=>$request->param('keyword8'),
	                "color"=>"#173177"
	            ),
	            "keyword9"=>array(
	                "value"=>$request->param('keyword9'),
	                "color"=>"#173177"
	            ),
	            "keyword10"=>array(
	                "value"=>$request->param('keyword10'),
	                "color"=>"#173177"
	            )
	        ),
	        "emphasis_keyword"=>"keyword1.DATA",//需要进行加大的消息
	    );
	    $res = $this->postCurl($url,$data,'json');//将data数组转换为json数据
	    if($res){
	        return json_encode(array('state'=>4,'msg'=>$res, 'openid' => $openid));
	    }else{
	        return json_encode(array('state'=>5,'msg'=>$res));
	    }
    }

    function returnAsskey()
	{
	    // $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxe4f6da45adc1ec49&secret=6dfc8e68f37ce4f6a6015790618d54da';
	    $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxed5fd5b4b6aa3c82&secret=2c1a7b1888160cfe0b9376cdf399b398';
	    $ass_key = $this->curl_get($url);
	    $a1 = $ass_key->access_token;
	    return $a1;
	}

    
	function postCurl($url,$data,$type)
	{
	    if($type == 'json'){
	        $data = json_encode($data);//对数组进行json编码
	        $header= array("Content-type: application/json;charset=UTF-8","Accept: application/json","Cache-Control: no-cache", "Pragma: no-cache");
	    }
	    $curl = curl_init();
	    curl_setopt($curl,CURLOPT_URL,$url);
	    curl_setopt($curl,CURLOPT_POST,1);
	    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
	    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
	    if(!empty($data)){
	        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
	    }
	    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
	    $res = curl_exec($curl);
	    if(curl_errno($curl)){
	        echo 'Error+'.curl_error($curl);
	    }
	    curl_close($curl);
	    return $res;

	}

	function curl_get($url) {
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    $data = curl_exec($curl);
	    $err = curl_error($curl);
	    curl_close($curl);
	    return json_decode($data);//对数据进行json解码
	}

}
