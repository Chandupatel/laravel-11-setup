<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait HandlesResourceActionsTrait
{
    /**
     * Update the status of a resource.
     */
    protected function updateStatus($id, callable $updateFunction, $successMessage, $errorMessage)
    {
        return $this->handleRequest(function () use ($id, $updateFunction, $successMessage, $errorMessage) {
            $result = $updateFunction($id);
            return $result['status']
                ? $this->jsonResponse($successMessage, true)
                : $this->jsonResponse($errorMessage, false);
        });
    }

    /**
     * Remove a resource.
     */
    protected function removeResource($id, callable $deleteFunction, $successMessage, $errorMessage)
    {
        return $this->handleRequest(function () use ($id, $deleteFunction, $successMessage, $errorMessage) {
            $result = $deleteFunction($id);
            return $result['status']
                ? $this->jsonResponse($successMessage, true)
                : $this->jsonResponse($errorMessage, false);
        });
    }

    /**
     * Generate a JSON response.
     */
    protected function jsonResponse($message = '', $status = false, $html = '', $errors = [])
    {
        return response()->json(compact('message', 'status', 'html', 'errors'), 200);
    }

    /**
     * Handle exceptions and log the error.
     */
    protected function handleException(\Throwable $th)
    {
        // Log the exception (assuming saveErrorLog is implemented)
        $this->saveErrorLog($th);
        return $this->jsonResponse('Internal server error.', false);
    }

    /**
     * Handle a view rendering response.
     */
    protected function handleView(string $view, array $data = [])
    {
        try {
            $html = view($view, $data)->render();
            return $this->jsonResponse('', true, $html);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    /**
     * Handle a request and execute the action.
     */
    protected function handleRequest(callable $action,$request = null, $rules = [])
    {
        if ($request) {
            $validator = $this->validateRequest($request, $rules);
            if ($validator->fails()) {
                return $this->jsonResponse('', false, '', $validator->errors());
            }
        }

        try {
            return $action();
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    /**
     * Validate the request.
     */
    protected function validateRequest($request, $rules)
    {
        return Validator::make($request->all(), $rules);
    }
}
