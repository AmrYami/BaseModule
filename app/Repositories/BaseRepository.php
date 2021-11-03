<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     *
     * @throws Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable(): array;

    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model(): string;

    /**
     * Make Model instance
     *
     * @return Model
     * @throws Exception
     *
     */
    public function makeModel(): Model
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Paginate records for scaffold.
     *
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage, array $columns = ['*']): LengthAwarePaginator
    {
        $query = $this->allQuery();

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

    public function search($query, $search)
    {
        if (count($search)) {
            foreach ($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    $query->where($key, $value);
                }
            }
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
     * Create model record
     *
     * @param array $input
     *
     * @return Model
     */
    public function create(array $input): Model
    {
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
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
     * Update model record for given id
     *
     * @param array $input
     * @param null $id
     * @param array $search
     * @return Builder|Builder[]|Collection|Model
     */
    public function update(array $input, $id = null, array $search = [])
    {
        $query = $this->model->newQuery();

        if ($id)
            $model = $query->findOrFail($id);

        if ($search && count($search)) {
            $query = $this->search($query, $search);
            $model = $query->firstOrFail();
        }

        $model->fill($input);

        $model->save();

        return $model;
    }

    /**
     * @param int|null $id
     *
     * @return bool|mixed|null
     * @throws Exception
     */
    public function delete(int $id = null, $search = [])
    {
        $query = $this->model->newQuery();

        if ($id)
            $model = $query->findOrFail($id);

        if ($search && count($search)) {
            $query = $this->search($query, $search);
            $model = $query->firstOrFail();
        }

        return $model->delete();
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
