<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Players' Lounge</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-900 p-5 text-white">
        <div class="container mx-auto flex justify-between">
            <div>Players' Lounge</div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <form action="index.php" method="GET" class="flex flex-1 max-w-xl mx-auto px-6">
                    <input type="hidden" name="action" value="search">
                    <input
                        type="text"
                        name="q"
                        placeholder="Buscar jogos ou usuários..."
                        class="text-black w-full px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring focus:border-green-400 text-sm"
                        required>
                    <button
                        type="submit"
                        class="bg-green-700 text-white px-4 rounded-r-md hover:bg-green-800 text-sm">
                        Buscar
                    </button>
                </form>
                <div class="flex justify-between">
                    <a href="index.php?action=dashboard" class="block hover:underline px-2">Meus Jogos</a>
                    <a href="index.php?action=profile&user=<?= $_SESSION['username']; ?>" class="block hover:underline px-2">Meu Perfil</a>
                    <a href="index.php?action=logout" class="block hover:underline px-2">Logout</a>
                </div>
            <?php endif; ?>
        </div>
    </nav>
    <main class="container mx-auto p-4">