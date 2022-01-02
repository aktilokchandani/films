<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected
        $__admin_dir_path = 'admin',
        $__is_paginate    = true, // to control pagination object
        $__is_collection  = true, // for item detail response
        $__is_error       = false, // for item detail response
        $__collection     = true,// to control general response
        $__apiResource;

    protected function __validateRequestParams($input_params, $param_rules, $custom_message = [])
    {
        $this->__params = $input_params;
        $validator = \Validator::make($input_params, $param_rules, $custom_message);

        $errors = [];

        if($validator->fails()){
            foreach ($param_rules as $field => $value){
                $message = $validator->errors()->first($field);
                if(!empty($message)) {
                    $errors[$field] = $message;
                }
            }
            $this->__is_error = true;

            return $this->__sendError( __('app.validation_error'), $errors);
        }
    }

    /**
     * @param $data
     * @param $response_code
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function __sendResponse($data, $response_code, $message)
    {
        $paginate    = $this->_paginate($data);
        $apiResource = "\App\Http\Resources\\$this->__apiResource";

        if( $this->__collection ){
            if( !$this->__is_collection ){
                $response_data = new $apiResource($data);
            }else{
                $response_data = $apiResource::collection($data);
            }
        }else{
            $response_data = $this->__is_paginate ? $data->items() : $data;
        }

        $response = [
            'code'       => $response_code,
            'data'       => $response_data,
            'message'    => $message,
            'pagination' => $paginate,
        ];

        return response()->json($response, $response_code);
    }

    /**
     * @param $data
     * @return array
     */
    private function _paginate($obj_model)
    {
        if(!$this->__is_paginate){
            $response['links'] = [
                "first" => null,
                "last" => null,
                "prev" =>  null,
                "next" =>  null
            ];

            $response['meta'] = [
                "current_page" =>  1,
                "from" =>  1,
                "last_page" =>  0,
                "to" =>  0,
                "total" =>  is_object($obj_model) ? 1 : count($obj_model)
            ];

            return $response;
        }

        $response['links'] = [
            "first" => $obj_model->url($obj_model->firstItem()),
            "last" => $obj_model->url($obj_model->lastPage()),
            "prev" =>  $obj_model->previousPageUrl(),
            "next" =>  $obj_model->nextPageUrl()
        ];

        $response['meta'] = [
            "current_page" =>  $obj_model->currentPage(),
            "from" =>  $obj_model->firstItem(),
            "last_page" =>  $obj_model->lastPage(),
            "to" =>  $obj_model->lastItem(),
            "total" =>  $obj_model->total()
        ];

        return $response;

    }

    /**
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function __sendError($error, $errorMessages = [], $code = 400)
    {
        $response = [
            'code'    => $code,
            'message' => $error,
            'data'    => $errorMessages
        ];

        return response()->json($response, $code);
    }
}
