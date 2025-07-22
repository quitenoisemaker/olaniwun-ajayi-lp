<?php

if (!function_exists('getRole')) {
    function getRole($role)
    {
        return \App\Models\Role::where('slug', $role)->first();
    }
}