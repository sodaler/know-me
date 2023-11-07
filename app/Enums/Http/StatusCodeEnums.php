<?php

namespace App\Enums\Http;

enum StatusCodeEnums: int
{
    case OK = 200;
    case SERVER_ERROR = 500;
    case CLIENT_ERROR = 400;
}
