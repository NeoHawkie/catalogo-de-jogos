<?php include_once 'views/templates/profilenavbar.php' ?>

<body class="flex">
    <h1>Perfil de <?= htmlspecialchars($profile['username']) . '#' . $profile['id'] ?></h1>
    <p>Email: <?= htmlspecialchars($profile['email']) ?></p>
    <img class="object-cover size-[360px] border rounded-full  " src="uploads\profilePictures\<?= $profile['profile_picture'] ?>" alt="<?= $profile['profile_picture'] ?>">
    <p>Bio: <?= htmlspecialchars($profile['bio']) ?> </p>
</body>

<?php include_once 'views/templates/footer.php' ?>