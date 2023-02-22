<?php

use App\Models\Category;

function getCats()
{
    try {
        return Category::get();
    } catch (\Throwable $th) {
        logger($th);
    }
}