<?php
// URL 라우팅 어플리케이션
class Application {
    // 컨트롤러 참조 변수
    private $controller = null;
    // 컨트롤러 내부 메소드 참조 변수
    private $action = null;
    public function __construct(){
        // 서버내에 컨트롤러 유무 값을 저장하는 변수
        $cancontrol = false;
        // 요청 된 url을 검사함
        if(isset($_GET['url'])){
            $url = $_GET['url'];
            // url의 좌측 .php를 제거한다.
            $url = rtrim($url, ".php");
            
            // (DomainName/)를 요청 할 경우
            if($url == null){
                // 컨트롤러의 index()를 호출한다.
                $this->action = "index";
            } else {
                // 그 이외의 경우에는 DomainName/***
                // ***의 이름을 가지는 메소드를 호출한다.
                $this->action = $url;
            }
            // User 컨트롤러 파일을 포함시킴
            require 'controller/User.php';
            $app = new UserController();
            // UserController 클래스 내부에 $action의 이름을 가지는 메소드가 존재하면
            if(method_exists($app, $this->action)){
                // 컨트롤러의 $action메소드를 호출함
                $app->{$this->action}();
            } else {
                echo $this->action;
            }
        }
    }
}