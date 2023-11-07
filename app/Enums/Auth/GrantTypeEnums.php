<?php

namespace App\Enums\Auth;

enum GrantTypeEnums: string
{
    case PASSWORD = 'password';
    case REFRESH_TOKEN = 'refresh_token';
}
