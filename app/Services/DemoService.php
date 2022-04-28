<?php
namespace App\Services;

use App\Repositories\demoRepository;
use App\Repositories\ListParam;
use DateTime;

class demoService {
    public function __construct(demoRepository $demoRepository)
    {
        $this->demoRepository = $demoRepository;
    }

    public function getList(ListParam $params): array
    {
        $data = $this->demoRepository->getList($params);
        return $data;
    }

    public function find($id)
    {
        return $this->demoRepository->find($id);
    }

    public function create(array $input)
    {
        $id = $this->demoRepository->create($input);

        return ['id'=>$id];
    }


    public function delete($id)
    {
        $this->demoRepository->delete($id);
        return ['id'=>$id];
    }

    public function update($id, array $input)
    {
        return $this->demoRepository->update($id, $input);
    }
}