<?php

namespace App\Domains\User\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Common\Traits\HandleResponseAndLog;
use App\Domains\User\Application\DTOs\CreateRoleDTO;
use App\Domains\User\Application\UseCases\Role\CreateRoleUseCase;
use App\Domains\User\Application\UseCases\Role\UpdateRoleUseCase;
use App\Domains\User\Application\UseCases\Role\DeleteRoleUseCase;
use App\Domains\User\Application\UseCases\Role\ShowRoleUseCase;
use App\Domains\User\Application\UseCases\Role\ListRolesUseCase;
use App\Domains\User\Http\Requests\RoleRequest\CreateRoleFormRequest;
use App\Domains\User\Http\Requests\RoleRequest\UpdateRoleFormRequest;
use App\Domains\User\Http\Resources\Role\RoleResource;
use App\Domains\User\ValueObjects\NameValueObject;
use Throwable;

class RoleController extends Controller
{
    use HandleResponseAndLog;

    public function __construct(
        private CreateRoleUseCase $createRoleUseCase,
        private UpdateRoleUseCase $updateRoleUseCase,
        private DeleteRoleUseCase $deleteRoleUseCase,
        private ShowRoleUseCase $showRoleUseCase,
        private ListRolesUseCase $listRolesUseCase
    ) {}

    public function index()
    {
        try {
            $roles = $this->listRolesUseCase->execute();
            return $this->successResponse(RoleResource::collection($roles), 'Roles fetched successfully.');
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to fetch roles.', 400, $e, 'RoleController::index');
        }
    }

    public function show(int $id)
    {
        try {
            $role = $this->showRoleUseCase->execute($id);
            return $this->successResponse(new RoleResource($role), 'Role details fetched successfully.');
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to fetch role.', 404, $e, 'RoleController::show');
        }
    }

    public function store(CreateRoleFormRequest $request)
    {
        try {
            $dto = new CreateRoleDTO(name: new NameValueObject($request->validated()['name']));
            $role = $this->createRoleUseCase->execute($dto);
            return $this->successResponse(new RoleResource($role), 'Role created successfully.', 201);
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to create role.', 400, $e, 'RoleController::store');
        }
    }

    public function update(UpdateRoleFormRequest $request, int $id)
    {
        try {
            $dto = new CreateRoleDTO(name: new NameValueObject($request->validated()['name']));
            $role = $this->updateRoleUseCase->execute($id, $dto);
            return $this->successResponse(new RoleResource($role), 'Role updated successfully.');
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to update role.', 400, $e, 'RoleController::update');
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->deleteRoleUseCase->execute($id);
            return $this->successResponse(null, 'Role deleted successfully.');
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to delete role.', 400, $e, 'RoleController::destroy');
        }
    }
}
