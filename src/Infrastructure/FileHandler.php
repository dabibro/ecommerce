<?php
/**
 * Created by PhpStorm.
 * User: Dauda Ibrahim
 * Date: 11/10/2023
 * Time: 01:39 PM
 */

namespace App\Infrastructure;

use Exception;

class FileHandler
{

    public function ParseINI($path = "")
    {
        try {
            $this->CheckFile($path);
            return parse_ini_file($path);
        } catch (Exception $resp) {
            echo ' ' . $resp->getMessage();
        }
    }

    protected function CheckFile($file_path)
    {
        if (!file_exists($file_path)) {
            throw new Exception("Error could find file");
        }
        return true;
    }

    public function fileExtension($s)
    {
        $n = strrpos($s, ".");
        if ($n === false)
            return "";
        else
            return substr($s, $n + 1);
    }

    public function fileTempParse($filename, $varParam)
    {
        ob_start();
        if ($varParam != null):
            extract($varParam);
        endif;
        include($filename);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function JsonReader($jsonfile)
    {
        $resp = "";
        if (file_exists($jsonfile)) {
            $data = file_get_contents($jsonfile);
            $data = json_decode($data);
            $resp = $data;
        }
        return $resp;
    }

    public function ImageUpload($file): array
    {
        $response = [];
        if (!empty($file["name"])) {
            // Get file info
            $fileName = basename($file["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $allowTypes = array('jpg', 'png', 'jpeg', 'PNG', 'JPG', 'JPEG');
            if (in_array($fileType, $allowTypes)) {
                if ($file["size"] > 2097152) {
                    $response['status'] = 0;
                    $response['message'] = 'Sorry, your file is too large.';
                } else {
                    $image = $file['tmp_name'];
                    $data = file_get_contents($image);
                    $base64 = 'data:image/' . $fileType . ';base64,' . base64_encode($data);
                    $imgContent = $base64;

                    if (!$imgContent) {
                        $response['status'] = 0;
                        $response['message'] = 'Sorry, there was an error uploading your file.';
                    } else {
                        $response['status'] = 1;
                        $response['message'] = 'File uploaded successfully.';
                        $response['data'] = $imgContent;
                    }
                }
            } else {
                $response['status'] = 0;
                $response['message'] = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            }
        } else {
            $response['status'] = 0;
            $response['message'] = 'Please select an image file to upload.';
        }
        return $response;
    }

}