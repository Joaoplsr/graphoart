<?php

namespace App\Enum;

enum StatusEnum : int
{
    case DRAFT = 1;
    case IN_REVIEW = 2;
    case REVIEWED = 3;
    case PUBLISHED = 4;
}
