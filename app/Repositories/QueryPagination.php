<?php

namespace App\Repositories;

trait QueryPagination {
    private function queryPagination(&$query, $limit, $page = 1): array
    {
        $pagination = $this->getPagination($query, $limit, $page);
        $offset = $limit * ($page - 1);
        $query->limit($limit)->offset($offset);
        return $pagination;
    }

    private function getPagination($query, $limit, $page = 1): array
    {
      $totalItems = $query->getQuery()->getCountForPagination();
      $isPaginationEnable = isset($page) || isset($limit);
      $isPaginationPage = isset($page);
      $isPaginationLimit = isset($limit);
      
      return [
          'total_items' => $totalItems,
          'current_page' =>  $isPaginationPage ? $page : 1,
          'total_page' => $isPaginationEnable ? ceil($totalItems/$limit) : 1,
          'limit' => $isPaginationLimit ? $limit: $totalItems
      ];
    }
}