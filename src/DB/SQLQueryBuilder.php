<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 4/20/2024
 * Time: 8:48 AM
 */

namespace App\DB;


use App\Infrastructure\DataHandlers;
use App\Infrastructure\Responses;

class SQLQueryBuilder extends MysqliConn
{
    public $query;
    protected $response;


    public function select($columns = ['*'])
    {
        if (is_array($columns)) {
            $columns = implode(', ', $columns);
        }
        $this->query = "SELECT " . $columns;
        return $this;
    }

    public function from($table)
    {
        $this->query .= " FROM $this->DBName.$table";
        return $this;
    }

    public function fromm($table, $alias = null)
    {
        $this->query .= " FROM $this->DBName.$table $alias";
        return $this;
    }

    public function innerJoin($table, $onCondition)
    {
        $this->query .= " INNER JOIN $table ON $onCondition";
        return $this;
    }

    public function leftJoin($table, $alias = "", $onCondition = "")
    {
        $this->query .= " LEFT JOIN $table $alias ON $onCondition";
        return $this;
    }

    public function rightJoin($table, $onCondition)
    {
        $this->query .= " RIGHT JOIN $table ON $onCondition";
        return $this;
    }

    public function orderBy($column)
    {
        $this->query .= " ORDER BY $column";
        return $this;
    }

    public function setLimit($limit): SQLQueryBuilder
    {
        if (is_int($limit)) {
            $this->query .= " LIMIT $limit";
        } else {
            $this->query .= $limit;
        }
        return $this;
    }

    public function where($condition): SQLQueryBuilder
    {
        $this->query .= " WHERE $condition";
        return $this;
    }

    public function aand($condition)
    {
        $this->query .= " AND $condition";
        return $this;
    }

    public function IIN($condition)
    {
        $this->query .= " IN $condition";
        return $this;
    }

    public function insert($table, $values)
    {
        $fields = "";
        $vals = "";
        foreach ($values as $field => $val):
            if ($field !== "dbScheme" && $field !== "tbl_scheme" && $field !== "pk"):
                $fields .= $field . ', ';
                $vals .= "'" . DataHandlers::verify_input($val) . "'" . ',';
            endif;
        endforeach;
        $fields = rtrim($fields, ', ');
        $vals = rtrim($vals, ', ');

        $this->query = "INSERT INTO " . $this->DBName . "." . $table;
        $this->query .= " (" . $fields . ") VALUES (" . $vals . ");";
        return $this;
    }

    public function upsert($table, $values, $uniqueKeys = [])
    {
        // Normalize single row into array of rows
        $rows = isset($values[0]) && is_array($values[0]) ? $values : [$values];

        // Collect field names from the first row
        $firstRow = $rows[0];
        $fields = [];
        foreach ($firstRow as $field => $val) {
            if (!in_array($field, ["dbScheme", "tbl_scheme", "pk"])) {
                $fields[] = $field;
            }
        }
        $valsArr = [];
        foreach ($rows as $row) {
            $rowVals = [];
            foreach ($fields as $field) {
                $rowVals[] = "'" . DataHandlers::verify_input($row[$field] ?? "") . "'";
            }
            $valsArr[] = "(" . implode(", ", $rowVals) . ")";
        }

        // Build ON DUPLICATE KEY UPDATE
        $updateParts = [];
        foreach ($fields as $field) {
            if (!in_array($field, $uniqueKeys)) {
                $updateParts[] = $field . " = VALUES(" . $field . ")";
            }
        }

        $this->query = "INSERT INTO " . $this->DBName . "." . $table;
        $this->query .= " (" . implode(", ", $fields) . ") VALUES ";
        $this->query .= implode(", ", $valsArr);
        if (!empty($updateParts)) {
            $this->query .= " ON DUPLICATE KEY UPDATE " . implode(", ", $updateParts);
        }
        $this->query .= ";";

        return $this;
    }

    public function update($table, $values)
    {
        $extraCondition = "";
        $fields = "";
        $pk_fields = "";
        if (isset($values['agencyId'])) {
            $extraCondition = " AND agencyId = '" . $values['agencyId'] . "'";
            unset($values['agencyId']);
        }
        if (!empty($values)) {
            foreach ($values as $field => $val):
                if ($field !== "pk" && $field !== "pkField")
                    $fields .= $field . " = '" . DataHandlers::verify_input($val) . "'" . ', ';
            endforeach;
            $fields = rtrim($fields, ", ");
            $pk_fields = $values['pkField'] . "='" . $values['pk'] . "'";
        }
        $this->query = "UPDATE " . $this->DBName . "." . $table;
        $this->query .= " SET " . $fields . " WHERE " . $pk_fields;
        if (!empty($extraCondition)) {
            $this->query .= $extraCondition;
        }
        return $this;
    }

    public function multiupdate($table, $column, $value)
    {
        $this->query = "UPDATE " . $this->DBName . "." . $table . " SET " . $column . " = '$value'";
        return $this;
    }


    public function delete($table)
    {
        $this->query = "DELETE FROM " . $this->DBName . "." . $table . " ";
        return $this;
    }

    public function getQuery($useExistingConnection = false)
    {
        $this->query .= ";";
        return $this->execQuery($this->query . PHP_EOL, $useExistingConnection);
    }

    public function getQueryArray()
    {
        $this->query .= ";";
        return $this->getArray($this->query . PHP_EOL);
    }

    public function execQuery($SQL, $useExistingConn = false): array
    {
        if (!$useExistingConn) {
            $this->openConnection();
        }
        $this->conn->query("SET time_zone='+01:00';");
        $resp = $this->conn->query($SQL);
        if ($this->conn->errno && !empty($this->conn->errno)) {
            $response = Responses::getResponse('500');
            $response['message'] = 'Internal server error. MySQL error: ' . $this->conn->error . ' ' . $this->conn->errno;
        } else {
            $response = Responses::getResponse('200');
            $response['dataArray'] = $resp;
            $this->query = "";
        }
        if (!$useExistingConn) {
            $this->closeConnection();
        }
        return $response;
    }

    public function execBatchQuery($SQL): array
    {
        $this->openConnection();
        $this->conn->query("SET time_zone='+01:00';");
        $response = Responses::getResponse('200');

        try {
            $this->conn->begin_transaction();
            $queries = is_array($SQL) ? $SQL : [$SQL];
            $results = [];

            foreach ($queries as $query => $value) {
                $result = $this->conn->query($value);
                if ($this->conn->errno) {
                    throw new Exception("MySQL error: " . $this->conn->error, $this->conn->errno);
                }
                $results[] = true;
            }

            $this->conn->commit();
            $response['dataArray'] = $results;
        } catch (Exception $e) {
            $this->conn->rollback();
            $response = Responses::getResponse('500');
            $response['message'] = 'Internal server error. MySQL error: ' . $e->getMessage() . ' ' . $e->getCode();
        }

        $this->closeConnection();
        return $response;
    }


    public function getArray($SQL): array
    {
        $resp = $this->execQuery($SQL);
        if (!empty($resp['success'])) {
            $data = $resp['dataArray'];
            $rows = $data->num_rows;
            if (!empty($rows)) {
                $results_array = array();
                $result = $data;
                while ($row = $result->fetch_assoc()) {
                    $results_array[] = $row;
                }
                $rsArray = $results_array;
                $response = Responses::getResponse('200');
                $response['dataArray'] = $rsArray;

            } else {
                $response = Responses::getResponse('204');
                $response['message'] = 'Query did not return any results. ' . $resp['message'];
            }
        } else {
            $response = Responses::getResponse('204');
            $response['message'] = 'Query did not return any results. ' . $resp['message'];
        }
        return $response;
    }
}