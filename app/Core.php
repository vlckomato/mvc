<?

class Core {

    public static $routes = [];
    private $currentUrl = '';
    protected $controller = '';
    protected $method = '';
    protected $params = [];

    public function __construct(){

        $this->currentUrl = $this->getUrl();

    
    }

    public function getUrl() {

        $url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);

    
        if( $url === '/' ){

            return '/';

        } else {
            
            return rtrim($url, '/');

    }
}


    public static function get($name, $method) {

        self::$routes[$name] = $method;

    }    

    public function staticValue() {
        return self::$routes;
    }

    public function init() {

        foreach(self::$routes as $route => $method) {
            
            if(preg_match('/\{(.+)\}/', $route, $arr)) {
                $pattern = 
            }
        }

        if(array_key_exists($this->currentUrl, self::$routes)) {
            $arr = explode('@',self::$routes[$this->currentUrl]);
            $this->controller = $arr[0];
            $this->method = $arr[1];
        } else {


        }



        if(file_exists('../app/controller/'. ucfirst($this->controller) .'.php')){

            require_once '../app/controller/'. $this->controller .'.php';

            $this->controller = new $this->controller;

    } else ( die('Controller dont exists') );

    if(method_exists($this->controller, $this->method)) {

        call_user_func_array(array($this->controller,$this->method), []);
            
    } else {

        die('Method not exist');
    }
    }}