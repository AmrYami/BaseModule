<?php


namespace App\Interfaces;


interface RepositoryShow
{

    public function edit($id);
    public function find($id, array $filter);
    public function find_by(array $data);
}
