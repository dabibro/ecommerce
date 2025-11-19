<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 09/01/2025
 * Time: 05:51
 */

namespace App\DB;


class DBProcessor
{
    protected $files_path;

    public function __construct()
    {
        $this->files_path = 'db/';
        $this->process();
    }

    public function process(): array
    {
        $response = [];
        if (!empty($this->files())) {
            foreach ($this->files() as $file) {
                if (!empty($this->get_file($file))) {
                    $resp = $this->exe_file($this->get_file($file));
                    if ($resp['response'] === '200') {
                        $this->remove_file($file);
                    }
                }
            }
        }
        return $response;
    }

    public function exe_file($sql): array
    {
        $SQLQueryBuilder = new SQLQueryBuilder();
        return $SQLQueryBuilder->execQuery($sql);
    }

    public function get_file($path): string
    {
        return file_get_contents($path);
    }

    public function remove_file($path): void
    {
        @file_put_contents($path, '');
    }

    public function files(): array
    {
        $list = [];
        if (is_dir($this->files_path)) {
            $files = scandir($this->files_path);
            foreach ($files as $file) {
                if ($file === '..' || $file === '.')
                    continue;
//                if (is_dir(__DIR__.''.$this->files_path . $file))
                $list[] = $this->files_path . $file;
            }
        }
        return $list;
    }


}