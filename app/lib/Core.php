<?

class Router {

    private $routes = [];
    private $url = '';
    private $controller = '';
    private $method = 'index';
    private $params = [];

    public  $pattern = array(
        '[:id]' => '[0-9]+',
        '[:name]' => '[a-z]+' 
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
        if (preg_match_all('/\/([a-z]+)\/(?=(\[:[a-z]+\]))/',$name, $match)) {
        
                for($i = 0;$i < count($match[0]);$i++) {
                
                    $replacement = '(?<'.$match[1][$i].'>'.$this->pattern[$match[2][$i]].')';
                    $name = str_replace([$match[2][$i]], [$replacement], $name);
                    
                } 
        }
        $name = str_replace('/', '\/', $name);
        $this->routes[$name] = $method;

    }    

    public function init() {

    foreach($this->routes as $route => $method) {
            
            if(preg_match('/^'.$route.'$/', $this->url, $match)) {

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