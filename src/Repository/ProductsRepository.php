<?php

namespace App\Repository;

use App\DB\SQLQueryBuilder;
use App\Infrastructure\Pagination;

class ProductsRepository extends SQLQueryBuilder
{
    public Pagination $pagination;
    public int $default_limit = 10;
    public int $items_total = 0;

    public function getProductCategory($params = []): array
    {
        $query = $this->select()->from($this->categories)->where('1');
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $query->aand(" " . $param . " = '$value' ");
            }
        }
        return $query->getQueryArray();
    }

    public function getTrendingProducts($params = []): array
    {
        $sql = "SELECT 
                p.id AS product_id,
                p.product_name AS product_name,
                p.product_images,
                p.sale_price,
                p.discount,
                SUM(s.quantity) AS total_quantity_sold,
                COUNT(*) AS total_sales,
                MAX(s.created_on) AS last_sale_date
                FROM 
                    " . $this->sold_products . " AS s
                JOIN 
                    " . $this->products . " AS p ON p.id = s.product_id
                WHERE 
                s.created_on >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                AND s.status = '1'
                AND p.active_status = '1'
                AND p.delete_status = '0'
                AND p.quantity > 0
                GROUP BY 
                    p.id, p.product_name, p.product_images
                ORDER BY 
                    RAND(), total_quantity_sold DESC
                LIMIT 8;
                ";
        return $this->getArray($sql);
    }

    public function getCategoryShowcase($params = []): array
    {
        $sql = "
        SELECT 
            id,
            product_name,
            sale_price,
            product_images,
            product_category,
            category_name,
            category_table_id
        FROM (
            SELECT 
                p.id,
                p.product_name,
                p.sale_price,
                p.product_images,
                c.category_id AS product_category,
                c.category AS category_name,
                c.id AS category_table_id,
                @rownum := IF(@prev_cat = p.product_category, @rownum + 1, 1) AS rn,
                @prev_cat := p.product_category
            FROM " . $this->products . " p
            JOIN (
                SELECT id, category_id, category
                FROM " . $this->categories . " 
                WHERE 1
                ORDER BY RAND() 
                LIMIT 5
            ) AS c 
                ON c.category_id = p.product_category
            CROSS JOIN (SELECT @rownum := 0, @prev_cat := 0) vars
            WHERE p.active_status = 1 AND p.quantity > 0
            ORDER BY p.product_category, p.id DESC
        ) AS ranked
        WHERE rn <= 5
        ORDER BY product_category, id DESC
    ";

        return $this->getArray($sql);
    }

    public function getProduct($params = []): array
    {
        $query = $this->select()->from($this->products)->where("1 AND quantity > 0");
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $query->aand(" " . $param . " = '$value' ");
            }
        }
        return $query->getQueryArray();
    }

    public function getProductsPricing($params = []): array
    {
        $query = $this->select("MIN(sale_price) AS min_price, MAX(sale_price) AS max_price")->from($this->products)->where("1 AND quantity > 0");
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $query->aand(" " . $param . " = '$value' ");
            }
        }
        return $query->getQueryArray();
    }


    public function paginateProducts($params = [], $where_condition = ""): array
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
        $getTotalItems = $this->getProduct($params['condition']);
        if (!empty($getTotalItems['dataArray'])) {
            $this->items_total = count($getTotalItems['dataArray']);
            $this->pagination->items_total = $this->items_total;
        }
        $this->pagination->mid_range = $params['mid_range'];
        $this->pagination->paginate();
        $where = "1 AND quantity > 0";
        if (!empty($where_condition)) {
            $where .= " AND " . $where_condition;
        }
        $query = $this->select()->from($this->products)->where($where);
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


}