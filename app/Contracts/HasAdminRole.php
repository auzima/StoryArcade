<?php

namespace App\Contracts;

interface HasAdminRole
{
    /**
     * Vérifie si l'utilisateur est un administrateur.
     *
     * @return bool
     */
    public function isAdmin(): bool;
}
