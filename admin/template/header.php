<?php 


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/override-bootstrap.css">
</head>

<body>

    <div class="container d-flex">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">Sidebar</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="./index.php" class="nav-link active" aria-current="page">
                        <i class="bi bi-house-fill"></i>
                        Home
                    </a>
                </li>

                <li>
                    <a href="./users.php" class="nav-link text-white">
                    <i class="bi bi-person-circle"></i>
                        </svg>
                        Utilisateurs:
                    </a>
                </li>

                <li>
                    <a href="./question.php" class="nav-link text-white">
                    <i class="bi bi-person-circle"></i>
                        </svg>
                        Questions:
                    </a>
                </li>

                <li>
                    <a href="./reponse.php" class="nav-link text-white">
                    <i class="bi bi-tencent-qq"></i>
                        </svg>
                        Reponses:
                    </a>
                </li>

                <li>
                    <a href="./astuce.php" class="nav-link text-white">
                    <i class="bi bi-person-circle"></i>
                        </svg>
                        Astuces:
                    </a>
                </li>
       
                <li>
                    <a href="./commentaire.php" class="nav-link text-white">
                    <i class="bi bi-image"></i>
                        </svg>
                        Commentaires:
                    </a>
                </li>

                <li>
                    <a href="./admin.php" class="nav-link text-white">
                    <i class="bi bi-people"></i>
                        Administrateurs:
                    </a>
                </li>
                
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>mdo</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
        <main class="d-flex flex-column px-4">