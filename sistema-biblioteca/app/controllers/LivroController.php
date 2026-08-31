<?php
class LivroController extends Controller {

    public function index(?string $p = null): void {
        requireLogin();
        $m = new Livro();
        $this->render('livros/index', ['titulo'=>'Acervo de Livros','livros'=>$m->todos()]);
    }

    public function criar(?string $p = null): void {
        requireLogin();
        $this->render('livros/form', [
            'titulo'     => 'Cadastrar Livro',
            'livro'      => null,
            'erros'      => [],
            'categorias' => (new Categoria())->todos(),
            'autores'    => (new Autor())->todos(),
        ]);
    }

    public function salvar(?string $p = null): void {
        requireLogin();
        $m     = new Livro();
        $erros = $m->validar($_POST);

        // Validação do upload
        $capa = null;
        if (!empty($_FILES['capa']['name'])) {
            $ext   = strtolower(pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION));
            $allow = ['jpg','jpeg','png','gif','webp'];
            if (!in_array($ext, $allow)) $erros[] = 'Formato de imagem inválido. Use JPG, PNG, GIF ou WebP.';
            elseif ($_FILES['capa']['size'] > 2 * 1024 * 1024) $erros[] = 'Imagem deve ter no máximo 2MB.';
            else {
                $capa = uniqid('capa_') . '.' . $ext;
                if (!move_uploaded_file($_FILES['capa']['tmp_name'], ROOT.'/public/uploads/capas/'.$capa)) {
                    $erros[] = 'Falha ao fazer upload da capa.';
                    $capa = null;
                }
            }
        }

        if ($erros) {
            $this->render('livros/form', [
                'titulo'     => 'Cadastrar Livro',
                'livro'      => $_POST,
                'erros'      => $erros,
                'categorias' => (new Categoria())->todos(),
                'autores'    => (new Autor())->todos(),
            ]);
            return;
        }

        $ok = $m->inserir(array_merge($_POST, ['capa' => $capa]));
        if ($ok && !empty($_POST['autores'])) {
            $m->vincularAutores($m->ultimoId(), $_POST['autores']);
        }
        setFlash($ok ? 'sucesso' : 'erro', $ok ? '✅ Livro cadastrado com sucesso!' : '❌ Erro ao cadastrar livro.');
        redirect('livro/index');
    }

    public function editar(?string $id = null): void {
        requireLogin();
        $m     = new Livro();
        $livro = $m->porId((int)$id);
        if (!$livro) { setFlash('erro','Livro não encontrado.'); redirect('livro/index'); }
        $this->render('livros/form', [
            'titulo'     => 'Editar Livro',
            'livro'      => $livro,
            'erros'      => [],
            'categorias' => (new Categoria())->todos(),
            'autores'    => (new Autor())->todos(),
        ]);
    }

    public function atualizar(?string $p = null): void {
        requireLogin();
        $id    = (int)($_POST['id'] ?? 0);
        $m     = new Livro();
        $erros = $m->validar($_POST);

        // Upload de nova capa (opcional)
        $novaCapa = null;
        if (!empty($_FILES['capa']['name'])) {
            $ext   = strtolower(pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION));
            $allow = ['jpg','jpeg','png','gif','webp'];
            if (!in_array($ext, $allow)) $erros[] = 'Formato de imagem inválido.';
            elseif ($_FILES['capa']['size'] > 2 * 1024 * 1024) $erros[] = 'Imagem deve ter no máximo 2MB.';
            else {
                $novaCapa = uniqid('capa_') . '.' . $ext;
                if (!move_uploaded_file($_FILES['capa']['tmp_name'], ROOT.'/public/uploads/capas/'.$novaCapa)) {
                    $erros[] = 'Falha ao fazer upload da capa.';
                    $novaCapa = null;
                }
            }
        }

        if ($erros) {
            $livro = array_merge($m->porId($id) ?? [], $_POST);
            $this->render('livros/form', [
                'titulo'     => 'Editar Livro',
                'livro'      => $livro,
                'erros'      => $erros,
                'categorias' => (new Categoria())->todos(),
                'autores'    => (new Autor())->todos(),
            ]);
            return;
        }

        $dados = $_POST;
        if ($novaCapa) $dados['capa'] = $novaCapa;

        $ok = $m->atualizar($id, $dados);
        if ($ok && isset($_POST['autores'])) {
            $m->vincularAutores($id, $_POST['autores']);
        }
        setFlash($ok ? 'sucesso' : 'erro', $ok ? '✅ Livro atualizado com sucesso!' : '❌ Erro ao atualizar livro.');
        redirect('livro/index');
    }

    public function deletar(?string $id = null): void {
        requireLogin();
        $m  = new Livro();
        $ok = $m->deletar((int)$id);
        setFlash($ok ? 'sucesso' : 'erro', $ok ? '✅ Livro removido com sucesso!' : '❌ Erro ao remover livro.');
        redirect('livro/index');
    }

    public function show(?string $id = null): void {
        requireLogin();
        $m     = new Livro();
        $livro = $m->porId((int)$id);
        if (!$livro) { setFlash('erro','Livro não encontrado.'); redirect('livro/index'); }
        $this->render('livros/show', ['titulo'=>$livro['titulo'],'livro'=>$livro]);
    }
}
