<?php

namespace App\Http\Auxs;

trait Paginate
{
    public static $TOTAL_PER_PAGE = 10;
    public static $CACHE_EXPIRE_PER_PAGE = 600;
}
