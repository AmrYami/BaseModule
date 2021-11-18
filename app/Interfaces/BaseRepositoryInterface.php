<?php

namespace App\Interfaces;

interface BaseRepositoryInterface
{
    /**
     * Configure the Model
     *
     * @return string
     */
    public function model(): string;

    public function getFieldsSearchable(): array;
}
