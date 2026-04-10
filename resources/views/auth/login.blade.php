<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Se connecter</title>
    <link rel="shortcut icon" href="assets/images/logo/logo-dpws.png" type="image/x-icon" />
    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    @livewireStyles
    <style>
        .btn-color {
            background-color: #0e1c36;
            color: #fff;

        }

        .profile-image-pic {
            height: 200px;
            width: 200px;
            object-fit: cover;
        }



        .cardbody-color {
            background-color: #ebf2fa;
        }

        a {
            text-decoration: none;
        }

        body{
            background-image: url('/assets/images/douala-main.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }

    </style>
</head>
<body >
<div class="container" >
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-170">
                <livewire:auth.login/>
            </div>
        </div>
    </div>
</div>
@livewireScripts

</body>
</html>
