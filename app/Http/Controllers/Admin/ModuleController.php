<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DataTables\Admin\ModuleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Services\ModuleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
    public function index(ModuleDataTable $dataTable ){ 
        return $dataTable->render('admin.modules.index');
    }

    public function create()
    {
        $modules = ModuleService::getList(['parent_id'=>'all-Parent'], 'get');
        $html = "". view('admin.modules.create',compact('modules'))."";
        $response = ['message' => '','html'=>$html, 'status' => true];
        return response()->json($response, 200);
    }

    public function checkRequestValidation($request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'name' => ['required','string', 'max:250'],
                'active_cases' => ['required','string'],
                'icon' => ['required','string','max:250'],
                'route_name' => ['required','string','max:250'],
                'status' => ['required','string','max:250'],
            ], []);

            $result = ['message' => '', 'status' => true];
            if ($validator->fails()) {
                $errors = $validator->errors();
                $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            }
            return $result;
        } catch (\Throwable $th) {
            $result = ['message' => $th->getMessage(), 'status' => false];
            return $result;
        }
    }

    public function store(Request $request)
    {
        try {
            $validation  = $this->checkRequestValidation($request);
            if (!$validation['status']) {
                return response()->json($validation, 200);
            }
            $response = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
            $result  = ModuleService::insertOrUpdate($request->all());
            if ($result['status']) {
                $response = ['message' => 'Module Created Successfully', 'status' => true];
            }

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $result = ['message' => $th->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
    }


    public function edit($id)
    {
        try {
            $obj   = ModuleService::gatById($id);
            if ($obj) {
                $modules = ModuleService::getList(['parent_id'=>'all-Parent'], 'get');
                $html = "". view('admin.modules.edit',compact('modules','obj'))."";
                $response = ['message' => '','html'=>$html, 'status' => true];
                return response()->json($response, 200);
            }else{
                $response = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                return response()->json($response, 200);
            }
        } catch (\Throwable $th) {
            $result = ['message' => $th->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
        
    }

    public function update(Request $request, $id)
    {
        try {

            $validation  = $this->checkRequestValidation($request);
            
            if (!$validation['status']) {
                return response()->json($validation, 200);
            }
            
            $result  = ModuleService::insertOrUpdate($request->all(), $id);
            $response = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
            if ($result['status']) {
                $response = ['message' => 'Module Update Successfully', 'status' => true];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $result = ['message' => $th->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
    }

    public function status(Request $request , $id){
        try {
            $result  = ModuleService::updateStatus($id);
            $response = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
            if ($result['status']) {
                $response = ['message' => 'Module Status Update Successfully', 'status' => true];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $result = ['message' => $th->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
    }

    public function destroy($id){
        try {
            $result  = ModuleService::delete($id);
            $response = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
            if ($result['status']) {
                $response = ['message' => 'Module Deleted Successfully', 'status' => true];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $result = ['message' => $th->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
    }

}
