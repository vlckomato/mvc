<?

class Router
{
    private $routes = [];
    private $url = '';
    private $controller = '';
    private $method = '';
    private $params = [];

    private $pattern = array(
        '/\[\:id\]/' => '([0-9]+)',
        '/\[\:name\]/' => '([a-zA-Z_-]+)'
    );

    public function __construct()
    {
        $this->url = $this->getUrl();
    }

    public function getUrl()
    {
        if (isset($_GET['path'])) {
            $url = filter_var('/' . $_GET['path'], FILTER_SANITIZE_URL);
            return rtrim($url, '/');
        } else {
            return '/';
        }
    }
    public function get($name, $method)
    {
        $name = preg_replace(array_keys($this->pattern), array_values($this->pattern), $name);
        $this->routes[$name] = $method;
    }

    public function notFound()
    {
        http_response_code(400);
        include('../app/view/404.php');
        exit();
    }
    public function init()
    {
        foreach ($this->routes as $route => $method) {
            if (preg_match('@^' . $route . '$@', $this->url, $match)) {
                $list = explode('@', $this->routes[$route]);
                $this->controller = $list[0];
                $this->method = $list[1];

                if (count($match) > 1) {
                    unset($match[0]);
                    $this->params = $match;

                }
            }
        }


        if (!file_exists('../app/controller/' . ucfirst($this->controller) . '.php')) {

            $this->notFound();

        } else {

            require_once '../app/controller/' . $this->controller . '.php';

            $this->controller = new $this->controller;

        }

        if (!method_exists($this->controller, $this->method)) {

            $this->notFound();

        } else {
            call_user_func_array(array($this->controller, $this->method), array_values($this->params));

        }
    }
}