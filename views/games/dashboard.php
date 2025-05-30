

<div class="flex justify-between items-center mb-2">
    <h1 class="mb-2 text-2xl">Meus Jogos</h1>
    <a href="dashboard.php?action=add_game" class="bg-green-700 hover:bg-green-800 text-white px-2 py-1 rounded">Adicionar Jogo</a>
</div>
<div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 "> 
    <?php foreach ($games as $game): ?>
        <div class="justify-self-center bg-white w-[275px] p-4 shadow rounded">
            <h2 class="text-xl font-bold"><?php echo htmlspecialchars($game['title']); ?></h2>
            <p class="w-[240px] h-[360px] overflow-hidden">
                <img src="uploads\gameCovers\<?= $game['cover']; ?>" alt="<?= $game['cover']; ?>"
                    class="w-full h-full object-cover"
                    onerror="this.src='uploads/gameCovers/defaultCover.jpg'">
            </p>
            <p class="text-gray-600"><?php echo htmlspecialchars($game['platform']); ?></p>
            <p class="text-gray-500 text-sm mt-2"><?php echo nl2br(htmlspecialchars($game['description'])); ?></p>
            <div class="flex justify-between">
                <a href="index?action=edit_game&id=<?= $game['id']; ?>" class="block text-blue-600 mt-2">Editar</a>
                <a href="index?action=delete_game&id=<?= $game['id']; ?>" class="block text-red-600 mt-2">Excluir</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include 'views/templates/footer.php'; ?>
