<?php
namespace app\access\controller;
use think\Request;
use think\Config;
use app\access\model\record\Record;
use app\access\model\record\RecordOption;
use app\access\model\customer\Customer;
class Myrecord extends \think\Controller{
	var $error = array();

    public function add(Request $request){
    	$data = array();
    	$data['status'] = 0;
    	$data['data'] = '';
        Config::load(APP_PATH.'/string.php');
    	if($request->param('message') == '' || $request->param('message') == null){
    		$this->error['1000301'] = config('record_error.1000301');
    	}

    	if($request->param('customer') == '' || $request->param('customer') == null){
    		$this->error['1000302'] = config('record_error.1000302');
    	}

        if($request->param('customer')){
            $cusId = $request->param('customer');

            $customer = Customer::get(['cusId' => $request->param('customer')]);
             if(!$customer){
                $this->error['1000303'] = config('record_error.1000303');
            }

            $record = Record::get(['customer' => $request->param('customer'), 'statusId' => 1]);
            if($record){
                 $this->error['1000304'] = config('record_error.1000304');
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
                $option = new RecordOption();
                $option->recordId =  $record->recordId;
                $option->message = $request->param('message');
                $option->createDate = $record->createDate;
                $option->operator = $request->param('customer');
                $option->save();
                $data['status'] = 1;
                $data['data'] = $record;
            }else{
                
            }
    	}
    	$data['error'] = $this->error;
    	return json_encode($data);
    }
}
