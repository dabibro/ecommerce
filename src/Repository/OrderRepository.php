<?php

namespace App\Repository;

use App\DB\SQLQueryBuilder;
use App\Infrastructure\Pagination;

class OrderRepository extends SQLQueryBuilder
{
    public Pagination $pagination;
    public int $default_limit = 10;
    public int $items_total = 0;

    public function getOrder($params = []): array
    {
        $query = $this->select()->from($this->invoices)->where('1');
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $query->aand(" " . $param . " = '$value' ");
            }
        }
        return $query->getQueryArray();
    }

    public function paginateOrder($params = [], $where_condition = ""): array
    {
        $this->pagination = new Pagination();
        if (!empty($params['default_limit'])) {
            $this->default_limit = $params['default_limit'];
            $this->pagination->default_limit = $this->default_limit;
        }
        if (!empty($params['condition']['date'])) {
            $date = $params['condition']['date'];
            unset($params['condition']['date']);
        }
        if (!empty($params['condition']['search'])) {
            $search = $params['condition']['search'];
            unset($params['condition']['search']);
        }
        $getTotalItems = $this->getOrder($params['condition']);
        if (!empty($getTotalItems['dataArray'])) {
            $this->items_total = count($getTotalItems['dataArray']);
            $this->pagination->items_total = $this->items_total;
        }
        $this->pagination->mid_range = $params['mid_range'];
        $this->pagination->paginate();
        $where = "1";
        if (!empty($where_condition)) {
            $where .= " AND " . $where_condition;
        }
        $query = $this->select()->from($this->invoices)->where($where);
        if (!empty($search)) {
            $keyword = $search['keyword'];
            $columns = explode(',', $search['columns']);
            $search_condition = "";
            foreach ($columns as $column) {
                if (!empty($column)) {
                    $search_condition .= " OR " . $column . " LIKE '%$keyword%' ";
                }
            }
            $search_condition = ltrim($search_condition, " OR ");
            $query->aand($search_condition);
        }
        if (!empty($params['condition'])) {
            foreach ($params['condition'] as $param => $value) {
                $query->aand(" " . $param . "='$value' ");
            }
        }

        if (!empty($params['orderBy'])) {
            $query->orderBy($params['orderBy']);
        }
        return $query->setLimit($this->pagination->limit)->getQueryArray();
    }

    public function createOrder($params = []): array
    {
        return $this->insert($this->invoices, $params)->getQuery();

    }

    public function updateOrder($params = []): array
    {
        return $this->update($this->invoices, $params)->getQuery();

    }


    public function getOrderProduct($params = []): array
    {
        $query = $this->select()->from($this->sold_products)->where('1');
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $query->aand(" " . $param . " = '$value' ");
            }
        }
        return $query->getQueryArray();
    }

    public function createOrderProduct($params = []): array
    {
        return $this->insert($this->sold_products, $params)->getQuery();

    }

    public function updateOrderProduct($params = []): array
    {
        return $this->update($this->sold_products, $params)->getQuery();

    }
}