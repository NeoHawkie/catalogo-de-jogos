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
            <div>Players' Lounge</div>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="index.php?action=logout" class="hover:underline">Logout</a>
            <?php endif; ?>
        </div>
    </nav>
    <main class="container mx-auto p-4">
