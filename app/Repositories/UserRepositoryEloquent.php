<?php

namespace CodeFlix\Repositories;

use CodeFlix\Models\User;
use Jrean\UserVerification\Facades\UserVerification;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $attributes)
    {
        $attributes['role']     = User::ROLE_ADMIN;
        $attributes['password'] = User::generatePassword();

        $model = parent::create($attributes);

        UserVerification::generate($model);
        UserVerification::send($model, 'Sua conta foi criada');

        return $model;
    }
}
