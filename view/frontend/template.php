<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <!-- css -->
        <link href="public/css/base.css" rel="stylesheet" />
        <link href="public/css/layout.css" rel="stylesheet" />
        <link href="public/css/theme.css" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Old Standard TT' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link rel="icon" type="image/png" href="public/img/favicon.png" />
    </head>

    <body>
        <?= $content ?>

        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'.editor' });</script>
    </body>
</html>
