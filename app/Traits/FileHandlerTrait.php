<?php

namespace App\Traits;

trait FileHandlerTrait
{
    use ErrorLogHandlerTrait;
    public function uploadFile($file, $file_path, $old_image_url = null)
    {
        try {
            $upload_path = null;
            $old_image_name = $old_image_url ? basename($old_image_url) : '';
            $response = $this->uploadOnAWSS3($file, $file_path, $old_image_name);
            if (!$response['status']) {
                $response = $this->uploadOnLocal($file, $file_path, $old_image_name);
                if ($response['status']) {
                    $upload_path = $response['upload_path'];
                }
            } else {
                $upload_path = $response['upload_path'];
            }
            return $upload_path;
        } catch (\Throwable $th) {
            $this->saveErrorLog($th);
        }
    }

    public function uploadOnAWSS3($file, $file_path, $old_image_name = null)
    {
        $response = ['upload_path' => "", 'status' => false];
        try {
            $file_path = 'uploads/' . $file_path;
            if (!empty($old_image_name)) {
                $file_path = $file_path . '/' . $old_image_name;
                \Storage::disk('s3')->put($file_path, file_get_contents($file));
            } else {
                $file_path = \Storage::disk('s3')->put($file_path, $file);
            }
            $response = ['upload_path' => $file_path, 'status' => true];
            return $response;
        } catch (\Throwable $th) {
            $this->saveErrorLog($th);
        }

        
    }

    public function uploadOnLocal($file, $file_path, $old_image_name = null)
    {
        $response = ['upload_path' => "", 'status' => false];
        try {
            $file_path = 'local-uploads/' . $file_path;
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            if (!empty($old_image_name)) {
                $filename = $old_image_name;
            }
            $file->storeAs($file_path, $filename, 'public');
            $upload_path = $file_path . '/' . $filename;
            $response = ['upload_path' => $upload_path, 'status' => true];
        } catch (\Throwable $th) {
            $this->saveErrorLog($th);
        }

        return $response;
    }

    public function RemoveFile($image_url)
    {
        try {
            $ImagePath = public_path(str_replace('/', '\\', str_replace(url('/'), '', $image_url)));
            if (File::exists($ImagePath)) {
                File::delete($ImagePath);
            }
        } catch (\Throwable $th) {
            $this->saveErrorLog($th);
        }
    }

}
