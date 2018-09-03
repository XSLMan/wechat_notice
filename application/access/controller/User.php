<?php
namespace app\access\controller;
use think\Request;
use think\Config;
use app\access\model\customer\Customer;
class User
{
	var $error = array();

    public function index(){
        return '646874676';
    }

    public function add(Request $request){
    	$data = array();
    	$data['status'] = 0;
    	$data['data'] = '';
        Config::load(APP_PATH.'/string.php');
    	// if($request->param('wxId') == '' || $request->param('wxId') == null){
    	// 	$this->error['1000101'] = config('user_error.1000101');
    	// }
    	if($request->param('wxName') == '' || $request->param('wxName') == null){
    		$this->error['1000102'] = config('user_error.1000102');
    	}
    	if($request->param('wxOpenId') == '' || $request->param('wxOpenId') == null){
    		$this->error['1000103'] = config('user_error.1000103');
    	}
    	if($request->param('wxPhone') == '' || $request->param('wxPhone') == null){
    		$this->error['1000104'] = config('user_error.1000104');
    	}
    	if(count($this->error) == 0){
            $customer = Customer::get(['wxOpenId' => $request->param('wxOpenId')]);
            if($customer){
                if($request->param('wxId') != '' && $request->param('wxId') != null){
                    $customer->wxId = $request->param('wxId');
                }
                $customer->wxName = $request->param('wxName');
                $customer->wxOpenId = $request->param('wxOpenId');
                $customer->wxPhone = $request->param('wxPhone');
                $customer->loginDate = time();
            }else{
                $customer = new Customer();
                if($request->param('wxId') != '' && $request->param('wxId') != null){
                    $customer->wxId = $request->param('wxId');
                }
                $customer->wxId = $request->param('wxId');
                $customer->wxName = $request->param('wxName');
                $customer->wxOpenId = $request->param('wxOpenId');
                $customer->wxPhone = $request->param('wxPhone');
                $customer->loginDate = time();
            }
            $result = $customer->save();
            if($result){
                $data['status'] = 1;
                $data['data'] = $customer;
            }else{
                $data['1000105'] = config('user_error.1000105');
            }
    	}
    	$data['error'] = $this->error;
    	return json_encode($data);
    }

    public function getCustomer(Request $request){
        $data = array();
        $data['status'] = 0;
        Config::load(APP_PATH.'/string.php');
        // $data['data'] = $request->param();
        if($request->param('openId') == '' || $request->param('openId') == null){
            $this->error['1000103'] = config('user_error.1000103');
        }
        if(count($this->error) == 0){
            $customer = Customer::get(['wxOpenId' => $request->param('openId')]);
            if($customer){
                $data['status'] = 1;
                $data['data'] = $customer;
            }else{
                $this->error['1000106'] = config('user_error.1000106');
            }
        }
        $data['error'] = $this->error;
        return json_encode($data);
    }
}
