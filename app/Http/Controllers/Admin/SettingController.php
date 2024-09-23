<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function settingsGroup($group)
    {
        try {
            $settings = SettingService::getList(['group' => $group], 'get');
            return view("admin.settings.group", compact("settings", "group"));
        } catch (\Throwable $th) {
            $this->saveErrorLog($th);
            return redirect()->back()->with("error", "Internal server error.");
        }

    }

    public function settingsGroupUpdate(Request $request, $group)
    {
        try {
            $settings = SettingService::getList(['group' => $group], 'get');
            $response = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
            if (!empty($settings)) {
                foreach ($settings as $index => $value) {
                    $input = $request[$value->key];
                    if ($value->input_type == 'file') {
                        if ($request->hasFile($value->key)) {
                            $input = $this->uploadFile($request->file($value->key), 'settings');
                        }
                    }
                    SettingService::update(['id' => $value->id, 'value' => $input]);
                }
                $response = ['message' => 'Settings Updated Successfully.', 'status' => true];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $this->saveErrorLog($th);
            $response = ['message' => 'Internal server error.', 'status' => false];
            return response()->json($response, 200);
        }
    }
}
