<?php

namespace App\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Task
{
    private const CACHE_KEY = 'USER';
    private const ALL = 'ALL';

    /**
     * @return mixed
     */
    public static function all()
    {
        return Cache::remember(self::getCachedKey(self::ALL), Carbon::now()->addDay(), function () {
            return \App\Task::all();
        });
    }

    public static function flush()
    {
        Cache::flush();
    }

    public static function getCachedKey($key)
    {
        return self::CACHE_KEY.".$key";
    }
}
