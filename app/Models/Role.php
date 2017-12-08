<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;
}
