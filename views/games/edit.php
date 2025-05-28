<?php //include 'views/templates/header.php'; 


?>
<h1 class="text-2xl mb-4">Editar dados do jogo</h1>
<form method="POST" action="index.php?action=edit_game" class="space-y-4" enctype="multipart/form-data">
    <input hidden type="text" name="id" value="<?=$_GET['id'];?>">
    <input type="text" name="title" placeholder="Título" class="border p-2 w-full" value="<?= htmlspecialchars($game['title']) ?>" required>
    <div class="border p-2 bg-white text-gray-400">
        <label for="cover">Capa</label>
        <input type="file" name="cover">
    </div>
    <input type="text" name="platform" value="<?= htmlspecialchars($game['platform']) ?>" placeholder="Plataforma" class="border p-2 w-full" required>
    <input type="text" name="exe_path" placeholder="Caminho do Executável" class="border p-2 w-full">
    <textarea name="description" value="<?= htmlspecialchars($game['description']) ?>" placeholder="Descrição" class="border p-2 w-full" ></textarea>
    <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded">Salvar</button>
</form>
<?php include 'views/templates/footer.php'; ?>