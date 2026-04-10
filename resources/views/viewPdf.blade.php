<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon"/>
    <title>Facture</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>  
    <main class="main-wrapper d-flex justify-beetwen">
      <!-- ========== section start ========== -->
      <section>
        <div class="container-fluid">
          <!-- Invoice Wrapper Start -->
          <div class="invoice-wrapper">
            <div class="row">
              <div class="col-12">
                <div class="invoice-card card-style mb-30">
                  <div class="invoice-header">
                    <div class="invoice-for">
                        <img src="assets/images/logo/logo-dpws.png" alt="logo" />
                      <p style="margin-left: 10px" class="fw-bold"> www.dpws.cm </p>
                    </div>
                    <div>
                        {{-- <p class="fw-bold mt-3"> FACTURE ACQUITTEE N° 00358 </p> --}}
                    </div>
                    <div class="invoice-date mt-1">
                      <p class="fw-bold" >Facture acquitté N°: 0031951</p>
                      
                      <p class="fw-bold mt-2" >Pont bascule N° P10</p>
                    </div>
                  </div>
                  <div class="invoice-address">
                        <div class="address-item">
                        <h5>Reçu de <span class="text-medium" >Oumarou</span></h5>
                        </div>
                  </div>
                  <div class="invoice-address">
                        <div class="address-item">
                            <h5>Droit de pesage attelage : N° Tracteur </h5>
                        </div>
                        <div class="address-item">
                            <h5 class="text-bold">N° Remorque</h5>
                          </div>
                  </div>
                  <div class="invoice-address">
                    <div class="address-item">
                        <h5>Mode de paiement : Espèce</h5>
                    </div> 
                  </div> 
                  <div class="table-responsive">
                    <table class="invoice-table table">
                      <thead>
                        <tr>
                          <th class="service">
                            <h6 class="text-sm text-medium"></h6>
                          </th>
                          <th class="desc">
                            <h6 class="text-sm text-medium"></h6>
                          </th>
                          <th class="qty">
                            <h6 class="text-sm text-medium"></h6>
                          </th>
                          <th class="amount">
                            <h6 class="text-sm text-medium"></h6>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <p class="text-sm text-bold">Chef de Geurite</p>
                          </td>
                          <td>
                            <p class="text-sm">
                            </p>
                          </td>
                          <td>
                            <p class="text-sm text-bold">Montant HT :</p>
                          </td>
                          <td>
                            <p class="text-sm text-bold">FCFA</p>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <p class="text-sm fw-bold"> nom du chef de guerite</p>
                          </td>
                          <td>
                            <p class="text-sm">
                              
                            </p>
                          </td>
                          <td>
                            <p class="text-sm fw-bold">TVA 19.25% :</p>
                          </td>
                          <td>
                            <p class="text-sm fw-bold">FCFA</p>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <p class="text-sm"></p>
                          </td>
                          <td>
                            <p class="text-sm">
                            </p>
                          </td>
                          <td>
                            <p class="text-sm fw-bold">Montant TTC :</p>
                          </td>
                          <td>
                            <p class="text-sm fw-bold">FCFA</p>
                          </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td>
                            <h6 class="text-sm fw-bold">Montant versé :</h6>
                          </td>
                          <td>
                            <h6 class="text-sm fw-bold">FCFA</h6>
                          </td>
                        </tr>
                        <tr>
                           {{-- <td> </td> --}}
                           <td></td>
                          <td></td>
                          <td>
                            <h6 class="text-sm fw-bold">Reste à rembourser :</h6>
                          </td>
                          <td>
                            <h6 class="text-sm fw-bold">FCFA</h6>
                          </td>
                        </tr>
                    </tbody>
                    <img class="lotecs sticky-bottom" src="assets/images/logo/lotecs.png" alt="logo">
                </table>
                <p class="fw-bold" style="margin-top:150px;" >Douala le </p> 
                <span class="maligne"></span>
                  </div>
                <p style="font-size: 15px" class="text-uppercase text-muted" >Douala Port Weighing Services SAS CAPITAL VARIABLE DE 50 000 000 XAF RCCM RC / DLA / 2019 / b / 5453 NUI M121914355936 L</p>
                <P style="font-size: 15px" class="text-uppercase text-muted" >Siège Social : Bonapriso, Lieu dit Ancien dépôt Guinness - Douala B.P 12209 00237 650 911 000/ 695 502 502 contact@dpws.cm dpws.cm</P>
                <p style="font-size: 15px" class="text-uppercase text-muted" >Compte Afriland First Bank réf : 10005 00002 06463841002 52 swift : cceicmcx iban : cm21 100005 0000206463841002 52</p>
                </div>
                <!-- End Card -->
              </div>
              <!-- ENd Col -->
            </div>
            <!-- End Row -->
          </div>
          <!-- Invoice Wrapper End -->
        </div>
        <!-- end container -->
      </section>

    </main>
    
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
