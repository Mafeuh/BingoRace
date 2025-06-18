<?php

return [
    'card.public_objectives' => ":amount objectifs public",
    'card.private_objectives' => ":amount objectifs privés",

    'creation.title' => "Création d'un jeu",
    'creation.visibility.subtitle.admin' => "Vous êtes admin ! Le jeu sera public.",
    'creation.visibility.subtitle' => "Vous ne pouvez créer que des jeux en visibilité privée.",
    
    'creation.form.name.label' => "Nom",
    'creation.form.name.placeholder' => "Nom du jeu",

    'creation.form.public_objectives.label' => "Objectifs publics",
    'creation.form.public_objectives.placeholder' => "Objectif public 1\nObjectif public 2\n...",
    
    'creation.form.private_objectives.label' => "Objectifs privés",
    'creation.form.private_objectives.placeholder' => "Objectif privé 1\nObjectif privé 2\n...",

    'creation.form.image.label' => "Image",
    'creation.form.image.message' => "Format optimal des images: 2/3 (largeur x hauteur: 100x150, 200x300...)",
    
    'creation.form.submit' => "Valider",

    'list.title' => "Liste des jeux",
    'list.create' => "Créer un jeu !",

    'list.official_games.title' => "Jeux officiels",
    'list.official_games.info' => "Ce sont les jeux proposés par l'équipe de BingoRace.",
    'list.official_games.empty' => "Aucun jeu à afficher.",

    'list.public_games.title' => "Jeux publics",
    'list.public_games.info' => "Ce sont les jeux que les utilisateurs ont défini comme publics.",
    'list.public_games.empty' => "Aucun jeu à afficher.",

    'list.private_games.title' => "Jeux personnels",
    'list.private_games.info' => "Ce sont tous les jeux que tu as créés.",
    'list.private_games.empty' => "Aucun jeu à afficher.",

    'show.title' => "Informations sur :name",
    'show.permissions.admin' => "Vous êtes admin ! Vous avez tous les droits mouahaha !",
    'show.permissions.public_game' => "Ce jeu est un jeu public ! N'importe qui peut ajouter ses propres objectifs dessus pour ses parties personnelles.",
    'show.permissions.creator_auth' => "C'est ton jeu, c'est tes règles ! Importe tes propres objectifs, privés ou publics !",
    'show.permissions.default' => "Ce jeu a été ajouté par :creator_name. C'est le/la seul.e personne à pouvoir ajouter des objectifs.",

    'show.public_objectives.title' => ":amount objectifs publics",
    'show.public_objectives.empty' => "Ce jeu n'a pas d'objectif public",
    'show.private_objectives.title' => "Tes :amount objectifs privés",
    'show.private_objectives.empty' => "Tu n'as pas encore créé d'objectif !",
    'show.danger.delete' => "Supprimer le jeu",
    'show.danger.rename.label' => "Renommer le jeu",
    'show.danger.rename.submit' => "Valider",
];