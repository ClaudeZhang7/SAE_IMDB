<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="Content/css/nobel.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body style="background: #0E0E0E;">
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top px-3" style="background: rgba(0,0,0,0.5); -webkit-backdrop-filter: blur(10px);
  backdrop-filter: blur(10px);">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php">
				<img src="Content/img/ApnaTV.png" alt="" width="120" height="24" class="d-inline-block align-text-top">
			</a>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item mx-2">
						<a class="nav-link text-white" href="index.php?controller=AllMovies">Tous les Films</a>
					</li>
					<li class="nav-item mx-2">
						<a class="nav-link text-white" href="index.php?controller=Rapprochement_de_Film">Rapprochement de Film</a>
					</li>
					<li class="nav-item mx-2">
						<a class="nav-link text-white" href="index.php?controller=Films_acteurs_communs ">Films / acteurs communs </a>
					</li>
				</ul>
			</div>

			<div class="d-flex ms-auto">
				<ul class="navbar-nav me-3">
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center justify-content-center text-white mt-1"
						href="index.php?controller=Search">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search me-3" viewBox="0 0 16 16">
								<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
							</svg>
						</a>
					</li>
				</ul>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
		</div>
	</nav>

	<main>