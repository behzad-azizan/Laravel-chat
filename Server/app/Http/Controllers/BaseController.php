<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var Request
     */
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function successResponse(array $data = null, $message = null)
    {
        if (! $message)
            $message = trans('m.success');

        $out = [
            'code' => 200,
            'message' => (string) $message
        ];

        if (is_array($data))
            $out['data'] = $data;

        return response()->json($out);
    }
}
