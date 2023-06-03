<?

class Core {

    protected $controller;
    protected $method;
    protected $params;

    public function __construct(){

        $url = $this->getUrl();

        $this->controller = $url[0] ?? 'page';
        $this->method = $url[1] ?? 'index';
        $this->params = $url[2] ?? '';

        if(file_exists('../app/controller/'. ucfirst($this->controller) .'.php')){

            require_once '../app/controller/'. $this->controller .'.php';

            $this->controller = new $this->controller;
        }
    
    }

    public function getUrl() {
        $url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        if(isset($url)){
            $pattern = '/\/?([a-z0-9]+)/';
            preg_match_all($pattern,$url,$array);
            return $array[1];
        }
    }

}