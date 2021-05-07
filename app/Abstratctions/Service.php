<?php


namespace App\Abstratctions;


use Illuminate\Http\Request;

abstract class Service
{

    public function clean_request(Request $request): void
    {
        if ($request->has('_method'))
            $request->request->remove('_method');
        if ($request->has('_token'))
            $request->request->remove('_token');
    }

}
