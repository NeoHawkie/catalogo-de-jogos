<?php include 'views/templates/header.php'; ?>

<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md text-center max-w-xs sm:max-w-md md:max-w-lg w-full">
        <h1 class="text-2xl font-bold text-red-600">Erro 404</h1>
        <p class="text-gray-600 mt-2 text-sm sm:text-base">Página não encontrada.</p>
        <a href="index.php?action=dashboard" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm sm:text-base">Voltar para a página inicial</a>
    </div>
</div>

<?php
include 'views/templates/footer.php';
exit;
?>