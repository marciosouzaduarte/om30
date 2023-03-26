<?php

namespace App\Http\Auxs;

trait HttpStatusCode
{
    public static $OK = 200;
    public static $CREATED = 201;
    public static $NO_CONTENT = 204;
    public static $BAD_REQUEST = 400;
    public static $NOT_FOUND = 404;
    public static $INTERNAL_SERVER_ERROR = 500;
}
