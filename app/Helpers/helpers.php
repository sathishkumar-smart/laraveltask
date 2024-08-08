<?php

if (!function_exists('fav_icon')) {
    function fav_icon($icon = 'default-icon')
    {
        // Your logic to return an icon path or URL
        return '<link rel="icon" href="' . asset('icons/' . $icon . '.png') . '">';
    }
}