<?php


namespace App\Interfaces;


use Faker\Core\Number;
use Illuminate\Http\Request;

interface RepositoryStore
{

    public function save(array $data);
    public function delete(Number $id, Request $request);

}
