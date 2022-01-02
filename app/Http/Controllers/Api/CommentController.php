<?php


namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;

class CommentController extends RestController
{
    public function __construct(Request $request)
    {
        parent::__construct('Comment');
        $this->__request = $request;
        $this->__apiResource = 'Comment';
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
                    'user_id' => ['required',"exists:users,id,deleted_at,NULL"],
                    'film_id' => ['required','exists:films,id,deleted_at,NULL'],
                    'comment' => ['required'],
                ]);

                break;
            case 'PUT':
                $validator = \Validator::make($this->__request->all(), [
                    'user_id' => ['required',"exists:users,id,deleted_at,NULL"],
                    'film_id' => ['required','exists:films,id,deleted_at,NULL'],
                    'comment' => ['required'],
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