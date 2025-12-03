<?php

namespace App\Repository;

use App\DB\SQLQueryBuilder;

class ApplicationRepository extends SQLQueryBuilder
{

    public function getAppConfig($params = []): array
    {
        $query = $this->select()->from($this->config)->where('1');
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $query->aand(" " . $param . " = '$value' ");
            }
        }
        return $query->getQueryArray();
    }

    public function getStoreConfig($params = []): array
    {
        $query = $this->select()->from($this->stores)->where('1');
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $query->aand(" " . $param . " = '$value' ");
            }
        }
        return $query->getQueryArray();
    }

    public function getDeliveryOption($params = []): array
    {
        $query = $this->select()->from($this->delivery_options)->where('1');
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $query->aand(" " . $param . " = '$value' ");
            }
        }
        return $query->getQueryArray();
    }

    public function getPaymentOption($params = []): array
    {
        $query = $this->select()->from($this->payment_options)->where('1');
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $query->aand(" " . $param . " = '$value' ");
            }
        }
        return $query->getQueryArray();
    }

}