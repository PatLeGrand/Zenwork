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
    foreach ($result as $user) {

    }
}
