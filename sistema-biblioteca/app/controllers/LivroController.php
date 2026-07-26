<?php
class LivroController extends Controller {

    public function index(?string $param = null): void {
        requireLogin();
        $livro     = new Livro();
        $livros    = $livro->todos();
        $this->render('livros/index', ['titulo' => 'Acervo de Livros', 'livros' => $livros]);
    }

    public function criar(?string $param = null): void {
        requireLogin();
        $categoria  = new Categoria();
        $autor      = new Autor();
        $this->render('livros/form', [
            'titulo'     => 'Cadastrar Livro',
            'livro'      => null,
            'categorias' => $categoria->todos(),
            'autores'    => $autor->todos(),
        ]);
    }

    public function salvar(?string $param = null): void {
        requireLogin();

        // Validação básica
        $erros = [];
        if (empty($_POST['titulo']))    $erros[] = 'Título é obrigatório.';
        if (empty($_POST['qtd_total'])) $erros[] = 'Quantidade é obrigatória.';

        if ($erros) {
            setFlash('erro', implode(' | ', $erros));
            redirect('livro/criar');
        }

        // Upload de capa
        $capa = null;
        if (!empty($_FILES['capa']['name'])) {
            $ext   = strtolower(pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION));
            $allow = ['jpg','jpeg','png','gif','webp'];
            if (!in_array($ext, $allow)) {
                setFlash('erro', 'Formato de imagem inválido. Use JPG, PNG ou GIF.');
                redirect('livro/criar');
            }
            $capa = uniqid('capa_') . '.' . $ext;
            $dest = ROOT . '/public/uploads/capas/' . $capa;
            if (!move_uploaded_file($_FILES['capa']['tmp_name'], $dest)) {
                setFlash('erro', 'Falha ao fazer upload da capa.');
                redirect('livro/criar');
            }
        }

        $livroModel = new Livro();
        $ok = $livroModel->inserir([
            'titulo'       => trim($_POST['titulo']),
            'isbn'         => trim($_POST['isbn']         ?? ''),
            'ano'          => trim($_POST['ano']          ?? ''),
            'sinopse'      => trim($_POST['sinopse']      ?? ''),
            'qtd_total'    => (int)$_POST['qtd_total'],
            'id_categoria' => $_POST['id_categoria']      ?: null,
            'capa'         => $capa,
        ]);

        if ($ok) {
            $idLivro = $livroModel->ultimoId();
            if (!empty($_POST['autores'])) {
                $livroModel->vincularAutores($idLivro, $_POST['autores']);
            }
            setFlash('sucesso', 'Livro cadastrado com sucesso!');
        } else {
            setFlash('erro', 'Erro ao cadastrar livro. Tente novamente.');
        }
        redirect('livro/index');
    }

    public function show(?string $id = null): void {
        requireLogin();
        $livroModel = new Livro();
        $livro = $livroModel->porId((int)$id);
        if (!$livro) { setFlash('erro','Livro não encontrado.'); redirect('livro/index'); }
        $this->render('livros/show', ['titulo' => $livro['titulo'], 'livro' => $livro]);
    }

    public function editar(?string $id = null): void {
        requireLogin();
        $livroModel = new Livro();
        $livro = $livroModel->porId((int)$id);
        if (!$livro) { setFlash('erro','Livro não encontrado.'); redirect('livro/index'); }
        $categoria = new Categoria(); $autor = new Autor();
        $this->render('livros/form', [
            'titulo'     => 'Editar Livro',
            'livro'      => $livro,
            'categorias' => $categoria->todos(),
            'autores'    => $autor->todos(),
        ]);
    }

    public function atualizar(?string $param = null): void {
        requireLogin();
        if (empty($_POST['titulo'])) { setFlash('erro','Título obrigatório.'); redirect('livro/index'); }
        $livroModel = new Livro();
        $ok = $livroModel->atualizar((int)$_POST['id'], $_POST);
        setFlash($ok ? 'sucesso' : 'erro', $ok ? 'Livro atualizado!' : 'Erro ao atualizar.');
        redirect('livro/index');
    }

    public function deletar(?string $id = null): void {
        requireLogin();
        $livroModel = new Livro();
        $ok = $livroModel->deletar((int)$id);
        setFlash($ok ? 'sucesso' : 'erro', $ok ? 'Livro removido!' : 'Erro ao remover.');
        redirect('livro/index');
    }
}
