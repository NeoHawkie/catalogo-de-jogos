<?php //include 'views/templates/header.php'; 
?>
<div class="flex justify-between items-center mb-2">
    <h1 class="text-2xl">Meus Jogos</h1>
    <a href="dashboard.php?action=add_game" class="bg-green-500 text-white px-4 py-2 rounded">Adicionar Jogo</a>
</div>
<form action="index.php" method="GET" class="flex mb-2 py-2">
    <input type="hidden" name="action" value="dashboard">
    <input type="text" name="searchGame" placeholder="Pesquisar...">
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Go!</button>
</form>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <?php foreach ($games as $game): ?>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-xl font-bold"><?php echo htmlspecialchars($game['title']); ?></h2>
            <p class="text-gray-600"><?php echo htmlspecialchars($game['platform']); ?></p>
            <p class="text-gray-500 text-sm mt-2"><?php echo nl2br(htmlspecialchars($game['description'])); ?></p>
            <a href="index?action=delete_game&id=<?php echo $game['id']; ?>" class="block text-red-600 mt-2">Excluir</a>
        </div>
    <?php endforeach; ?>
</div>
<?php include 'views/templates/footer.php'; ?>