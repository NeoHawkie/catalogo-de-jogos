<?php
if(!isset($_SESSION)){
    session_start();
}

include 'views/templates/header.php';

if (!isset($_SESSION['user_id'])):
?>

<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md text-center max-w-xs sm:max-w-md md:max-w-lg w-full">
        <h1 class="text-2xl font-bold text-red-600">Acesso Negado</h1>
        <p class="text-gray-600 mt-2 text-sm sm:text-base">Você não tem permissão para acessar esta página.</p>
        <a href="/" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm sm:text-base">Voltar para a página inicial</a>
    </div>
</div>

<?php
    include 'views/templates/footer.php';
    exit;
endif;

?>

