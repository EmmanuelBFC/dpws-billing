<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="assets/images/logo-dpws.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/main.css" />



        <title>Quel pont ?</title>
    </head>
    <body>
    <div class="container my-auto">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card my-5">
                    <form method="POST" action="{{ route('login') }}" class="card-body cardbody-color p-lg-5">
                        @csrf
                        <div class="text-center mb-3">
                            <img src="assets/images/logo/logo-dpws.png" alt="profile">
                        </div>
                        <div class="select-style-1">
                            <label>Vous travaillez sur quel pont ?</label>
                            <div class="select-position">
                                <select>
                                    @foreach($weighbridges as $weighbridge)
                                        <option value="1">{{$weighbridge->label}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center"><button type="submit" class="btn btn-primary px-5 mb-5 w-100">Valider</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
