<?php


namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;

class FilmController extends RestController
{
    public function __construct(Request $request)
    {
        //$this->middleware('custom_auth:api')->only(["store",'update',"delete"]);
        parent::__construct('Film');
        $this->__request = $request;
        $this->__apiResource = 'Film';
    }

    /**
     * This function is used for validate restfull request
     * @param $action
     * @param string $id
     * @return array
     */
    public function validation($action, $id = 0)
    {
        $validator = [];
        switch ($action) {
            case 'POST':
                $validator = \Validator::make($this->__request->all(), [
                    'name' => 'required',
                    'description' => 'required',
                    'release_date' => 'required|date',
                    'rating' => 'required|in:1,2,3,4,5',
                    'cover_image' => 'required|mimes:jpeg,png,jpg',
                    'country' => 'required|string',
                    'genre_ids' => 'required|array',
                    'genre_ids.*' => 'required|exists:genres,id,deleted_at,NULL',
                ]);
                break;
            case 'PUT':
                $validator = Validator::make($this->__request->all(), [
                    'name' => 'required',
                    'description' => 'required',
                    'release_date' => 'required|date',
                    'rating' => 'required|in:1,2,3,4,5',
                    'cover_image' => 'required|mimes:jpeg,png,jpg',
                    'country' => 'required|string',
                    'genre_ids' => 'required|array',
                    'genre_ids.*' => 'required|exists:genres,id,deleted_at,NULL',
                ]);
                break;
        }
        return $validator;
    }

    /**
     * @param $request
     */
    public function beforeIndexLoadModel($request)
    {

    }

    /**
     * @param $request
     */
    public function beforeStoreLoadModel($request)
    {

    }

    /**
     * @param $request
     */
    public function beforeShowLoadModel($request, $id)
    {

    }

    /**
     * @param $request
     */
    public function beforeUpdateLoadModel($request, $id)
    {

    }

    /**
     * @param $request
     */
    public function beforeDestroyLoadModel($request, $id)
    {

    }
}