<?php

namespace App\Models;

trait CRUDGenerator
{
    private $_request;

    /**
     * This function is used for save record
     *
     * @param  {array} $data
     * @param  {object} $request
     * @return Response
     */
    public function createRecord($request, $data = [])
    {
        $this->_request = $request;
        if (!empty($data)) {
            //before create record request hook
            if (method_exists($this->loadHook(), 'hook_before_add'))
                $this->loadHook()->hook_before_add($request, $data);
            //filter column
            $data = $this->fill($data);
            //create record
            $record = self::create($data->toArray());
            //after create record request hook
            if (method_exists($this->loadHook(), 'hook_after_add'))
                $this->loadHook()->hook_after_add($request, $record);
            //set response
            return $this->getRecordById($request, $record->id);
        }
    }

    /**
     * This function is used for get record
     *
     * @param {object} $request
     * @param {array} $filterParams (optional)
     * @return Response
     */
    public function getRecords($request)
    {
        $this->_request = $request;
        $query = self::select();
        if (method_exists($this->loadHook(), 'hook_query_index'))
            $this->loadHook()->hook_query_index($query, $request);

        $limit = $request->input('limit', config('constants.PAGINATION_LIMIT'));
        $data = $query->orderBy($request->input('sort_column', $this->table . '.' . $this->primaryKey), $request->input('sort_order', 'desc'))->paginate($limit);
        return $data;
    }

    /**
     * This function is used for get record by id
     *
     * @param {object} $request
     * @param  {sting} $id
     * @return Response
     */
    public function getRecordById($request, $id)
    {
        $this->_request = $request;
        $query = self::select();
        if (method_exists($this->loadHook(), 'hook_query_index'))
            $this->loadHook()->hook_query_index($query, $request, $id);

        $data = $query->where($this->table . '.id', $id)->first();
        return $data;
    }

    /**
     * This function is used for update record
     *
     * @param {object} $request
     * @param {id} $id
     * @param {array} $data
     * @return Response
     */
    public function updateRecord($request, $id, $data = [])
    {
        $this->_request = $request;
        if (!empty($data)) {
            //before update record request hook
            if (method_exists($this->loadHook(), 'hook_before_edit'))
                $this->loadHook()->hook_before_edit($request, $id, $data);
            //filter column
            $data = $this->fill($data);
            //update record
            self::where('id', $id)->update($data->toArray());
            //after create record request hook
            if (method_exists($this->loadHook(), 'hook_after_edit'))
                $this->loadHook()->hook_after_edit($request, $id);
            //set response
            return $this->getRecordById($request, $id);
        }
        return $data;
    }

    /**
     * This function is used for delete record
     *
     * @param  {int} $id
     * @return Response
     */
    public function deleteRecord($request, $id)
    {
        $this->_request = $request;
        if (!is_array($id))
            $id = [$id];
        //before request hook
        if (method_exists($this->loadHook(), 'hook_before_delete'))
            $this->loadHook()->hook_before_delete($request, $id);
        //get record
        $records = self::whereIn('id', $id)->get();
        //delete record
        self::whereIn('id', $id)->delete();
        //after request hook
        if (method_exists($this->loadHook(), 'hook_after_delete'))
            $this->loadHook()->hook_after_delete($request, $records);

        return true;
    }

    public function dataTableRecords($request)
    {
        $this->_request = $request;
        $query = self::select('*');
        if (method_exists($this->loadHook(), 'hook_query_index'))
            $this->loadHook()->hook_query_index($query, $request);

        $data['total_record'] = count($query->get());
        $query = $query->take($request['length'])->skip($request['start'])->orderBy('id', 'desc');
        $query = $query->get();
        $data['records'] = $query;
        return $data;
    }

    /**
     *  This function is used load hook
     * @return class instance
     */
    public function loadHook()
    {
        $className = explode('\\', get_class($this));
        $className = end($className) . 'Hook';
        if ($this->_request->is('api/*'))
            $hook = '\App\Models\Hooks\Api\\' . $className;
        else
            $hook = '\App\Models\Hooks\Admin\\' . $className;
        return new $hook($this);
    }
}
