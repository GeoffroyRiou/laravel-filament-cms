<?php

declare(strict_types=1);

namespace App\OCms\Enums;

/**
 * Définit les types de status pour les posts
 */
enum PostsStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
}
