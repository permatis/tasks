<?php

if (!function_exists('user')) {
    function user()
    {
        if (!auth()->guest()) {
            return auth()->user();
        }
    }
}

if (!function_exists('flash')) {
    function flash($message)
    {
        return session()->flash('message', $message);
    }
}

if (!function_exists('dropdowns')) {
    function dropdowns($model = [])
    {
        $array = [];
        foreach ($model as $key => $val) {
            $array[$val->id] = $val->name;
        }

        return $array;
    }
}

if (!function_exists('changeIdKeys')) {
    function changeIdKeys($array, $key)
    {
        foreach ($key as $k) {
            $array[$k.'_id'] = $array[$k];
            unset($array[$k]);
        }

        return $array;
    }
}

if (!function_exists('hashEmail')) {
    function hashEmail($email)
    {
        return md5(strtolower(trim($email)));
    }
}

if (!function_exists('avatar')) {
    function avatar($email, $size = 50)
    {
        return 'http://www.gravatar.com/avatar/'.hashEmail($email).'fs='.$size;
    }
}
