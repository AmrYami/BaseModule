<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BaseRepositoryShow extends BaseRepository
{

    /**
     * Paginate records for scaffold.
     *
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate(array $search = [],int $perPage, array $columns = ['*']): LengthAwarePaginator
    {
        $query = $this->allQuery($search);
        return $query->paginate($perPage, $columns);
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @return Builder
     */
    public function allQuery(array $search = [], int $skip = null, int $limit = null): Builder
    {
        $query = $this->model->newQuery();

        $query = $this->search($query, $search);

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }


    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return Builder[]|Collection
     */
    public function all(array $search = [], int $skip = null, int $limit = null, array $columns = ['*'])
    {
        $query = $this->allQuery($search, $skip, $limit);

        return $query->get($columns);
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find(int $id, array $columns = ['*'])
    {
        $query = $this->model->newQuery();
        return $query->find($id, $columns);
    }

    /**
     * @param array $criteria
     * @param array|string[] $columns
     * @return Builder|Model|object|null
     */
    public function findOneBy(array $criteria, array $columns = ['*'])
    {
        $builder = $this->model->query();
        foreach ($criteria as $key => $value) {
            $operator = '=';
            if (is_array($value)) {
                $operator = $value['operator'];
                $value = $value['value'];
            }
            $builder->where($key, $operator, $value);
        }
        return $builder->first($columns);
    }

    /**
     * @param array $criteria
     * @param array|string[] $columns
     * @return Builder
     */
    public function findByOperator(array $criteria, array $columns = ['*'])
    {
        $builder = $this->model->query();
        foreach ($criteria as $key => $value) {
            $operator = '=';
            if (is_array($value) && in_array($key, $this->getFieldsSearchable())) {
                $builder->where($key, $value['operator'], $value['value']);
            }else {
                if (!is_array($value)){
                    $builder->error = "$value is Not array";
                } elseif (!in_array($key, $this->getFieldsSearchable())){
                    $builder->error = "$key is Not searchable";
                }
            }
        }
        return $builder;
    }
}
