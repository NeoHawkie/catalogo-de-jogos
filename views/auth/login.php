<?php if (!empty($error)): ?>
    <script>
        alert("<?= $error ?>");
    </script>
<?php endif; ?>

<?php include 'views/templates/header.php'; ?>
<h1 class="text-2xl mb-4">Login</h1>
<form method="POST" action="login.php" class="space-y-4">
    <input type="text" name="username" placeholder="Usuário" class="border p-2 w-full">
    <input type="password" name="password" placeholder="Senha" class="border p-2 w-full">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Entrar</button>
</form>
<p class="mt-4">Não tem conta? <a href="index.php?action=register" class="text-blue-600">Registrar</a></p>
<?php include 'views/templates/footer.php'; ?>