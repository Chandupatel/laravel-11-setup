<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ModuleDataTable;
use App\Http\Controllers\Controller;
use App\Services\ModuleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
    public function index(ModuleDataTable $dataTable)
    {
        return $dataTable->render('admin.modules.index');
    }

    public function create()
    {
        $response = $this->handleException(new \Exception()); // Default response
        try {
            $modules = ModuleService::getList(['parent_id' => 'all-Parent'], 'get');
            $html = view('admin.modules.create', compact('modules'))->render();
            $response = $this->jsonResponse('', true, $html);
        } catch (\Throwable $th) {
            $response = $this->handleException($th);
        }
        return $response;
    }

    protected function validateModuleRequest($request)
    {
        return Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:250'],
            'active_cases' => ['required', 'string'],
            'icon' => ['required', 'string', 'max:250'],
            'route_name' => ['required', 'string', 'max:250'],
            'status' => ['required', 'string', 'max:250'],
        ]);
    }

    public function store(Request $request)
    {
        $response = $this->jsonResponse('Oops..something went wrong. Please try again.', false);
        $validator = $this->validateModuleRequest($request);
        if ($validator->fails()) {
            return $this->jsonResponse('', "validator_error", '', $validator->errors());
        }
        try {
            $result = ModuleService::insertOrUpdate($request->all());
            if ($result['status']) {
                $response = $this->jsonResponse('Module Created Successfully', true);
            }
        } catch (\Throwable $th) {
            $response = $this->handleException($th);
        }

        return $response;
    }

    public function edit($id)
    {
        $response = $this->jsonResponse('Module not found.', false);
        try {
            $obj = ModuleService::getById($id);
            if ($obj) {
                $modules = ModuleService::getList(['parent_id' => 'all-Parent'], 'get');
                $html = view('admin.modules.edit', compact('modules', 'obj'))->render();
                $response = $this->jsonResponse('', true, $html);
            }
        } catch (\Throwable $th) {
            $response = $this->handleException($th);
        }
        return $response;
    }

    public function update(Request $request, $id)
    {
        $response = $this->jsonResponse('Oops..something went wrong. Please try again.', false);
        $validator = $this->validateModuleRequest($request);
        if ($validator->fails()) {
            return $this->jsonResponse('', false, '', $validator->errors());
        }
        try {
            $result = ModuleService::insertOrUpdate($request->all(), $id);
            if ($result['status']) {
                $response = $this->jsonResponse('Module Updated Successfully', true);
            }
        } catch (\Throwable $th) {
            $response = $this->handleException($th);
        }
        return $response;
    }

    public function status(Request $request, $id)
    {
        $response = $this->jsonResponse('Oops..something went wrong. Please try again.', false);
        try {
            $result = ModuleService::updateStatus($id);
            if ($result['status']) {
                $response = $this->jsonResponse('Module Status Updated Successfully', true);
            }
        } catch (\Throwable $th) {
            $response = $this->handleException($th);
        }
        return $response;
    }

    public function destroy($id)
    {
        $response = $this->jsonResponse('Oops..something went wrong. Please try again.', false);
        try {
            $result = ModuleService::delete($id);
            if ($result['status']) {
                $response = $this->jsonResponse('Module Deleted Successfully', true);
            }
        } catch (\Throwable $th) {
            $response = $this->handleException($th);
        }
        return $response;
    }
}
