<?php

namespace App\Domains\User\Infrastructure\Repositories;

use App\Domains\User\Contract\UserRepositoryInterface;
use App\Domains\User\Models\User;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function index()
    {
        return User::paginate(15);
    }

    public function show(int $id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(int $id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
