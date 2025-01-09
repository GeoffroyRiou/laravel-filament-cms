<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Définit les types de status pour les posts
 */
enum UserRoles: string
{
    case Standard = 'standard';
    case Admin = 'admin';
}
