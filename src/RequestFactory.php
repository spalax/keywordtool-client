<?php
namespace KWTClient;

use KWTClient\Request\Request;

class RequestFactory
{
    /**
     * @param string $keyword
     *
     * @return Request
     */
    public static function google($keyword)
    {
        return new Request($keyword, 'http://api.keywordtool.io/v1/search/google');
    }

    /**
     * @param string $keyword
     *
     * @return Request
     */
    public static function youtube($keyword)
    {
        return new Request($keyword, 'http://api.keywordtool.io/v1/search/youtube');
    }

    /**
     * @param string $keyword
     *
     * @return Request
     */
    public static function bing($keyword)
    {
        return new Request($keyword, 'http://api.keywordtool.io/v1/search/bing');
    }

    /**
     * @param string $keyword
     *
     * @return Request
     */
    public static function appstore($keyword)
    {
        return new Request($keyword, 'http://api.keywordtool.io/v1/search/app-store');
    }
}
