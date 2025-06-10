<?php include 'views/templates/header.php'; ?>

<div class="max-w-4xl mx-auto py-8">
    <!-- Título do Jogo -->
    <h1 class="text-3xl font-bold mb-4"><?= $game['title'] ?></h1>

    <!-- Imagem e Detalhes -->
    <div class="flex flex-col md:flex-row gap-6">
        <div class="w-full md:w-1/3">
            <img src="uploads/gameCovers/<?= $game['cover'] ?>" alt="Capa do jogo" class="w-[240px] h-[360px] overflow-hidden">
        </div>

        <div class="w-full md:w-2/3 space-y-2">
            <p><strong>Plataforma:</strong> <?= $game['platform'] ?></p>
            <p><strong>Descrição:</strong> <?= nl2br($game['description']) ?></p>
            <p><strong>Adicionado por:</strong>
                <a href="index.php?action=profile&user=<?= $addedBy ?>" class="text-blue-600 hover:underline">
                    <?= $addedBy ?>
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
                            Por <a href="index.php?action=perfil&user=<?= $review['username'] ?>" class="text-blue-600 hover:underline">
                                <?= $review['username'] ?>
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
                        <p class="text-sm text-gray-800"><?= nl2br($comment['content']) ?></p>
                        <div class="flex justify-end">
                            <?php if ($comment['username'] === $_SESSION['username']) : ?>
                                <a class="w-[20px] h-[20px] overflow-hidden" href="index.php?action=delete_comment&id=<?=$comment['id']?>&gameId=<?=$game['id']?>">
                                    <img class="w-full h-full object-cover" src="assets/trash_icon.png" alt="Excluir"></a>
                            <?php endif; ?>
                            <p class="text-xs text-gray-500 mt-1 px-2">por <strong><?= $comment['username'] ?></strong></p>
                        </div>


                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <hr class="my-6">

    <!-- Formulário de Comentário -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <form action="index.php?action=add_comment" method="POST" class="space-y-2 mt-4">
            <input type="hidden" name="gameId" value="<?= $game['id'] ?>">
            <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
            <label for="content" class="block font-semibold">Adicionar Comentário:</label>
            <textarea name="content" rows="3" required class="w-full border rounded px-3 py-2"></textarea>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Comentar</button>
        </form>
    <?php else: ?>
        <p class="text-gray-500 mt-4">Faça login para comentar ou avaliar este jogo.</p>
    <?php endif; ?>
</div>

<?php include 'views/templates/footer.php'; ?>