<?php

namespace App\Services;

use App\Services\Traits\Admin;
use App\Services\Traits\User;

class Base
{
    use User, Admin;
}
