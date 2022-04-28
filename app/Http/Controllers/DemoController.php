<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\demoService;
use App\Repositories\ListParam;
use App\Http\Controllers\ValidateA;
use App\Http\Controllers\ValidateB;


class DemoController extends Controller
{
    public function __construct (
        demoService $demoService
    ) {
        $this->demoService = $demoService;
    }
    
    
    public function createA(ValidateA $request) 
    {
        $params = $request->validated();
        return $data = $this->demoService->create($params);
    }

    public function createB(ValidateB $request) 
    {
        $params = $request->validated();
        return $data = $this->demoService->create($params);
    }

    public function getList(Request $params)
    {
        $listParam = ListParam::fromArray($params);
        $data = $this->demoService->getList($listParam);
        return $data;
    }

    public function getById(int $id)
    {
        $data = $this->demoService->find($id);
        return $data;
    }
    
    public function delete(int $id)
    {
        $data = $this->demoService->delete($id);
        return $data;
    }

    public function update($id, Request $request) {
        try {
            $isNumericId = is_numeric($id);
            $input = $request->all();
            
            if($isNumericId) {
                $data = $this->demoService->update($id, $input);
                return response()->json($data);
            }
        } catch (\Exception $ex) {
            return $ex;
        }
    }
}
