<?php
/**
 * Controller.php — Controller base (classe pai de todos os controllers)
 */

abstract class Controller
{
    /**
     * Renderiza uma view passando variáveis para ela.
     *
     * @param string $view   Caminho da view: 'livros/index' ou 'layout/header'
     * @param array  $data   Variáveis disponíveis na view
     */
    protected function view(string $view, array $data = []): void
    {
        // Extrai o array como variáveis locais
        extract($data);

        $file = APP . '/views/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($file)) {
            die("View não encontrada: {$file}");
        }

        require_once $file;
    }

    /**
     * Renderiza view com layout completo (header + content + footer).
     */
    protected function render(string $view, array $data = []): void
    {
        $data['content_view'] = $view;
        $this->view('layout/app', $data);
    }
}
