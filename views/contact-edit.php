<?php
// views/contact-edit.php
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Contato</title>
</head>
<body>
    <h1>Editar Contato</h1>

    <?php if (!empty($errors)): ?>
        <div class="flash error" style="color:#700">
            <?php foreach ($errors as $e): ?>
                <div><?=htmlspecialchars($e)?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/update/<?=intval($contact['id'])?>">
        <div>
            <label>Nome</label><br>
            <input type="text" name="name" value="<?=htmlspecialchars($_POST['name'] ?? $contact['name'])?>">
        </div>
        <div>
            <label>E-mail</label><br>
            <input type="email" name="email" value="<?=htmlspecialchars($_POST['email'] ?? $contact['email'])?>">
        </div>
        <div>
            <label>Telefone</label><br>
            <input type="text" name="phone" value="<?=htmlspecialchars($_POST['phone'] ?? $contact['phone'])?>">
        </div>
        <button type="submit">Atualizar</button>
    </form>

    <p><a href="/">Voltar</a></p>
</body>
</html>
