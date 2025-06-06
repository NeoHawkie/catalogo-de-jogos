<div class="max-w-2xl mx-auto py-6">
    <h2 class="text-2xl font-semibold mb-4">Seguindo</h2>

    <?php if (empty($profiles)): ?>
        <p class="text-gray-600">Você olha ao redor, mas não vê nenhum stalker por aqui...</p>
    <?php else: ?>
        <ul class="space-y-4">
            <?php foreach ($profiles as $profile): ?>
                <li class="flex items-center bg-white shadow p-4 rounded">
                    <img src="uploads/profilePictures/<?=$profile['profile_picture'] ?? 'defaultProfilePicture.jpg'?>" alt="Avatar" class="w-12 h-12 rounded-full object-cover mr-4">
                    <div>
                        <a href="index.php?action=profile&user=<?= urlencode($profile['username']) ?>" class="text-lg font-semibold text-blue-600 hover:underline">
                            <?= htmlspecialchars($profile['username']) ?>
                        </a>
                        <p class="text-sm text-gray-500"><?=$profile['email'];?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?php include 'views/templates/footer.php'; ?>
