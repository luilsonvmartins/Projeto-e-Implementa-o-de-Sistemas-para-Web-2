<?php
/**
 * HomeController.php — Página inicial do sistema
 */

class HomeController extends Controller
{
    public function index(?string $param = null): void
    {
        $this->render('home/index', [
            'titulo' => 'Início — ' . APP_NAME,
        ]);
    }
}
