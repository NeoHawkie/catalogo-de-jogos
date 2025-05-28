<?php include 'views/templates/header.php'; ?>
<h1 class="text-2xl mb-4">Registrar</h1>
<form method="POST" action="index.php?action=register" class="space-y-4">
    <input type="text" name="username" placeholder="Nome de usuário" class="border p-2 w-full" required>
    <input type="text" name="name" placeholder="Nome completo" class="border p-2 w-full" required>
    <input type="email" name="email" placeholder="Email" class="border p-2 w-full" required>
    <input type="password" name="password" placeholder="Senha" class="border p-2 w-full">
    <input type="password" name="passwordConfirmation" placeholder="Confirme a senha" class="border p-2 w-full">
    <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded">Registrar</button>
</form>
<p class="mt-4">Já tem conta? <a href="index.php?action=login" class="text-blue-600">Login</a></p>
<?php include 'views/templates/footer.php'; ?>
