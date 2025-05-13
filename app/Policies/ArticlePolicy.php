<?php

namespace App\Policies;

use App\Enum\RoleEnum;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    private function isAdminOrEditor(User $user): bool
    {
        return in_array($user->role_id, [RoleEnum::ADMIN->value, RoleEnum::EDITOR->value]);
    }

    public function index(User $user)
    {
        return $this->isAdminOrEditor($user)
        ? Response::allow()
        : Response::deny('Você não tem permissão para acessar esta página');
    }

    public function indexDraft(User $user)
    {
        return $this->isAdminOrEditor($user)
        ? Response::allow()
        : Response::deny('Você não tem permissão para acessar esta página');
    }

    public function inReview(User $user)
    {
        return $this->isAdminOrEditor($user)
        ? Response::allow()
        : Response::deny('Você não tem permissão para acessar esta página');
    }

    public function reviewed(User $user)
    {
        return $user->role_id === RoleEnum::REVIEWER->value
        ? Response::allow()
        : Response::deny('Você não tem permissão para acessar esta página');
    }

    public function published(User $user)
    {
        return $this->isAdminOrEditor($user)
        ? Response::allow()
        : Response::deny('Você não tem permissão para acessar esta página');
    }

    public function store(User $user)
    {
        return $this->isAdminOrEditor($user)
        ? Response::allow()
        : Response::deny('Você não tem permissão para acessar esta página');
    }

    public function destroy(User $user)
    {
        if ($user->role_id === RoleEnum::ADMIN->value || $user->role_id === RoleEnum::EDITOR->value) {
            return Response::allow();
        }
        return Response::deny('Você não tem permissão para acessar esta página');
    }
}
