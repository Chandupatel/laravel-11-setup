<?php
namespace App\Services;

use App\Models\Module;

class ModuleService extends BaseService
{
    public static function instance()
    {
        return new self();
    }
    public static function getList($filters, $type = null)
    {
        try {
            $query = Module::query();
            if (!empty($filters['with_relation'])) {
                $query = $query->with(['parent_module']);
            }
            if (!empty($filters['parent_id'])) {
                $filters['parent_id'] = $filters['parent_id'] == 'all-Parent' ? 0 : $filters['parent_id'];
                $query = $query->where('parent_id', $filters['parent_id']);
            }
            if (!empty($filters['name'])) {
                $query = $query->where('name', 'LIKE', $filters['name'] . '%');
            }
            $result = self::instance()->setListRespons($query, $type);
        } catch (\Throwable $th) {
            $result = [];
            self::instance()->saveErrorLog($th);
        }
        return $result;

    }
    public static function insertOrUpdate($data, $id = null)
    {
        $response = ['data' => [], 'status' => false];
        try {
            $module = !empty($id) ? Module::find($id) : new Module;
            $attributes = $module->getFillable();
            foreach ($attributes as $attribute) {
                if (!empty($data[$attribute])) {
                    $module->$attribute = $data[$attribute];
                }
            }
            $module->save();
            $response = ['data' => $module, 'status' => true];
        } catch (\Throwable $th) {
            self::instance()->saveErrorLog($th);
        }
        return $response;
    }

    public static function getById($id)
    {
        $result = ['data' => [], 'status' => false];
        try {
            $module = Module::find($id);
            $result = $module ? $module : $result;
        } catch (\Throwable $th) {
            self::instance()->saveErrorLog($th);
        }
        return $result;
    }

    public static function updateStatus($id)
    {
        $response = ['data' => [], 'status' => false];
        try {
            $module = self::getById($id);
            if ($module) {
                $module->status = $module->status === 'Active' ? 'Inactive' : 'Active';
                $module->save();
                $response = ['data' => $module, 'status' => true];
            }
        } catch (\Throwable $th) {
            self::instance()->saveErrorLog($th);
        }
        return $response;
    }

    public static function delete($id)
    {
        $response = ['data' => [], 'status' => false];
        try {
            $module = self::getById($id);
            if ($module && $module->delete()) {
                $response = ['data' => [], 'status' => true];
            }
        } catch (\Throwable $th) {
            self::instance()->saveErrorLog($th);
        }
        return $response;
    }
}
