<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 26/11/2016
 * Time: 15:01
 */
if ( ! function_exists('config_path'))
{
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}