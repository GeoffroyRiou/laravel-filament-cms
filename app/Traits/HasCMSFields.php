<?php

namespace App\Traits;

trait HasCMSFields
{
    /**
     * Récupère la valeur un champ à partir de sa clé
     */
    public function field(string $key)
    {
        return $this->custom[0][$key] ?? null;
    }
}
