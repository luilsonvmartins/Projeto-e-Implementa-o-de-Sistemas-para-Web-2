<?php
abstract class Controller {
    protected function view(string $view, array $data = []): void {
        extract($data);
        $file = APP . '/views/' . str_replace('.','/',$view) . '.php';
        if (!file_exists($file)) die("View não encontrada: {$file}");
        require_once $file;
    }
    protected function render(string $view, array $data = []): void {
        $data['content_view'] = $view;
        $this->view('layout/app', $data);
    }
}
