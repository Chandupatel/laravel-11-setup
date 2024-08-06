<?php
namespace App\Libraries;

use App\Models\Module;
use App\Models\Setting;
class SiteHelper
{
    public static function getSettingsValueByKey($key)
    {
        $value = '';
        $setting = Setting::where('key', $key)->first();
        if ($setting) {
            $value = $setting->value;
        }
        return $value;
    }

    public static function getAdminSidebarTree()
    {
        $modules = Module::with(['sub_modules' => function ($module) {
            $module->where('status', 'Active')
                ->orderBy('display_order', 'ASC');
        }])->where('status', 'Active')
            ->where('parent_id', 0);
        $modules = $modules->orderBy('display_order', 'ASC')
            ->withCount(['sub_modules'])
            ->get();
        return $modules;
    }

    public static function getDataTableAjax($attributes)
    {
       $ajax =  [
            "url"=>$attributes['url'],
            "headers"=>'{"X-CSRF-TOKEN": $("meta[name="csrf-token"]").attr("content")}',
            "type"=>$attributes['method'],
            "data"=>'function(d) {$("#dataTableSearchForm").find(".form-control").each(function() {d[$(this).attr("name")] = $(this).val();})}',
            "beforeSend"=>'function() {$("#preloader").show();}',
            "complete"=>'function(response) {$("#preloader").hide();}'
       ];
        return $ajax;
    }  
}
