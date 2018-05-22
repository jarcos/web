<?php

if (! function_exists('static_url')) {
    /**
     * Returns the static url
     *
     * @return string
     */
    function static_url()
    {
        return env('APP_STATIC_URL', '/static/');
    }
}

if (! function_exists('flash')) {
    /**
     * Flash messsage
     *
     * @param string $text
     * @param string $type
     */
    function flash(string $text, string $type = 'success')
    {
        session()->flash('notification', [
            'type' => $type,
            'text' => $text
        ]);
    }
}