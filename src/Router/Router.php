<?php

namespace RiqueCecatto\Src\Router;

class Router extends \RiqueCecatto\Src\Core\ControllerViews
{
    private function __construct()
    {
    }

    /**
     * Function where get the data if the uri matches
     *
     * @return array
     */
    public static function getRouter(): array
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $routes = require_once('routes.php');

        $matchedUri = self::regularExpressionMatchedUri($uri, $routes[$requestMethod]);

        $params = array();
        if (!empty($matchedUri)) {
            $params = self::getParamFromUri($uri, $matchedUri);
        }

        if (empty($matchedUri)) {
            $matchedUri = self::notFoundMatchedUri();
        }

        return \RiqueCecatto\Src\Core\ControllerViews::getController($matchedUri, $params);
    }

    /**
     * Function where it compares the uri with a regular expression
     *
     * @param string $uri
     * @param array $routes
     * @return array|null
     */
    private static function regularExpressionMatchedUri(string $uri, array $routes): ?array
    {
        return array_filter(
            $routes,
            fn ($value) => preg_match("~^{$value}$~", $uri),
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * Function where return as exception string if the uri doesn't mathed
     *
     * @return array
     */
    private static function notFoundMatchedUri(): array
    {
        return ['ExceptionController@index'];
    }

    /**
     * Function where return the params of uri
     *
     * @param string $uri
     * @param array $matchedUri
     * @return void
     */
    private static function getParamFromUri(string $uri, array $matchedUri)
    {
        $uri = explode('/', ltrim($uri, '/'));
        $matchedUri = array_keys($matchedUri)[0];
        $matchedUri = explode('\/', ltrim($matchedUri, '\/'));

        return array_diff($uri, $matchedUri);
    }
}
