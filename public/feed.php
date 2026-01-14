<?php
    require_once __DIR__ . '/../app/controllers/PostController.php';
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location:login.php');
        exit();

    }

    $user_id = $_SESSION['user_id'];
    $firstname = $_SESSION['first_name'];
    $lastname = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $userFullName = $firstname.' '.$lastname;

    $controller = new PostController();
    $createResult = $controller->createPost($user_id);
    $posts = $controller->getPosts()
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed - Réseau Social</title>
    <link href="css/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!-- Navigation Bar -->
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="feed.php" class="text-2xl font-bold text-blue-600">
                    SocialNet
                </a>
            </div>

            <!-- Search Bar -->
            <div class="hidden md:block flex-1 max-w-md mx-8">
                <input
                        type="text"
                        placeholder="Rechercher..."
                        class="w-full px-4 py-2 rounded-full bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- User Menu -->
            <div class="flex items-center space-x-3">
                <button class="p-2 rounded-full hover:bg-gray-100 relative">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <div class="relative">
                    <button class="flex items-center space-x-2 p-2 rounded-full hover:bg-gray-100">
                        <img src="https://ui-avatars.com/api/?name=<?= $firstname ?>+<?= $lastname ?>&background=3b82f6&color=fff" class="w-8 h-8 rounded-full">
                        <span class="hidden md:block font-medium text-gray-700"><?= $userFullName ?></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Main Container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Left Sidebar -->
        <aside class="hidden lg:block lg:col-span-3">
            <div class="bg-white rounded-lg shadow p-4 sticky top-20">
                <div class="flex items-center space-x-3 mb-4">
                    <img src="https://ui-avatars.com/api/?name=<?= $firstname ?>+<?= $lastname ?>&background=3b82f6&color=fff" class="w-12 h-12 rounded-full">
                    <div>
                        <p class="font-semibold text-gray-900"><?= $userFullName ?></p>
                        <p class="text-sm text-gray-500">@userid</p>
                    </div>
                </div>

                <div class="border-t pt-4 space-y-2">
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-gray-700">Mon profil</span>
                    </a>

                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="text-gray-700">Mes amis</span>
                    </a>

                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-gray-700">Paramètres</span>
                    </a>

                    <a href="logout.php" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-red-50 text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Déconnexion</span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Feed -->
        <main class="lg:col-span-6">

            <!-- Create Post Card -->
            <div class="bg-white rounded-lg shadow mb-6 p-4">
                <div class="flex items-start space-x-3">
                    <img src="https://ui-avatars.com/api/?name=<?= $firstname ?>+<?= $lastname ?>&background=3b82f6&color=fff" class="w-12 h-12 rounded-full">
                    <div class="flex-1">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <?php
                                    if(!empty($createResult['errors'])): ?>
                                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-3">
                                            <?= $createResult['errors'] ?>
                                        </div>
                                <?php endif; ?>
                                <?php if($createResult['success']): ?>
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-3">
                                        <span>Post Crée avec succès</span>
                                    </div>
                                <?php endif; ?>

                                <textarea
                                        placeholder="Quoi de neuf, <?= $firstname ?> ?"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                                        rows="3"
                                        name="content"
                                ></textarea>

                                <div class="flex items-center justify-between mt-3">
                                    <div class="flex space-x-2">
                                        <!-- Input file caché -->
                                        <input type="file" id="image-upload" name="image" accept="image/*" class="hidden">

                                        <!-- Bouton qui déclenche l'input -->
                                        <label for="image-upload" class="p-2 hover:bg-gray-100 rounded-full cursor-pointer" title="Ajouter une image">
                                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </label>

                                        <!-- Prévisualisation du nom de fichier (optionnel) -->
                                        <span id="file-name" class="text-sm text-gray-500 self-center"></span>
                                    </div>

                                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
                                        Publier
                                    </button>
                                </div>
                            </form>

                            <!-- Script pour afficher le nom du fichier sélectionné (optionnel) -->
                            <script>
                                document.getElementById('image-upload').addEventListener('change', function(e) {
                                    const fileName = e.target.files[0]?.name || '';
                                    document.getElementById('file-name').textContent = fileName;
                                });
                            </script>
                    </div>
                </div>
            </div>

            <!-- Post Example 1 -->

            <?php if(empty($posts)): ?>
                <article class="bg-white rounded-lg shadow mb-4">
                    <div class="p-4 flex items-start justify-center">
                        <p class="text-4xl text-black-500"> Aucun Posts a afficher </p>
                    </div>
            <?php else: ?>
                    <?php foreach($posts as $post): ?>
                    <article class="bg-white rounded-lg shadow mb-4">
                        <div class="p-4 flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="https://ui-avatars.com/api/?name=<?= $post['first_name'] ?>+<?= $post['last_name']?>&background=10b001&color=fff" class="w-12 h-12 rounded-full">
                                <div>
                                    <h3 class="font-semibold text-gray-900"><?= htmlspecialchars($post['first_name'] . ' ' . $post['last_name']) ?></h3>
                                    <p class="text-sm text-gray-500"><?= htmlspecialchars($post['created_at']) ?>></p>
                                </div>
                            </div>

                            <button class="p-2 hover:bg-gray-100 rounded-full">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Post Content -->
                        <div class="px-4 pb-4">
                            <p class="text-gray-800 leading-relaxed">
                                <?= htmlspecialchars($post['content']) ?>
                            </p>
                            <?php if(!empty($post['image_url'])): ?>
                                <img src="<?= $post['image_url'] ?>" class="w-full rounded-lg" alt="image du post de <?= $post['first_name'] ?>">
                            <?php endif; ?>
                        </div>

                        <!-- Post Stats -->
                        <div class="px-4 py-2 border-t border-b border-gray-200 flex items-center justify-between text-sm text-gray-500">
                            <span>❤️ 👍 24 personnes</span>
                            <div class="flex space-x-4">
                                <span>12 commentaires</span>
                                <span>3 partages</span>
                            </div>
                        </div>

                        <!-- Post Actions -->
                        <div class="px-4 py-2 flex items-center justify-around">
                            <button class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-100 rounded-lg transition">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span class="text-gray-700 font-medium">J'aime</span>
                            </button>

                            <button class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-100 rounded-lg transition">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <span class="text-gray-700 font-medium">Commenter</span>
                            </button>

                            <button class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-100 rounded-lg transition">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                                </svg>
                                <span class="text-gray-700 font-medium">Partager</span>
                            </button>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>


        </main>

        <!-- Right Sidebar -->
        <aside class="hidden xl:block xl:col-span-3">

            <!-- Suggestions -->
            <div class="bg-white rounded-lg shadow p-4 mb-4">
                <h3 class="font-semibold text-gray-900 mb-4">Suggestions d'amis</h3>

                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <img src="https://ui-avatars.com/api/?name=Lucas+Petit&background=6366f1&color=fff" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-medium text-sm text-gray-900">Lucas Petit</p>
                                <p class="text-xs text-gray-500">2 amis en commun</p>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                            Ajouter
                        </button>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <img src="https://ui-avatars.com/api/?name=Emma+Rousseau&background=8b5cf6&color=fff" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-medium text-sm text-gray-900">Emma Rousseau</p>
                                <p class="text-xs text-gray-500">5 amis en commun</p>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                            Ajouter
                        </button>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <img src="https://ui-avatars.com/api/?name=Nathan+Moreau&background=14b8a6&color=fff" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-medium text-sm text-gray-900">Nathan Moreau</p>
                                <p class="text-xs text-gray-500">1 ami en commun</p>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Trending Topics -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-semibold text-gray-900 mb-4">Tendances</h3>

                <div class="space-y-3">
                    <div class="hover:bg-gray-50 p-2 rounded cursor-pointer">
                        <p class="text-sm text-gray-500">#1 - Technologie</p>
                        <p class="font-medium text-gray-900">#TailwindCSS</p>
                        <p class="text-xs text-gray-500">2.5K posts</p>
                    </div>

                    <div class="hover:bg-gray-50 p-2 rounded cursor-pointer">
                        <p class="text-sm text-gray-500">#2 - Programmation</p>
                        <p class="font-medium text-gray-900">#PHP</p>
                        <p class="text-xs text-gray-500">1.8K posts</p>
                    </div>

                    <div class="hover:bg-gray-50 p-2 rounded cursor-pointer">
                        <p class="text-sm text-gray-500">#3 - WebDev</p>
                        <p class="font-medium text-gray-900">#Frontend</p>
                        <p class="text-xs text-gray-500">1.2K posts</p>
                    </div>
                </div>
            </div>

        </aside>

    </div>
</div>

</body>
</html>