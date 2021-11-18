<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BaseRepositoryStore extends BaseRepository
{

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
     * Update model record for given id
     *
     * @param array $input
     * @param null $id
     * @param array $search
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($id = null, array $input, array $search = [])
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
}
