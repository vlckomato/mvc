<?

class Core {

    public static $routes = [];
    private $currentUrl = '';
    protected $controller = '';
    protected $method = '';
    protected $params = [];

    public static $pattern = array(
        '[:id]' => '[0-9]+',
        '[:name]' => '[a-z]+' 
    );

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
        if (preg_match_all('/\/([a-z]+)\/(?=(\[:[a-z]+\]))/',$name, $arr)) {
           
            //var_dump($arr);
                for($i = 0;$i < count($arr[0]);$i++) {
                
                    $replacement = '(?<'.$arr[1][$i].'>'.self::$pattern[$arr[2][$i]].')';
                    $name = str_replace([$arr[2][$i]], [$replacement], $name);
                    
                } 
        }
        $name = str_replace('/', '\/', $name);
        self::$routes[$name] = $method;

    }    

    public function staticValue() {
        return self::$routes;
    }

    public function filterArrayKeys($key) {
        return is_string($key);
    }

    public function init() {

    foreach(self::$routes as $route => $method) {
            
            if(preg_match('/^'.$route.'$/', $this->currentUrl, $arr)) {

                $methods = explode('@',self::$routes[$route]);
                $this->controller = $methods[0];
                $this->method = $methods[1];
                var_dump($arr);
                if(count($arr)>1){

                    $this->params = array_filter($arr, function ($arrayItem) { return is_string($arrayItem);},ARRAY_FILTER_USE_KEY);
                   
                }
            }
        }


        if(file_exists('../app/controller/'. ucfirst($this->controller) .'.php')){

            require_once '../app/controller/'. $this->controller .'.php';

            $this->controller = new $this->controller;

    } else ( die('Controller dont exists') );

    if(method_exists($this->controller, $this->method)) {

        call_user_func_array(array($this->controller,$this->method), $this->params);
            
    } else {
        die('Method not exist');
    }
    }}