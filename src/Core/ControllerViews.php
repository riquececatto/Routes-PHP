<?php

namespace RiqueCecatto\Src\Core;

class ControllerViews
{
    /**
     * Function where return a data array if the Controller matched
     *
     * @param array $matchedUri
     * @param array $params
     * @return array
     */
    protected static function getController(array $matchedUri, array $params = []): array
    {
        [$controller, $method] = explode('@', array_values($matchedUri)[0]);

        $controllerWithNamespace = CONTROLLER_PATH . $controller;

        if (!class_exists($controllerWithNamespace)) {
            throw new \Exception("Don't exists the {$controller} class");
        }

        $controllerInstance = new $controllerWithNamespace();

        if (!method_exists($controllerInstance, $method)) {
            throw new \Exception("Don't exists the {$method} method in the {$controller} class");
        }

        return $controllerInstance->$method($params);
    }
}
