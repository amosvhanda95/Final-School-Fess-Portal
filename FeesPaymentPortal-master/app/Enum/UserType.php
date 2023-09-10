<?php

namespace App\Enum;

use App\Models\User;

enum UserType: int
{
    case SysAdmin  = 1;
    case SupportAdmin    = 2;
    case  Teller   = 3;
    case ChiefTeller    = 4;

    public static function canCreate(User $user)
    {
        $types = static::toValueKeyArray()->reverse();

        if($user->type == static::SysAdmin())
        {
            return $types;
        }

        return $types->filter(function ($value) use ($user) {
            return $value->getValue() <= $user->type->getValue();
        });
    }
}
