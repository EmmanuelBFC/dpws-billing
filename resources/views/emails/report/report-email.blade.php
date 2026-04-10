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
        .container { display: block !important; clear: both !important; margin: 0 auto !important; max-width: 100% !important; }
        .container table { width: 100% !important; border-collapse: collapse; }
        .container .masthead { padding: 80px 0; background: #ffffff;; color: white; }
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
            <table>
                <tr>
                    <td class="content">
                        <h5>Bonjour Coordonnateur(trice)  </h5>
                        <p></p>
                        <table>
                            <tr>
                                <td align="justifys">
                                    <p>{{$report->body}}</p>
                                    <p> <strong><u>Pont bascule {{$report->weighbridge}}</u></strong></p>
                                    <p> <span style="font-weight: 250">Nombre total de pesées de type 1 :</span>  <i>
                                        {{$report->total_number_type_1_weighings}}</i>  </p>
                                    <p> <span style="font-weight: 250">Nombre total de pesées de type 2 : </span> <i>{{$report->total_number_type_2_weighings}}</i> </p>
                                    <p> <span style="font-weight: 250">Nombre total de factures à facturer :</span>  <i>{{$report->number_invoice_to_be_billed}}</i> </p>
                                    <p> <span style="font-weight: 250">Nombre total de factures payés cash :</span>  <i>{{$report->number_cash_invoices}}</i> </p>
                                    <p> <span style="font-weight: 250">Montant total à verser : </span> <i>{{$report->amount_pay}}</i>  </p>
                                </td>
                            </tr>
                        </table>
                        <p><em>–  Cordialement.</em></p>
                        <p>{{auth()->user()->name}}.</em></p>
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
                        <p>Envoyé par l'application <a href="https://www.bfclimited.com/">GOP</p>
                        <p><a href="javascript:void(0)"></a></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>