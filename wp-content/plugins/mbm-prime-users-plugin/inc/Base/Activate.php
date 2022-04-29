<?php

namespace Inc\Base;

use Inc\Database\Db;
use Inc\Pages\SignUp;
use Inc\Api\User;

class Activate
{
    public static function activate(SignUp $SignUpPage, Roles $Roles, Db $Db, User $User)
    {
        $SignUpPage->createPage();
        $Roles->addRoles();
        $Db->runAllDbMethods();
        $User->register();
        flush_rewrite_rules();
    }
}
