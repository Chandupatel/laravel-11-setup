<?php

namespace App\Services;
use App\Traits\ErrorLogHandlerTrait;
class BaseService 
{
    use ErrorLogHandlerTrait;

    public function setListRespons($query , $responseType){

        if ($responseType === 'get') {
            $result = $query->get();
        } elseif ($responseType === 'defaultPaginate') {
            $result = $query->paginate(25);
        }else{
            $result = $query;
        }
        return $result;
    }

    
}
