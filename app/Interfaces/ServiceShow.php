<?php


namespace App\Interfaces;


use Illuminate\Http\Request;

interface ServiceShow
{
    public function edit($id);
    public function find($id, Request $request):object;
    public function find_by(Request $request):object;

}
