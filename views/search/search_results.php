<?php include 'views/templates/header.php'; ?>

<?php
// Defaults
$filter = $_GET['filter'] ?? 'all'; // 'all', 'games', 'users'
$page = max(1, intval($_GET['page'] ?? 1));
$limit = 10;
$offset = ($page - 1) * $limit;
$query = htmlspecialchars($_GET['q'] ?? '');
?>

<div class="max-w-5xl mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Resultados da busca por: "<?= $query ?>"</h1>

    <!-- Filtros -->
    <div class="mb-4 flex gap-2">
        <a href="index.php?action=search&q=<?= $query ?>&filter=all" class="px-4 py-2 border rounded <?= $filter === 'all' ? 'bg-green-600 text-white' : 'bg-gray-100' ?>">Todos</a>
        <a href="index.php?action=search&q=<?= $query ?>&filter=games" class="px-4 py-2 border rounded <?= $filter === 'games' ? 'bg-green-600 text-white' : 'bg-gray-100' ?>">Jogos</a>
        <a href="index.php?action=search&q=<?= $query ?>&filter=users" class="px-4 py-2 border rounded <?= $filter === 'users' ? 'bg-green-600 text-white' : 'bg-gray-100' ?>">Usuários</a>
    </div>

    <!-- Resultados -->
    <?php if ($filter === 'all' || $filter === 'games'): ?>
        <h2 class="text-xl font-bold mb-2">Jogos</h2>
        <?php if (!empty($games)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <?php foreach (array_slice($games, $offset, $limit) as $game): ?>
                    <div class="p-4 bg-white border rounded shadow flex">
                        <a href="index.php?action=view_game&id=<?= $game['id'] ?>">
                            <div class="flex justify-center">
                                <img src="uploads/gameCovers/<?= $game['cover'] ?>" alt="Capa do jogo"
                                    class="w-24 h-24 object-cover rounded"
                                    onerror="this.src='uploads/gameCovers/defaultCover.jpg'">
                            </div>
                        </a>
                        <div>
                            <h3 class="px-1 text-lg font-bold"><?= htmlspecialchars($game['title']) ?></h3>
                            <p class="px-1 text-sm text-gray-600"><?= htmlspecialchars($game['platform']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500 mb-6">Nenhum jogo encontrado.</p>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($filter === 'all' || $filter === 'users'): ?>
        <h2 class="text-xl font-bold mb-2">Usuários</h2>
        <?php if (!empty($users)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach (array_slice($users, $offset, $limit) as $user): ?>
                    <div class="flex p-4 bg-white border rounded shadow">
                        <img src="uploads/profilePictures/<?= $user['profile_picture'] ?? 'defaultProfilePicture.jpg' ?>" alt="Avatar" class="align-middle w-12 h-12 rounded-full object-cover mr-4">
                        <div>
                            <h3 class="text-lg font-bold"><?= htmlspecialchars($user['username']) ?></h3>
                            <p class="text-sm text-gray-600"><?= htmlspecialchars($user['email']) ?></p>
                            <a href="index.php?action=profile&user=<?= urlencode($user['username']) ?>" class="text-green-600 text-sm">Ver perfil</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">Nenhum usuário encontrado.</p>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Paginação -->
    <?php
    $totalResults = ($filter === 'games') ? count($games)
        : (($filter === 'users') ? count($users)
            : (count($games) + count($users)));

    $totalPages = ceil($totalResults / $limit);
    ?>
    <?php if ($totalPages > 1): ?>
        <div class="mt-8 flex justify-center space-x-2">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="index.php?action=search&q=<?= urlencode($query) ?>&filter=<?= $filter ?>&page=<?= $i ?>"
                    class="px-3 py-1 rounded border <?= $page == $i ? 'bg-green-600 text-white' : 'bg-gray-100' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'views/templates/footer.php'; ?>