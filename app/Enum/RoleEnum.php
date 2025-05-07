<?php

namespace App\Enum;

enum RoleEnum: int
{
    case ADMIN = 1;
    case EDITOR = 2;
    case REVIEWER = 3;
}
