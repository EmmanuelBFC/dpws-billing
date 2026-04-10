<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <style type="text/css">
        * { margin: 0; padding: 0; font-size: 100%; font-family: 'Avenir Next', "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; line-height: 1.65; }
        img { max-width: 100%; margin: 0 auto; display: block; }
        body, .body-wrap { width: 100% !important; height: 100%; background: #f8f8f8; }
        a { color: #f5ab2a;; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .button { display: inline-block; color: white; background: #f5ab2a;; border: solid #f5ab2a;; border-width: 10px 20px 8px; font-weight: bold; border-radius: 4px; }
        .button:hover { text-decoration: none; }
        h1, h2, h3, h4, h5, h6 { margin-bottom: 20px; line-height: 1.25; }
        h1 { font-size: 32px; }
        h2 { font-size: 28px; }
        h3 { font-size: 24px; }
        h4 { font-size: 20px; }
        h5 { font-size: 16px; }
        p, ul, ol { font-size: 16px; font-weight: normal; margin-bottom: 20px; }
        .container { display: block !important; clear: both !important; margin: 0 auto !important; max-width: 580px !important; }
        .container table { width: 100% !important; border-collapse: collapse; }
        .container .masthead { padding: 80px 0; background: #f5ab2a;; color: white; }
        .container .masthead h1 { margin: 0 auto !important; max-width: 90%; text-transform: uppercase; }
        .container .content { background: white; padding: 30px 35px; }
        .container .content.footer { background: none; }
        .container .content.footer p { margin-bottom: 0; color: #888; text-align: center; font-size: 14px; }
        .container .content.footer a { color: #888; text-decoration: none; font-weight: bold; }
        .container .content.footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<table class="body-wrap">
    <tr>
        <td class="container">

            <!-- Message start -->
            <table>
                <tr>
                    <td align="center" class="masthead">
                        <img src="/assets/images/logo/logo-dpws.png" alt="logo" />
                        <h3> Douala Port Weight Services.</h3>
                    </td>
                </tr>
                <tr>
                    <td class="content">

                        <h5>Bonjour Madame / Monsieur  </h5>

                        <p>
                            Votre camion immatriculé le {{$prediction['tractor']}} avec pour conteneur N° {{$prediction['container_number']}} a fait sa pesée d'entrée sur le pont {{$prediction['guerite_entry']}} le {{$prediction['date_weighing_entry']}} .

                            Cordialement

                            <br>
                        </p>
                        <table>
                            <tr>
                                <td align="center">
                                    {{-- <p>
                                        <a class="button" style=" color: white"  href="{{route('rendez-vous',$data['id'])}}">JE SOUHAITE TESTER LE MODELE AVEC LES DONNEES DE MON ENTREPRISE</a>
                                    </p> --}}
                                </td>
                            </tr>
                        </table>
                        <p><em>–  Bien à vous.</em></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="container">
            <!-- Message start -->
            <table>
                <tr>
                    <td class="content footer" align="center">
                        <p>Envoyé par <a href="https://www.bfclimited.com/">DPWS</p>
                        <p><a href="javascript:void(0)"></a></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>