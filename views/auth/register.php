<?php include 'views/templates/header.php'; ?>
<h1 class="text-2xl mb-4">Registrar</h1>
<form method="POST" action="register.php" class="space-y-4">
    <input type="text" name="username" placeholder="Usuário" class="border p-2 w-full">
    <input type="password" name="password" placeholder="Senha" class="border p-2 w-full">
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Registrar</button>
</form>
<p class="mt-4">Já tem conta? <a href="index.php?action=login" class="text-blue-600">Login</a></p>
<?php include 'views/templates/footer.php'; ?>
