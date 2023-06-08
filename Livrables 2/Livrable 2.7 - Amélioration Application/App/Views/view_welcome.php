<?php
require_once 'view_begin.php';
?>

<title>ApnaTV | Bienvenue</title>

<style>
    @media only screen and (max-width: 600px) {
        /* styles pour les écrans de moins de 600px (téléphones) */
        .description-width {
            width: 100%;
        }
    }

    @media only screen and (min-width: 600px) and (max-width: 1200px) {
        /* styles pour les écrans entre 600px et 1200px (tablettes) */
        .description-width {
            width: 75%;
        }
    }

    @media only screen and (min-width: 1200px) {
        /* styles pour les écrans de plus de 1200px (ordinateurs de bureau, télévisions) */
        .description-width {
            width: 50%;
        }
    }
</style>

<div class="container-fluid vh-100 p-0 m-0" style="background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(255,255,255,0) 100%), 
url('https://images.unsplash.com/photo-1535016120720-40c646be5580?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); 
background-size: cover; background-repeat: no-repeat; background-position: center; width: 100%;">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%;">
        <div class="text-white text-center">
            <h1 class="display-3 text-uppercase fw-bold">Bienvenue sur ApnaTV</h1>
            <p class="fw-bold mx-auto my-5 fs-4
            ">Profitez des meilleures séries et films en streaming sur ApnaTV.<br>Pour commencer, connectez-vous ou créez un compte pour accéder à notre catalogue.</p>
            <div class="my-5">
                <a href="index.php?controller=Connexion&action=signInForm" class="btn btn-outline-light mt-3 mx-2">Se connecter</a>
                <a href="index.php?controller=Connexion" class="btn btn-light mt-3 mx-2">S'inscrire</a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'view_end.php'; ?>
