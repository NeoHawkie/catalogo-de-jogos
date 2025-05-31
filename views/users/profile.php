<?php //include 'views/templates/profilenavbar.php'; 
?>

<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">

    <!-- Foto e Info Principal -->
    <div class="flex items-center space-x-6">
        <img src="uploads/profilePictures/<?= $profile['profile_picture'] ?>" alt="Foto de perfil"
            class="w-28 h-28 rounded-full object-cover border-2 border-gray-300"
            onerror="this.src='uploads/profilePictures/defaultProfilePicture.jpg'">


        <div class="flex-1">
            <h2 class="text-2xl font-bold"><?= htmlspecialchars($profile['username']) ?></h2>
            <p class="text-gray-600"><?= htmlspecialchars($profile['email']) ?></p>
            <div class="mt-2 text-sm text-gray-500">
                <span class="mr-4"><strong>0</strong> seguidores</span>
                <span><strong>0</strong> seguindo</span>
            </div>
        </div>
    </div>

    <!-- Formulário de edição da bio e imagem -->
    <?php if ($isOwner): ?>
        <form method="POST" action="index.php?action=edit_profile" enctype="multipart/form-data" class="mt-6 space-y-4">

            <div class="flex">
                <div class="max-w-sm">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alterar foto de perfil</label>
                    <input type="file" name="profile_picture" class="w-full text-sm text-gray-500 file:bg-green-600
                    file:text-white file:px-3 file:py-1 file:rounded file:hover:bg-green-700">
                </div>
                <div class="place-content-end px-4 py-1">
                    <a href="index.php?action=delete_profile_picture" class="bg-red-600 text-white px-3 py-1
                    rounded hover:bg-red-700">Remover foto de perfil</a>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Biografia</label>
                <textarea name="bio" rows="4" class="w-full border border-gray-300 rounded p-2 text-sm"><?= nl2br($bio = $profile['bio'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Salvar alterações</button>
        </form>
    <?php else: ?>
        <!-- Apenas exibição da bio se não for o dono -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-1">Biografia</h3>
            <p class="text-gray-600"><?= nl2br($bio = $profile['bio'] ?? '') ?></p>
        </div>
    <?php endif; ?>

    <!-- Jogo mais recente -->
    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Jogo mais recente</h3>
        <div class="flex items-center space-x-4">
            <?php if ($recentGame) : ?>
                <img src="uploads/gameCovers/<?= $recentGame['cover'] ?>" alt="Capa do jogo"
                    class="w-24 h-24 object-cover rounded"
                    onerror="this.src='uploads/gameCovers/defaultCover.jpg'">
                <span class="text-md font-medium"><?= htmlspecialchars($recentGame['title']) ?></span>
            <?php else : ?>
                <p class="text-gray-600">Nenhum jogo adicionado recentemente...</p>
            <?php endif ?>
        </div>

    </div>

    <!-- Comentários de outros usuários sobre o perfil -->
    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-1">Comentários</h3>
        <p class="text-gray-600">WIP</p>
    </div>
</div>