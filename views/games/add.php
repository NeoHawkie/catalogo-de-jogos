<?php //include 'views/templates/header.php'; ?>
<h1 class="text-2xl mb-4">Adicionar Jogo</h1>
<form method="POST" action="index.php?action=add_game" class="space-y-4">
    <input type="text" name="title" placeholder="Título" class="border p-2 w-full">
    <input type="text" name="platform" placeholder="Plataforma" class="border p-2 w-full">
    <input type="text" name="exe_path" placeholder="Caminho do Executável" class="border p-2 w-full">
    <textarea name="description" placeholder="Descrição" class="border p-2 w-full"></textarea>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Adicionar</button>
</form>
<?php include 'views/templates/footer.php'; ?>
