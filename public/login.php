<?php
    require_once __DIR__. '/../app/controllers/AuthController.php';

    $controller = new AuthController();
    $result = $controller->login();

    $errors = $result['errors'];
    $success = $result['success'];

    if($success){
        header('Location: feed.php');
        exit();
    }

?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="/css/output.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="bg-slate-800">
<main>
    <div class="caroussel">

    </div>

    <div class="login-form px-4 my-32 max-w-3xl mx-auto space-y-6">
        <div class="form-header">
            <p class="text-4xl font-bold text-white ">Connetez-vous</p>

            <p class="text-slate-400 mt-5 mb-5">Vous ne possedez pas de compte?
                <a href="signup.php"> Inscrivez-vous</a>
            </p>
        </div>

        <form method="post" action="" class=" flex flex-col gap-4">
            <?php if(isset($errors['general'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <?= $errors['general'] ?>
                </div>
            <?php endif; ?>
            <div>
                <label for="email">
                    Email
                </label>
                <input name="email"
                       type="text"
                       class="border <?= isset($errors['email']) ? 'border-red-700' :  'border-gray-400' ?> block py-2 w-full rounded focus:outline-none focus:border-teal-500"
                       placeholder="Émail"
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                >
                <?php if(isset($errors['email'])): ?>
                    <span class="text-red-700"><?= $errors['email'] ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label>
                    Mot de passe
                </label>
                <input name="password"
                       type="password"
                       class="border border-gray-400 block py-2 w-full rounded focus:outline-none focus:border-teal-500"
                       placeholder="Entrez votre mot de passe"
                >
                <?php if(isset($errors['password'])): ?>
                    <span class="text-red-700"><?= $errors['password'] ?></span>
                <?php endif; ?>
            </div>
            <button type="submit" class="text-white bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 box-border border border-transparent font-medium leading-5 rounded-base text-sm px-4 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55">
                Se connecter
            </button>
        </form>
    </div>
</main>
</body>
