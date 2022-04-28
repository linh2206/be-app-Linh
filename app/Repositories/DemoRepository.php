<?php
namespace App\Repositories;

use DB;
use App\Repositories\BaseRepository;
use App\Repositories\QueryPagination;
use App\Repositories\ListParam;
use App\Models\Demo;
use App\Helper\Util;
use Carbon\Carbon;

class DemoRepository extends BaseRepository
{
    use QueryPagination;
    public function getModel()
    {
        return Demo::class;
    } 
    
    public function getList(ListParam $params)
    {
        
        if ($params->search) {
            $searchKey = $params->search;
            // implement search logic
            $query->where(function ($q) use ($searchKey) {
                return $q->where('email', 'LIKE', '%' . $searchKey . '%');
            });
        }
        $query = $this->model::query();
        // $query = $this->model;
        $pagination = $this->queryPagination($query, $params->limit, $params->page);

        return [
            'items' => $query->get()->toArray(),
            'pagination' => $pagination
        ];
    }
    
    
    public function create(array $input) 
    {
        $id = $this->model->create($input)->id;
        return $id;
    }
    
    
    public function delete($id) 
    {
        $result = $this->find($id);
        if ($result) {
            $result->destroy($id);
        }
    }
    
    public function find($id) 
    {
        $result = $this->model->find($id); 
        return $result; 
    }

}