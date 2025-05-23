<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Players' Lounge</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <div><a <?php if (isset($_SESSION['user_id'])): ?>
                    href="index.php?action=dashboard" class="hover:underline"
                    <?php endif; ?>>Players' Lounge</a></div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="flex justify-between">
                    <a href="index.php?action=perfil&user=<?=$_SESSION['username'];?>" class="block hover:underline pl-2 pr-2">Meu Perfil</a>
                    <a href="index.php?action=logout" class="block hover:underline pl-2 pr-2">Logout</a>
                </div>  
            <?php endif; ?>
        </div>
    </nav>
    <main class="container mx-auto p-4">