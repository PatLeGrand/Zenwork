<?php
    require_once __DIR__ . '/../model/User.php';
    require_once __DIR__ . '/../utils/validation.php';


    class AuthController{
        private $userModel;

        public function __construct(){
            $this->userModel = new User();
        }

        function register(){
            $errors = [];
            $success = false;

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $firstname = sanitizeInput($_POST['firstname'] ?? '');
                $lastname = sanitizeInput($_POST['lastname'] ?? '');
                $email = sanitizeInput($_POST['email'] ?? '');
                $password = $_POST['password'] ?? '';

                if(empty($firstname)){
                    $errors['firstname'] = "Le prénom est obligatoire";
                } else if(!validateName($firstname)){
                    $errors['firstname'] = "Le prénom doit contenir au moins 2 lettres";
                }

                if(empty($lastname)){
                    $errors['lastname'] = "Le nom est obligatoire";
                } else if(!validateName($lastname)){
                    $errors['lastname'] = "Le nom doit contenir au moins 2 lettres";
                }

                 if (empty($email)) {
                    $errors['email'] = 'L\'email est requis';
                } elseif (!validateEmail($email)) {
                     $errors['email'] = 'L\'email est invalide';
                } elseif ($this->userModel->emailExists($email)) {
                     $errors['email'] = 'Cet email est déja utilisé';
                }

                if (empty($password)) {
                    $errors['password'] = 'Le mot de passe est requis';
                } elseif (!validatePassword($password)) {
                    $errors['password'] = 'Le mot de passe doit contenir au moins 8 caractères';
                }

                if(empty($errors)){
                    $result = $this->userModel->create($email, $firstname, $lastname, $password);
                     if($result){
                         $success = true;
                     } else {
                         $errors ['general'] = "Une erreur est survenue lors de l'enregistrement";
                     }

                }

            }
            return ['errors' => $errors, 'success' => $success];
        }

        function login(){
            $errors = [];
            $success = false;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
                if (empty($email)) {
                    $errors['email'] = "L'email est obligatoire";
                }
                if (empty($password)) {
                    $errors['password'] = "Le mot de passe est obligatoire";
                }
                if (empty($errors)) {
                    $user = $this->userModel->login($email, $password);
                    if ($user) {
                        session_start();
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['firstname'] = $user['first_name'];
                        $_SESSION['lastname'] = $user['last_name'];

                        $success = true;
                    } else {
                        $errors['general'] = "Email ou mot de passe incorrect";
                    }
                }
            }
            return ['errors' => $errors, 'success' => $success];
        }
    }
?>
