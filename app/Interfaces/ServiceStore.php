<?php


namespace App\Interfaces;

use Faker\Core\Number;
use Illuminate\Http\Request;

interface ServiceStore
{
    public function save(Request $request);

    public function update(Number $id, Request $request);
}
