<?php

namespace DTApi\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     * Use this function to send a generic API response. This function will save you from constructing
     * custom responses across the application.
     *
     * USAGE
     * $this->genericResponse(true, 'Successful', ['add_1' => 'add value 1', 'add_2' => 'add value 2'])
     *
     * @param bool $success
     * @param string $message
     * @param array ...$params
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function genericResponse(bool $success, string $message = '', array ...$params)
    {
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        $response = array_merge(
            $response,
            collect($params)
                ->mapWithKeys(function ($a) {
                    return $a;
                })
                ->all()
        );

        return response($response, $success ? 200 : 400);
    }

}
