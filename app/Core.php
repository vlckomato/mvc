<?

class Core {

    public static $routes = [];
    private $currentUrl = '';
    protected $controller = '';
    protected $method = '';
    protected $params = [];

    protected $pattern = array();

    public function __construct(){

        $this->currentUrl = $this->getUrl();

    
    }

    public function getUrl() {

        if (isset($_GET['path'])) {
            $url = filter_var('/'.$_GET['path'], FILTER_SANITIZE_URL);
            return rtrim($url, '/');
        } else {
            return '/';
        }
}


    public static function get($name, $method) {

        if (preg_match_all('/\[:([a-z]+)\]/',$name, $arr)) {
            
    
                for($i = 0;$i < count($arr[0]);$i++) {
                    $replacement = '(?<'.$arr[1][$i].'>[0-9]+)';
                    $name = str_replace([$arr[0][$i], '/'], [$replacement, '\/'], $name);
                } 

                self::$routes[$name] = $method;


           /*  $replacement = '(?<'.$arr[1].'>[0-9]+)';
            $name = str_replace([$arr[0], '/'], [$replacement, '\/'], $name);
            self::$routes[$name] = $method; */
        }

        self::$routes[$name] = $method;



    }    

    public function staticValue() {
        return self::$routes;
    }

    public function init() {

    /*     foreach(self::$routes as $route => $method) {
            
            if(preg_match('/\{(.+)\}/', $route, $arr)) {
               
            }
        } */

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