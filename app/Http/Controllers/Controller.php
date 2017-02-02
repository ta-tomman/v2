<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $viewName name of view
     * @param object $data data to be passed to view
     * @param int $ttl max-age of cache, default to 1 day
     * @return mixed laravel response object
     */
    protected function renderViewWithCacheHeader($viewName, $data, $ttl = 86400)
    {
        $view = view($viewName, $data);
        $viewFile = $view->getPath();
        $lastModified = filemtime($viewFile);

        $reqModifiedSince = request()->header('If-Modified-Since');
        $ifModifiedSince = strtotime($reqModifiedSince);

        $responseHeaders = [
            'Cache-Control' => "public, max-age=$ttl",
            'Last-Modified' => date(DATE_RFC822, $lastModified)
        ];

        if ($ifModifiedSince && $ifModifiedSince >= $lastModified) {
            $status = 304;
            $body = '';
        } else {
            $status = 200;
            $body = $view->render();
        }

        return response($body, $status)->withHeaders($responseHeaders);
    }
}
