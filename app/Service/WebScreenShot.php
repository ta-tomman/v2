<?php

namespace App\Service;

class WebScreenShot
{
    /**
     * Rasterize existing HTML file and write the output into file
     *
     * @param string $srcPath path to input html file
     * @param string $dstPath output path with extension (pdf or png)
     * @param string $dimension output dimension (image or paper size), default is '720px*1280px'
     */
    public static function rasterizeFile($srcPath, $dstPath, $dimension = '720px*1280px')
    {
        $rasterizerPath  = escapeshellarg(__DIR__.'/rasterize.js');
        $url             = escapeshellarg("file:///$srcPath");
        $dstPath         = escapeshellarg($dstPath);

        $cmd    = "phantomjs $rasterizerPath $url $dstPath $dimension";
        $result = shell_exec($cmd);
        // TODO: process $result to check for error
    }
}
