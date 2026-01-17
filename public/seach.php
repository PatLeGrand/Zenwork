<?php
session_start();
require_once __DIR__ . '/../app/models/user.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    exit();
}

$query = $_GET['q'] ?? '';

if (empty(trim($query))) {
    echo '<p class="p-4 text-gray-500">Tapez pour rechercher...</p>';
    exit();
}

$userModel = new User();
$result = $userModel->searchUsers($query);

if (empty($result)) {
    echo '<p class="p-4 text-gray-500">Aucun résultat trouvé</p>';
} else {
    foreach ($results as $user) {
        ?>
        <div class="p-3 hover:bg-gray-50 border-b flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['first_name'] . ' ' . $user['last_name']) ?>&background=random&color=fff"
                     class="w-10 h-10 rounded-full">
                <div>
                    <p class="font-medium text-gray-900">
                        <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
                    </p>
                </div>
            </div>
            <a href="profile.php?id=<?= $user['id'] ?>"
               class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                Voir profil
            </a>
        </div>
        <?php
    }
}
