<?php
class HomeController extends Controller {
    public function index(?string $p = null): void {
        requireLogin();
        $this->render('home/index', ['titulo'=>'Início — '.APP_NAME]);
    }
}
