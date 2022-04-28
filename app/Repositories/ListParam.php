<?php
namespace App\Repositories;

use Illuminate\Support\Arr;

class ListParam
{
    /**
     * Order By.
     * @var string
     */
    public $orderBy;


    /**
     * Search.
     * @var string
     */
    public $search;

    /**
     * Limit.
     * @var int
     */
    public $limit;

    /**
     * Offset.
     * @var int
     */
    public $page;
    
    /**
     * Options.
     * @var int
     */
    public $options;
    

    public function __construct(string $orderBy = null, ?string $search = '', int $page = null, int $limit = null, $options = [])
    {
        $this->search = $search;
        $this->orderBy = $orderBy;
        $this->page = $page;
        $this->limit = $limit;
        $this->options = $options;
    }

    public static function fromArray($array) {
        $search = $array['search'] ?? null;
        $orderBy = $array['order_by'] ?? null;
        $page = $array['page'] ?? null;
        $limit = $array['limit'] ?? null;
        $options = Arr::except($array, ['search', 'order_by', 'page', 'limit']) ?? null;
        return new self($orderBy, $search, $page, $limit, $options);
    }
}