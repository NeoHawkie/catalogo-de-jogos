<?php include 'views/templates/header.php'; ?>

<div class="max-w-4xl mx-auto py-8">
    <!-- Título do Jogo -->
    <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($game['title']) ?></h1>

    <!-- Imagem e Detalhes -->
    <div class="flex flex-col md:flex-row gap-6">
        <div class="w-full md:w-1/3">
            <img src="uploads/gameCovers/<?= htmlspecialchars($game['cover']) ?>" alt="Capa do jogo" class="rounded shadow w-full object-cover h-64">
        </div>

        <div class="w-full md:w-2/3 space-y-2">
            <p><strong>Plataforma:</strong> <?= htmlspecialchars($game['platform']) ?></p>
            <p><strong>Descrição:</strong> <?= nl2br(htmlspecialchars($game['description'])) ?></p>
            <p><strong>Adicionado por:</strong>
                <a href="index.php?action=perfil&user=<?= urlencode($game['username']) ?>" class="text-blue-600 hover:underline">
                    <?= htmlspecialchars($game['username']) ?>
                </a>
            </p>
        </div>
    </div>

    <hr class="my-6">

    <!-- Avaliações -->
    <div>
        <h2 class="text-2xl font-semibold mb-2">Avaliações</h2>
        <?php if (empty($reviews)): ?>
            <p class="text-gray-500">Ainda não há avaliações para este jogo.</p>
        <?php else: ?>
            <ul class="space-y-4">
                <?php foreach ($reviews as $review): ?>
                    <li class="bg-gray-100 p-4 rounded shadow">
                        <p class="text-yellow-600 font-semibold">★ <?= $review['rating'] ?>/5</p>
                        <p class="text-sm text-gray-600">
                            Por <a href="index.php?action=perfil&user=<?= urlencode($review['username']) ?>" class="text-blue-600 hover:underline">
                                <?= htmlspecialchars($review['username']) ?>
                            </a>
                        </p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <hr class="my-6">

    <!-- Comentários -->
    <div>
        <h2 class="text-2xl font-semibold mb-2">Comentários</h2>

        <?php if (empty($comments)): ?>
            <p class="text-gray-500">Nenhum comentário ainda.</p>
        <?php else: ?>
            <ul class="space-y-4">
                <?php foreach ($comments as $comment): ?>
                    <li class="bg-white p-4 rounded shadow">
                        <p class="text-sm text-gray-800"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                        <p class="text-xs text-gray-500 mt-1">por <strong><?= htmlspecialchars($comment['username']) ?></strong></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <hr class="my-6">

    <!-- Formulário de Comentário -->
    <?php if (isset($_SESSION['user'])): ?>
        <form action="index.php?action=add_comment" method="POST" class="space-y-2 mt-4">
            <input type="hidden" name="game_id" value="<?= $game['id'] ?>">
            <label for="comment" class="block font-semibold">Adicionar Comentário:</label>
            <textarea name="comment" id="comment" rows="3" required class="w-full border rounded px-3 py-2"></textarea>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Comentar</button>
        </form>
    <?php else: ?>
        <p class="text-gray-500 mt-4">Faça login para comentar ou avaliar este jogo.</p>
    <?php endif; ?>
</div>

<?php include 'views/templates/footer.php'; ?>
