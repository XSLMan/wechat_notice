<?php
namespace app\access\controller;
use think\Request;
use think\Config;
use app\access\model\record\Record;
use app\access\model\customer\Customer;
class Myrecord extends \think\Controller{
	var $error = array();

    public function add(Request $request){
    	$data = array();
    	$data['status'] = 0;
    	$data['data'] = '';
        Config::load(APP_PATH.'/string.php');
    	if($request->param('message') == '' || $request->param('message') == null){
    		$this->error['1000201'] = config('record_error.1000201');
    	}

    	if($request->param('customer') == '' || $request->param('customer') == null){
    		$this->error['1000202'] = config('record_error.1000202');
    	}

        if($request->param('customer')){
            $customer = Customer::get(['cusId' => $request->param('customer')]);
             if(!$customer){
                $this->error['1000202'] = config('record_error.1000203');
            }

            $record = Record::get(array(
                'customer' => $request->param('customer'),
                'status'   => 1
            ));

            if($record){
                 $this->error['1000204'] = config('record_error.1000204');
            }
        }

    	if(count($this->error) == 0){
           
            $record = new Record();
            $record->createDate = time();
            $record->status = '进行中';
            $record->statusId = 1;
            $record->message = $request->param('message');
            $record->customer = $request->param('customer');
            if($record->save()){
                $data['status'] = 1;
                $data['data'] = $record;
            }
    	}
    	$data['error'] = $this->error;
    	return json_encode($data);
    }
}
