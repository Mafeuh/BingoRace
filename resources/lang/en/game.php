<?php

return [
    'card.public_objectives' => ":amount public objectives",
    'card.private_objectives' => ":amount private objectives",

    'creation.title' => "Creation of a game",
    
    'creation.form.name.label' => "Name",
    'creation.form.name.placeholder' => "Name of the game",

    'creation.form.public_objectives.label' => "Public objectives",
    'creation.form.public_objectives.placeholder' => "Objective 1\nObjective 2\n...",
    
    'creation.form.private_objectives.label' => "Private objectives",
    'creation.form.private_objectives.placeholder' => "Objective 3\nObjective 4\n...",

    'creation.form.image.label' => "Image",
    'creation.form.image.message' => "Optimal image shape: 2x3 (width x height: 100x150, 200x300...)",

    'creation.form.visibility.label' => "Visibility",
    'creation.form.visibility.value.public' => "Public",
    'creation.form.visibility.value.private' => "Private",
    'creation.form.visibility.value.official' => "Official",
    'creation.form.visibility.placeholder' => "Visibility",

    'creation.form.language.label' => "Language",
    'creation.form.language.invalid' => "Invalid language value.",

    'creation.visibility.unallowed.official' => "You cannot create 'official' games.",
    'creation.visibility.subtitle.admin' => "Official games are games approved by BingoRace's staff.",
    'creation.visibility.subtitle.text1' => "The 'private' option hides your game from other users.",
    'creation.visibility.subtitle.text2' => "The 'public' option makes your game visible in the games list.",

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

    'show.flag.title' => "Report",
    'show.flag.reason.label' => "Reason",
    'show.flag.reason.validate' => "Send report",

    
    'show.visibility.title' => "Change visibility",
    'show.visibility.is_public' => "This game is public.",
    'show.visibility.is_private' => "This game is private.",
    'show.visibility.is_official' => "This game is official.",
    'show.visibility.to_public' => "Make it public!",
    'show.visibility.to_private' => "Make it private!",
    'show.visibility.to_official_on' => "Make it official!",
    'show.visibility.to_official_off' => "Make it non-official!",
    'show.visibility.message.valid.public' => "Visibility set to public!",
    'show.visibility.message.valid.private' => "Visibility set to private!",
    'show.visibility.message.valid.official_on' => "Visibility set to official!",
    'show.visibility.message.valid.official_off' => "Visibility set to non-official!",
    'show.visibility.message.invalid' => "Couldn't change visibility value.",

    'show.language.edit.label' => "Edit language",
    'show.language.edit.submit' => "Save",
    'show.language.edit.invalid' => "Language invalid. Please select either 'fr' or 'en'.",
    'show.language.edit.valid' => "Language set to :lang",
];