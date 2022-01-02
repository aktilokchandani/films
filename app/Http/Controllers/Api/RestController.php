<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class RestController extends Controller
{
    protected $__model,
        $__request,
        $__success_listing_message,
        $__success_store_message,
        $__success_show_message,
        $__success_update_message,
        $__success_delete_message;

    function __construct($model)
    {
        $this->__model = $model;
        $this->__success_listing_message = __('app.success_listing_message');
        $this->__success_store_message   = __('app.success_store_message');
        $this->__success_show_message    = __('app.success_show_message');
        $this->__success_update_message  = __('app.success_update_message');
        $this->__success_delete_message  = __('app.success_delete_message');
    }

    /**
     * This function is used for get listing
     * @return {json} response
     */
    public function index()
    {
        //validation hook
        if(method_exists($this,'validation')){
            $validator = $this->validation('INDEX');
            if (!empty($validator) && $validator->fails()) {
                foreach($validator->errors()->getMessages() as $key => $value){
                    $error_messages[$key] = $value[0];
                }
                return $this->__sendError(__('app.validation_msg'),$error_messages,400);
            }
        }
        //before load modal hook
        if(method_exists($this,'beforeIndexLoadModel')){
            $response = $this->beforeIndexLoadModel($this->__request);
            if(  $this->__is_error ){
                return $response;
            }
        }
        $record = $this->loadModel()->getRecords($this->__request);
        return $this->__sendResponse($record,200,$this->__success_listing_message);
    }

    /**
     * This function is used for create record
     * @return {json} response
     */
    public function store()
    {
        //validation hook
        if(method_exists($this,'validation')){
            $validator = $this->validation('POST');

            if (!empty($validator) && $validator->fails()) {
                foreach($validator->errors()->getMessages() as $key => $value){
                    $error_messages[$key] = $value[0];
                }
                return $this->__sendError(__('app.validation_msg'),$error_messages,400);
            }
        }
        //before load modal hook
        if(method_exists($this,'beforeStoreLoadModel')){
            $response = $this->beforeStoreLoadModel($this->__request);
            if(  $this->__is_error ){
                return $response;
            }
        }
        $data    = $this->__request->all();
        $record  = $this->loadModel()->createRecord($this->__request,$data);
        $this->__is_paginate   = false;
        $this->__is_collection = false;
        return $this->__sendResponse($record,200,$this->__success_store_message);
    }

    /**
     * This function is used for get record by id
     * @param {id} $id
     * @return {json} response
     */
    public function show($id)
    {
        //validation hook
        if(method_exists($this,'validation')){
            $validator = $this->validation('SHOW',$id);
            if (!empty($validator) && $validator->fails()) {
                foreach($validator->errors()->getMessages() as $key => $value){
                    $error_messages[$key] = $value[0];
                }
                return $this->__sendError(__('app.validation_msg'),$error_messages,400);
            }
        }
        //before load modal hook
        if(method_exists($this,'beforeShowLoadModel')){
            $response = $this->beforeShowLoadModel($this->__request,$id);
            if(  $this->__is_error ){
                return $response;
            }
        }
        $record = $this->loadModel()->getRecordById($this->__request,$id);
        $this->__is_paginate   = false;
        $this->__is_collection = false;
        return $this->__sendResponse($record,200,$this->__success_show_message);
    }

    /**
     * This function is used for update record by id
     * @param {string} $id
     * @return {json} response
     */
    public function update($id)
    {
        if(method_exists($this,'validation')){
            $validator = $this->validation('PUT',$id);
            if (!empty($validator) && $validator->fails()) {
                foreach($validator->errors()->getMessages() as $key => $value){
                    $error_messages[$key] = $value[0];
                }
                return $this->__sendError(__('app.validation_msg'),$error_messages,400);
            }
        }
        //before load modal hook
        if(method_exists($this,'beforeUpdateLoadModel')){
            $response = $this->beforeUpdateLoadModel($this->__request,$id);
            if(  $this->__is_error ){
                return $response;
            }
        }
        $data    = $this->__request->all();
        $record  = $this->loadModel()->updateRecord($this->__request,$id,$data);
        $this->__is_paginate   = false;
        $this->__is_collection = false;
        return $this->__sendResponse($record,200,$this->__success_update_message);
    }

    /**
     * This function is used for delete record by id
     * @param {int} $id
     * @return {json} response
     */
    public function destroy($id)
    {
        if(method_exists($this,'validation')){
            $validator = $this->validation('DELETE',$id);
            if (!empty($validator) && $validator->fails()) {
                foreach($validator->errors()->getMessages() as $key => $value){
                    $error_messages[$key] = $value[0];
                }
                return $this->__sendError(__('app.validation_msg'),$error_messages,400);
            }
        }
        //before load modal hook
        if(method_exists($this,'beforeDestroyLoadModel')){
            $response = $this->beforeDestroyLoadModel($this->__request,$id);
            if(  $this->__is_error ){
                return $response;
            }
        }
        $this->loadModel()->deleteRecord($this->__request,$id);
        //init response
        $this->__is_paginate = false;
        $this->__collection  = false;
        return $this->__sendResponse([],200,$this->__success_delete_message);
    }

    /**
     * This function is user for load model
     * return object
     */
    public function loadModel()
    {
        $model = '\App\Models\\' . $this->__model;
        return new $model;
    }
}
