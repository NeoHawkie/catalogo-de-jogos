<nav class="bg-gray-100 shadow-sm py-3 px-6 flex justify-between items-center">
    <div class="text-lg font-semibold">Perfil</div>
    
    <?php if ($isOwner): ?>
        <a href="index.php?action=edit_profile" class="text-green-600 hover:text-green-800 font-medium">Editar perfil</a>
    <?php else: ?>
        <form method="POST" action="index.php?action=follow_user">
            <input type="hidden" name="user_to_follow" value="<?= htmlspecialchars($profile['username']) ?>">
            <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">Seguir</button>
        </form>
    <?php endif; ?>
</nav>
