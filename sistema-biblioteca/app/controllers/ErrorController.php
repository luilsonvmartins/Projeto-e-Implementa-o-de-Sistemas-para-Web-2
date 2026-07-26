<?php
class ErrorController extends Controller {
    public function notFound(?string $p = null): void {
        http_response_code(404);
        $this->view('errors/404', ['titulo'=>'Página não encontrada']);
    }
}
