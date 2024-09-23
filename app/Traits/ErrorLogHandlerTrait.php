<?php

namespace App\Traits;

use App\Models\ErrorLog;

trait ErrorLogHandlerTrait
{
    public function saveErrorLog(\Throwable $th)
    {
        $obj = new ErrorLog;
        $obj->message = $th->getMessage();
        $obj->file = $th->getFile();
        $obj->line = $th->getLine();
        $obj->report_time = date('Y-m-d H:i:s');
        $obj->save();

        return true;
    }
}
