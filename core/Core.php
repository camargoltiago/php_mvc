<?php
class Core
{
    public function run()
    {
        $url = '/';
        $currentController = 'HomeController';
        $currentAction = 'index';
        $params = [];

        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }

        $url = $this->checkRoutes($url);

        if (!empty($url) && $url != '/') {
            $url = explode('/', $url);
            array_shift($url);

            if (isset($url[0]) && !empty($url[0])) {
                $currentController = ucfirst($url[0]) . 'Controller';
                array_shift($url);
            }

            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            }

            if (count($url) > 0) {
                $params = $url;
            }
        }

        if (
            file_exists('controllers/' . $currentController . '.php') ||
            !method_exists($currentController, $currentAction)
        ) {
            $currentController = 'NotFoundController';
            $currentAction = 'index';
        }

        $controller = new $currentController();

        call_user_func_array([$controller, $currentAction], $params);
    }

    public function checkRoutes($url)
    {
        global $routes;

        foreach ($routes as $routesKey => $route) {

            // Identify arguments and replace for regex
            $pattern = preg_replace('(\{[a-z0-9]{1,}\})', '([a-z0-9-]{1,})', $routesKey);

            // URL Match
            if (preg_match('#^(' . $pattern . ')*$#i', $url, $matches) === 1) {
                array_shift($matches);
                array_shift($matches);

                // get all arguments for association
                $itens = [];
                if (preg_match_all('(\{[a-z0-9]{1,}\})', $routesKey, $m)) {
                    $itens = preg_replace('(\{|\})', '', $m[0]);
                }

                // Make the association
                $args = [];
                foreach ($matches as $matchesKey => $match) {
                    $args[$itens[$matchesKey]] = $match;
                }

                // Mount new URL
                foreach ($args as $argsKey => $argvalue) {
                    $route = str_replace(':' . $argsKey, $argvalue, $route);
                }

                $url = $route;

                break;
            }
        }

        return $url;
    }
}
