<?php

namespace App\Domains\User\Contract;

interface UserRepositoryInterface
{
    public function index();

    public function show(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}
