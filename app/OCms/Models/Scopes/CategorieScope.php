<?php

namespace App\OCms\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CategorieScope implements Scope
{
    /**
     * Ajoute un scope sur le modèle pour que chaque query n'aille cherche que les entrées de post du modèle concerné
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('model', $model::class);
    }
}
