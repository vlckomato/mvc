<?

class Core {

    public function __construct(){
        $this->getUrl();
    }

    public function getUrl() {
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            var_dump($url[0]);
        }
    }

}