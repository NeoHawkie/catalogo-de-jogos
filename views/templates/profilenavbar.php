<div class="flex justify-center">
    <nav class="flex p-1 pl-8 pr-8 justify-self-center justify-between bg-blue-900 border-blue-500 
    border-4 border-solid rounded-full h-full w-full max-w-4xl text-white">
        <?php if ($_SESSION['user_id'] === $profile['id']): ?>
            <a href=""> Editar perfil</a>
        <?php else: ?>
            <a href=""> Seguir</a>
        <?php endif ?>
        <a href=""> Buscar usuários</a>
        <a href=""> Avaliações</a>
        <a href=""> Seguidores</a>
        <a href=""> Seguindo</a>
    </nav>
</div>