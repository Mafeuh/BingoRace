<?php

return [
    'card.public_objectives' => ":amount objectifs public",
    'card.private_objectives' => ":amount objectifs privés",

    'creation.title' => "Création d'un jeu",
    
    'creation.form.name.label' => "Nom",
    'creation.form.name.placeholder' => "Nom du jeu",
    
    'creation.form.public_objectives.label' => "Objectifs publics",
    'creation.form.public_objectives.placeholder' => "Objectif public 1\nObjectif public 2\n...",
    
    'creation.form.private_objectives.label' => "Objectifs privés",
    'creation.form.private_objectives.placeholder' => "Objectif privé 1\nObjectif privé 2\n...",
    
    'creation.form.image.label' => "Image",
    'creation.form.image.message' => "Format optimal des images: 2/3 (largeur x hauteur: 100x150, 200x300...)",
    
    'creation.form.visibility.label' => "Visibilité",
    'creation.form.visibility.value.public' => "Public",
    'creation.form.visibility.value.private' => "Privé",
    'creation.form.visibility.value.official' => "Officiel",
    'creation.form.visibility.placeholder' => "Visibilité",
    
    'creation.form.language.label' => "Langue",
    'creation.form.language.invalid' => "Langue invalide.",
    
    'creation.visibility.unallowed.official' => "Vous n'avez pas la permission de faire des jeux en visibilité 'officielle'.",
    'creation.visibility.subtitle.admin' => "Les jeux officiels sont des jeux par défaut proposés par le site.",
    'creation.visibility.subtitle.text1' => "La visibilité 'privée' cache votre jeu aux autres utilisateurs.",
    'creation.visibility.subtitle.text2' => "La visibilité 'public' rend votre jeu visible dans la liste des jeux.",
    
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

    'show.description.title' => "Description",
    'show.description.empty' => "Ce jeu n'a pas de description",

    'show.public_objectives.title' => ":amount objectifs publics",
    'show.public_objectives.empty' => "Ce jeu n'a pas d'objectif public",
    'show.private_objectives.title.you' => "Tes :amount objectifs privés",
    'show.private_objectives.title.not_you' => "Les :amount objectifs privés de :name",
    'show.private_objectives.empty' => "Tu n'as pas encore créé d'objectif !",
    'show.danger.delete' => "Supprimer le jeu",
    'show.danger.rename.label' => "Renommer le jeu",
    'show.danger.rename.submit' => "Valider",
    'show.danger.change_image.label' => "Changer l'image",
    'show.danger.change_image.submit' => "Valider",
    'show.danger.change_image.valid' => "L'image a été changée.",

    'show.flag.title' => "Signaler",
    'show.flag.reason.label' => "Raison",
    'show.flag.reason.validate' => "Signaler",
    
    'show.visibility.title' => "Changer la visibilité",
    'show.visibility.is_public' => "Ce jeu est public, créé par :name",
    'show.visibility.is_private' => "Ce jeu est privé.",
    'show.visibility.is_official' => "Ce jeu est officiel.",
    'show.visibility.to_public' => "Mets le public!",
    'show.visibility.to_private' => "Mets le privé!",
    'show.visibility.to_official_on' => "Mets le officiel!",
    'show.visibility.to_official_off' => "Mets le pas officiel!",
    'show.visibility.message.valid.public' => "Visibilité changée en public!",
    'show.visibility.message.valid.private' => "Visibilité changée en privé!",
    'show.visibility.message.valid.official_on' => "Visibilité changée en officiel!",
    'show.visibility.message.valid.official_off' => "Visibilité changée en pas officiel!",
    'show.visibility.message.invalid' => "Impossible de changer la visibilité.",

    'show.language.edit' => "Changer la langue",
    'show.language.edit.submit' => "Enregistrer",
    'show.language.edit.invalid' => "Langue invalide. Choisis soit 'fr', soit 'en'.",
    'show.language.edit.valid' => "Langage changé en :lang",

    'objectives.new.page_title' => "Ajout d'objectifs pour :name",
    'objectives.new.can_create_public' => "Tu es administrateur pour la gestion de ce jeu. Tu peux décider de la visibilité de cet objectif.",
    'objectives.new.cannot_create_public' => "Tu ne peux créer que des objectifs privés.",
    'objectives.edit' => "Modification d'un objectif",
    'objectives.difficulty' => "Tu peux aussi choisir une difficulté pour chaque objectif, entre 1 (facile) et 3 (dur)",
    'objectives.difficulty.default' => "Si non précisé, la difficulté sera de 1.",
    'objectives.difficulty.placeholder' => "Difficulté",

    'objectives.visibility.public' => "Public",
    'objectives.visibility.private' => "Privé",
];