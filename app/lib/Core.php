<?

class Router {

    private $routes = [];
    private $url = '';
    private $controller = '';
    private $method = 'index';
    private $params = [];

    public  $pattern = array(
        '[:id]' => '[0-9]+',
        '[:name]' => '[a-zA-Z]+' 
    );

    public function __construct(){

        $this->url = $this->getUrl();

    }

    public function getUrl() {

        if (isset($_GET['path'])) {
            $url = filter_var('/'.$_GET['path'], FILTER_SANITIZE_URL);
            return rtrim($url, '/');
        } else {
            return '/';
        }
}


    public function get($name, $method) {
        foreach($this->pattern as $key => $value) {
            $name = preg_replace('/'.preg_quote($key).'/', $value, $name);
        }
        $this->routes[preg_quote($name)] = $method;
        var_dump($this->routes);
    }    

    public function notFound() {

    }

    public function init() {

    foreach($this->routes as $route => $method) {
        echo $route;
            
            if(preg_match('/'.$route.'/', $this->url, $match)) {

                $list = explode('@',$this->routes[$route]);
                $this->controller = $list[0];
                $this->method = $list[1];
                
                if(count($match)>1){

                    $this->params = array_filter($match, function ($arrayItem) { return is_string($arrayItem);},ARRAY_FILTER_USE_KEY);
               
                }
            }
        }


        if(file_exists('../app/controller/'. ucfirst($this->controller) .'.php')){

            require_once '../app/controller/'. $this->controller .'.php';

            $this->controller = new $this->controller;

    } else ( die('Page dont exists') );

    if(method_exists($this->controller, $this->method)) {
        
        call_user_func_array(array($this->controller,$this->method), array_values($this->params));

        
    } else {
        die('Method not exist');
    }
    }};