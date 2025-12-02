<?php
// views/contacts-list.php
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Contatos</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .flash { padding: 10px; margin-bottom: 10px; border-radius: 4px; }
        .success { background:#e6ffed; border:1px solid #b7f0c9; color:#0a5c2d }
        .error { background:#ffe6e6; border:1px solid #f0b7b7; color:#700 }
        table { width:100%; border-collapse:collapse; margin-top:10px }
        th, td { padding:8px; border:1px solid #ddd; text-align:left }
        .top-controls { display:flex; gap:8px; align-items:center }
        .search { margin-left:auto }
        .actions a { margin-right:8px }
        .pagination { margin-top:12px }
        .page-link { margin-right:6px }
    </style>
</head>
<body>

    <h1>Contatos</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="flash success"><?=htmlspecialchars($_SESSION['success'])?></div>
        <?php unset($_SESSION['success']); endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="flash error"><?=htmlspecialchars($_SESSION['error'])?></div>
        <?php unset($_SESSION['error']); endif; ?>

    <div class="top-controls">
        <a href="/create">Novo contato</a>
        <form method="GET" action="/" class="search" style="display:flex;align-items:center;">
            <input type="text" name="q" placeholder="Buscar..." value="<?=htmlspecialchars($_GET['q'] ?? '')?>">
            <button>Buscar</button>
        </form>

        <form method="GET" action="/export">
            <input type="hidden" name="q" value="<?=htmlspecialchars($_GET['q'] ?? '')?>">
            <button type="submit">Exportar CSV</button>
        </form>
    </div>

    <table>
        <thead>
            <tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Ações</th></tr>
        </thead>
        <tbody>
            <?php if (empty($contacts)): ?>
                <tr><td colspan="5">Nenhum contato encontrado.</td></tr>
            <?php else: ?>
                <?php foreach ($contacts as $c): ?>
                    <tr>
                        <td><?=htmlspecialchars($c['id'])?></td>
                        <td><?=htmlspecialchars($c['name'])?></td>
                        <td><?=htmlspecialchars($c['email'])?></td>
                        <td><?=htmlspecialchars($c['phone'])?></td>
                        <td class="actions">
                            <a href="/edit/<?=intval($c['id'])?>">Editar</a>
                            <a href="/delete/<?=intval($c['id'])?>" onclick="return confirm('Remover contato?')">Remover</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php
        $current = $result['page'] ?? 1;
        $pages = $result['pages'] ?? 1;
        $q = urlencode($_GET['q'] ?? '');
        for ($p = 1; $p <= $pages; $p++): ?>
            <a class="page-link" href="/?page=<?=$p?><?= $q ? '&q='.$q : ''?>" <?= $p == $current ? 'style="font-weight:bold"' : ''?>><?=$p?></a>
        <?php endfor; ?>
    </div>

</body>
</html>
