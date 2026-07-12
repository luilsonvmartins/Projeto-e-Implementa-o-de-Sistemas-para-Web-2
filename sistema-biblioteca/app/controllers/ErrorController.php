<?php
class ErrorController extends Controller
{
    public function notFound(?string $param = null): void
    {
        http_response_code(404);
        $this->view('errors/404', ['titulo' => 'Página não encontrada']);
    }
}
