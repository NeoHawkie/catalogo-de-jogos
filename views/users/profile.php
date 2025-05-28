<?php include_once 'views/templates/profilenavbar.php' ?>

<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <div class="flex items-center space-x-6">
        <!-- Foto de perfil -->
        <img src="uploads\profilePictures\<?=$profile['profile_picture']?>" alt="Foto de perfil" class="w-28 h-28 rounded-full object-cover border-2 border-gray-300">
        
        <div class="flex-1">
            <h2 class="text-2xl font-bold"><?= htmlspecialchars($profile['username'])?><span class="text-gray-600"><?='#'.$profile['id'] ?></span></h2>
            <p class="text-gray-600"><?= htmlspecialchars($profile['email']) ?></p>

            <div class="mt-2 text-sm text-gray-500">
                <span class="mr-4"><strong>0</strong> seguidores</span>
                <span><strong>0</strong> seguindo</span>
            </div>
        </div>
    </div>

    <!-- Biografia -->
    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-1">Biografia</h3>
        <p class="text-gray-600"><?= nl2br(htmlspecialchars($profile['bio'])) ?></p>
    </div>

    <!-- Jogo mais recente -->
    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Ultimo jogo adicionado</h3>
        <div class="flex items-center space-x-4">
            <img src="uploads\gameCovers\<?=$recentGame['cover']?>" alt="Capa do jogo" class="w-24 h-24 object-cover rounded">
            <span class="text-md font-medium"><?= htmlspecialchars($recentGame['title']) ?></span>
        </div>
    </div>
</div>


<?php include_once 'views/templates/footer.php' ?>