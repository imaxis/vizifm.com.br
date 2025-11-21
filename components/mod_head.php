<head>
    <?php require_once "load_ipanel.php"; ?>
    <title>VIZI FM - A melhor estação para compartilhar!</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Your description" />
    <meta name="keywords" content="Your keywords" />
    <meta name="author" content="Your name" />

    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <link href="css/camera.css" rel="stylesheet" />
    <link href="css/mediaelementplayer.css" rel="stylesheet" />
    <link href="css/slick.css" rel="stylesheet" />
    <link href="css/slick-theme.css" rel="stylesheet" />
    <link href="css/animate.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />

    <style>
        .locutor {
            position: absolute;
            left: 20%;
            bottom: 0;
        }

        .locutorDir {
            position: absolute;
            right: 0;
            bottom: -60% !important;
        }

        .locutor img,
        .locutorDir img {
            height: 90vh;
            object-fit: contain;
        }
    </style>
    <?php require_once './ipanel/app/core/config.php'; ?>
</head>