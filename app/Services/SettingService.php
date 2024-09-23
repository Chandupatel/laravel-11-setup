<?php
namespace App\Services;

use App\Models\Setting;

class SettingService extends BaseService
{
    public static function getList($filters, $type = null)
    {

        $results = new Setting();

        if (!empty($filters['group'])) {
            $results = $results->where('group', $filters['group']);
        }

        if ($type == 'get') {
            $results = $results->get();
        } elseif ($type == "defaultPaginate") {
            $results = $results->paginate(25);
        }
        return $results;

    }

    public static function update($input)
    {
        try {
            $setting = Setting::find($input["id"]);
            $setting->value = $input["value"];
            $setting->save();
            return $setting;
        } catch (\Throwable $th) {
            return false;
        }

    }
}
