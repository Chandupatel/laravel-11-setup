<?php
namespace App\Libraries;

class DataTableHelper
{
    public static function getDataTableParameters()
    {
        return [
            'searching'=>true,
            'lengthMenu'=>[25, 50, 75, 100],
            'language'=>['emptyTable'=>'']
        ];
       
    }
    
    public static function getDataTableAjax($attributes)
    {
        return [
            "url"=>$attributes['url'],
            "headers"=>'{"X-CSRF-TOKEN": $("meta[name="csrf-token"]").attr("content")}',
            "type"=>$attributes['method'],
            "data"=>'function(d) {$("#dataTableSearchForm").find(".form-control").each(function() {d[$(this).attr("name")] = $(this).val();})}',
            "beforeSend"=>'function() {$("#preloader").show();}',
            "complete"=>'function(response) {$("#preloader").hide();}'
       ];
    }
}
