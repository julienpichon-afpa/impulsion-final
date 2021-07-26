<?php

namespace App\Classe;

use App\Entity\Category;

// permet de représenter la recherche de l’utilisateur et les filtres produits

class Search
{
    /**
     * @var string
     */
    public $string = '';

    /**
     * @var Category[]
     */
    public $categories = [];
}

