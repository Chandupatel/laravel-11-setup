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

}
