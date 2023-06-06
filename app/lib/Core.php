<?

class Router {

    private $routes = [];
    private $url = '';
    private $controller = '';
    private $method = 'index';
    private $params = [];

    public  $pattern = array(
        '/\[\:id\]/' => '([0-9]+)',
        '/\[\:name\]/' => '([a-zA-Z]+)' 
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
    $name = preg_replace(array_keys($this->pattern), array_values($this->pattern), $name);
        
        $this->routes[$name] = $method;
        
    }    

    public function notFound() {

    }

    public function init() {

    foreach($this->routes as $route => $method) {

            
            if(preg_match('@^'.$route.'$@', $this->url, $match)) {
               //var_dump($match);
                $list = explode('@',$this->routes[$route]);
                $this->controller = $list[0];
                $this->method = $list[1];
                
                if(count($match)>1){
                    unset($match[0]);
                    var_dump($match);
                    $this->params = $match;
               
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