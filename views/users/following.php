<?php include 'views/templates/header.php'; ?>

<div class="max-w-2xl mx-auto py-6">
    <h2 class="text-2xl font-semibold mb-4">Seguindo</h2>

    <?php if (empty($following)): ?>
        <p class="text-gray-600">Você ainda não está seguindo ninguém.</p>
    <?php else: ?>
        <ul class="space-y-4">
            <?php foreach ($following as $user): ?>
                <li class="flex items-center bg-white shadow p-4 rounded">
                    <img src="<?= htmlspecialchars($user['avatar'] ?? 'assets/default-avatar.png') ?>" alt="Avatar" class="w-12 h-12 rounded-full object-cover mr-4">
                    <div>
                        <a href="index.php?action=perfil&user=<?= urlencode($user['username']) ?>" class="text-lg font-semibold text-blue-600 hover:underline">
                            <?= htmlspecialchars($user['username']) ?>
                        </a>
                        <p class="text-sm text-gray-500"><?= htmlspecialchars($user['email']) ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?php include 'views/templates/footer.php'; ?>
