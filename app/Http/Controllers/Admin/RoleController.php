<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Services\RoleService;
use App\Traits\HandlesResourceActionsTrait;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
    protected $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('admin.roles.index');
    }

    public function create()
    {
        return $this->handleView('admin.roles.create');
    }

    protected function getValidationRules()
    {
        return [
            'name' => ['required', 'string', 'max:250'],
            'status' => ['required', 'string', 'max:250'],
        ];
    }

    public function store(Request $request)
    {
        return $this->handleRequest(function() use ($request) {
            $result = $this->service->insertOrUpdate($request->all());
            return $result['status']
                ? $this->jsonResponse('Role Created Successfully', true)
                : $this->jsonResponse('Oops..something went wrong. Please try again.', false);
        },$request, $this->getValidationRules());
    }

    public function edit(string $id)
    {
        $obj = $this->service->getById($id);
        return $this->handleView('admin.roles.edit', compact('obj'));
    }

    public function update(Request $request, string $id)
    {
        return $this->handleRequest(function() use ($request, $id) {
            $result = $this->service->insertOrUpdate($request->all(), $id);
            return $result['status']
                ? $this->jsonResponse('Role Updated Successfully', true)
                : $this->jsonResponse('Oops..something went wrong. Please try again.', false);
        },$request,  $this->getValidationRules());
    }

    public function status(Request $request, $id)
    {
        return $this->updateStatus($id, [$this->service, 'updateStatus'], 'Role Status Updated Successfully', 'Oops..something went wrong. Please try again.');
    }

    public function destroy($id)
    {
        return $this->removeResource($id, [$this->service, 'delete'], 'Role Deleted Successfully', 'Oops..something went wrong. Please try again.');
    }
}
