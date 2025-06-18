<?php

return [
    'card.public_objectives' => ":amount public objectives",
    'card.private_objectives' => ":amount private objectives",

    'creation.title' => "Creation of a game",
    'creation.visibility.subtitle.admin' => "You are an admin! The game will be public.",
    'creation.visibility.subtitle' => "You can only create private games.",
    
    'creation.form.name.label' => "Name",
    'creation.form.name.placeholder' => "Name of the game",

    'creation.form.public_objectives.label' => "Public objectives",
    'creation.form.public_objectives.placeholder' => "Objective 1\nObjective 2\n...",
    
    'creation.form.private_objectives.label' => "Private objectives",
    'creation.form.private_objectives.placeholder' => "Objective 3\nObjective 4\n...",

    'creation.form.image.label' => "Image",
    'creation.form.image.message' => "Optimal image shape: 2x3 (width x height: 100x150, 200x300...)",

    'creation.form.submit' => "Validate",

    'list.title' => "Games list",
    'list.create' => "Create a game !",

    'list.official_games.title' => "Official games",
    'list.official_games.info' => "These are the games suggested by BingoRace's staff.",
    'list.official_games.empty' => "No games to show.",

    'list.public_games.title' => "Public games",
    'list.public_games.info' => "These are the games created by users and set on public.",
    'list.public_games.empty' => "No games to show.",

    'list.private_games.title' => "Private games",
    'list.private_games.info' => "These are the games you created.",
    'list.private_games.empty' => "No games to show.",

    'show.title' => "About :name",
    'show.permissions.admin' => "You are an admin! You can do everything!",
    'show.permissions.public_game' => "This game is public! Everybody can add their own objectives.",
    'show.permissions.creator_auth' => "Your game, your rules! Create either public or private objectives!",
    'show.permissions.default' => "This game was added by :creator_name. You can only add private objectives.",

    'show.public_objectives.title' => ":amount public objectives",
    'show.public_objectives.empty' => "This game does not have any public objective!",
    'show.private_objectives.title' => "Your :amount private objectives",
    'show.private_objectives.empty' => "You did not create private objectives for this game!",
    'show.danger.delete' => "Delete the game",
    'show.danger.rename.label' => "Rename the game",
    'show.danger.rename.submit' => "Validate",
];