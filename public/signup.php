<?php
    require_once __DIR__. '/../app/controllers/AuthController.php';

    $controller = new AuthController();
    $result = $controller->register();

    $error = $result['errors'];
    $success = $result['success'];

    if($success){
        header('Location: welcome.php');
        exit();
    }
?>
<!DOCTYPE html>
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

        <div class="signup-form px-4 my-32 max-w-3xl mx-auto space-y-6">
            <div class="form-header">
                <p class="text-4xl font-bold text-white ">Créer un compte</p>

                <p class="text-slate-400 mt-5 mb-5">Etes vous déja inscrit(e)?
                    <a> Connectez-vous</a>
                </p>
            </div>

            <form method="post" action="welcome.php" class=" flex flex-col gap-4">

                <?php if(isset($error['general'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <span class="block sm:inline"><?= $error['general'] ?></span>
                    </div>
                <?php endif; ?>

                <div class="flex space-x-3">
                    <div class="w-1/2">
                        <label for="firstname">
                            Prénom
                        </label>
                        <input name="firstname"
                               type="text"
                               class="border  <?= isset($error['firstname']) ? 'border-red-700' :  'border-gray-400' ?> block py-2 w-full rounded focus:outline-none focus:border-teal-500"
                               placeholder="Prénom"
                               value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>"
                        >
                        <?php if(isset($error['firstname'])): ?>
                            <span class="text-red-700"><?= $error['firstname'] ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="w-1/2">
                        <label for="lastname">
                            Nom
                        </label>
                        <input name="lastname"
                               type="text"
                               class="border <?= isset($error['lastname']) ? 'border-red-700' :  'border-gray-400' ?> block py-2 w-full rounded focus:outline-none focus:border-teal-500"
                               placeholder="Nom"
                               value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>"
                        >
                        <?php if(isset($error['lastname'])): ?>
                            <span class="text-red-700"><?= $error['lastname'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div>
                    <label for="email">
                        Email
                    </label>
                    <input name="email"
                           type="text"
                           class="border <?= isset($error['lastname']) ? 'border-red-700' :  'border-gray-400' ?> block py-2 w-full rounded focus:outline-none focus:border-teal-500"
                           placeholder="Émail"
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                    >
                    <?php if(isset($error['email'])): ?>
                        <span class="text-red-700"><?= $error['email'] ?></span>
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
                    <?php if(isset($error['password'])): ?>
                        <span class="text-red-700"><?= $error['password'] ?></span>
                    <?php endif; ?>
                </div>
                <div>
                    <input name="condition-term"
                           type="checkbox"
                           class="accent-black hover:accent-gray-500"

                    >
                    <label for="condition-term">
                        J'accepte les conditions
                    </label>
                </div>

                <button type="submit" class="text-white bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 box-border border border-transparent font-medium leading-5 rounded-base text-sm px-4 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55">
                    S'inscrire
                </button>
            </form>
        </div>
    </main>
</body>