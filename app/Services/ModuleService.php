<?php
namespace App\Services;
use App\Models\Module;
class ModuleService  extends BaseService
{

    public static function getList($filters, $type=null){

        $results = new Module();

        if (!empty($filters['with_relation'])) {
            $results = $results->with(['parent_module']);
        }

        if (!empty($filters['parent_id'])) {
            $filters['parent_id'] =  $filters['parent_id'] == 'all-Parent' ? 0:$filters['parent_id'];
            $results = $results->where('parent_id', $filters['parent_id']);
        }

        if (!empty($filters['name'])) {
            $results = $results->where('name', 'LIKE', $filters['name'] .'%');
        }

        if ($type== 'get') {
            $results = $results->get();
        }elseif($type =="defaultPaginate"){
            $results = $results->paginate(25);
        }
        return $results;
    
    }

    public static function insertOrUpdate($data, $id = null){
        try {
            
            $obj = new  Module;
            if (!empty($id)) {
                $obj  =   $obj->find($id);
            }
            if (!empty($data['parent_id'])) {
                $obj->parent_id = $data['parent_id'];
            }
            
            if (!empty($data['name'])) {
                $obj->name = $data['name'];
            }

            if (!empty($data['active_cases'])) {
                $obj->active_cases = $data['active_cases'];
            }

            if (!empty($data['icon'])) {
                $obj->icon = $data['icon'];
            }

            if (!empty($data['route_name'])) {
                $obj->route_name = $data['route_name'];
            }
            if (!empty($data['route_params'])) {
                $obj->route_params = $data['route_params'];
            }
            if (!empty($data['is_multi_level'])) {
                $obj->is_multi_level = $data['is_multi_level'];
            }

            if (!empty($data['status'])) {
                $obj->status = $data['status'];
            }
            
            $obj = $obj->save();
            
            return [
                'data'=>$obj,
                'status'=>true
            ];
        } catch (\Throwable $th) {
            return [
                'data'=>[],
                'status'=>false
            ];
        }
    }

    public static function gatById($id){
        try {
            return Module::find($id);
        } catch (\Throwable $th) {
            return [
                'data'=>[],
                'status'=>false
            ];
        }
        
    }

    public static function updateStatus($id){
        try {
            $obj = self::gatById($id);
            $obj->status = $obj->status =="Active" ? 'InActive' :'Active';
            $obj->save();
            return [
                'data'=>[],
                'status'=>true
            ];
        } catch (\Throwable $th) {
            return [
                'data'=>[],
                'status'=>false
            ];
        }
    }

    public static function delete($id){
        try {
            
            $obj = self::gatById($id);
            
            $result = ['data'=>[],'status'=>false];
            
            if ($obj && $obj->delete()) {
                $result = ['data'=>[],'status'=>true];
            }
            return $result;
        } catch (\Throwable $th) {
            return [
                'data'=>[],
                'status'=>false
            ];
        }
    }
    
}
