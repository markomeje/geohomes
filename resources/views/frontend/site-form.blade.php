  @include('layout.header')
<title>GeoHomes | Site Inspection Form</title>

<!-- Google tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-203737296-1">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-203737296-1');
</script>
<!-- end of google analytics code -->

</head>

<body>
    <!-- Header -->
      @include('layout.navbar')
    </header>
   <!--? Hero Start -->
        <div class="slider-area2 section-bg2" data-background="assets/img/materials/site-banner.jpg">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2">
                                <h2>Site Inspection Form</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->

          <div class="container">
                 <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title mt-30 padding-40" style="">Please fill the form below</h2>
                    </div>
                  </div>

                          <!-- it gives feedback messages -->
                                      @if($message = Session::get('success'))
                                      <div class="alert">
                                        <p style="color:#0EA10F;">{{$message}}</p>
                                      </div>
                                      @endif

                                      @if($message = Session::get('error'))
                                      <div class="alert">
                                        <p style="color:red;">{{$message}}</p>
                                      </div>
                                      @endif
                                      <!-- feedback message ends here -->

                        <form class="form-contact contact_form" action="{{route('site-form')}}" method="POST" novalidate="novalidate">
                            <div class="row">
                               
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
                                         <span class="text-danger">{{$errors->first('name') }}</span>
                                    </div>
                                </div>
                                 <div class="col-sm-6 col-lg-6">
                                     <div class="form-group">
                                        <input class="form-control valid" name="phone" id="phone" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mobile Line'" placeholder="Mobile Line">
                                         <span class="text-danger">{{$errors->first('phone') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                        <span class="text-danger">{{$errors->first('email') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="residential" id="residential" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'residential'" placeholder="Residential Address">
                                        <span class="text-danger">{{$errors->first('residential') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="date" id="date" type="date" onfocus="this.placeholder = ''" onblur="this.placeholder = 'date'" placeholder="Date">
                                        <span class="text-danger">{{$errors->first('date') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="plot_number" id="plot_number" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'plot number'" placeholder="Plot Number">
                                        <span class="text-danger">{{$errors->first('plot_number') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="layout" id="layout" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'layout'" placeholder="Layout">
                                        <span class="text-danger">{{$errors->first('layout') }}</span>
                                    </div>
                                </div>
                                    <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="customer" id="customere" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Buyer/Agent/proxy'" placeholder="Buyer/Agent/proxy">
                                        <span class="text-danger">{{$errors->first('customer') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="inspection_date" id="inspection_date" type="date" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Inspection date'" placeholder="Inspection date">
                                        <span class="text-danger">{{$errors->first('inspection_date') }}</span>
                                    </div>
                                </div>
                                    
                                   <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="payment_survey" id="payment_survey" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Cash / Bank / Not Paid'" placeholder="Cash / Bank / Not Paid">
                                        <span class="text-danger">{{$errors->first('payment_survey') }}</span>
                                    </div>
                                </div>
                                    
                                    <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="approved_by" id="approved_by" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'approved by'" placeholder="Approved By">
                                        <span class="text-danger">{{$errors->first('approved_by') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="payment_status" id="payment_status" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Cash / Bank / Not Paid'" placeholder="Cash / Bank / Not Paid">
                                        <span class="text-danger">{{$errors->first('payment_status') }}</span>
                                    </div>
                                </div>
                                   
                           <div class="col-sm-6 col-lg-4 submit-info mb-40">
                             <button class="submit-btn2" type="submit" style="background-color:#0EA15F; margin-left:none; border-radius: 10px;">Submit Form</button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        </div>
       
     <!-- <center>
    <div class="container">
    <div class="form-wrapper mt-50">
   <form id="contact-form" action="#" method="POST">
    <div class="row">
       <div class="col-12">

        it gives feedback messages 
           @if($message = Session::get('success'))
          <div class="alert alert-success">
           <p style="color:#0EA10F;">{{$message}}</p>
            </div>
             @endif

             @if($message = Session::get('error'))
            <div class="alert alert-danger">
            <p style="color:red;">{{$message}}</p>
            </div>
            @endif
           feedback message ends here

        <p class="contact-title mt-20 padding-10 " style="color:black">Kindly fill the Form with correct details.</p>
        </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-box user-icon mb-0">
              <p>Client Name</p>
                <input type="text" name="name" id="nom" data-rule="required" data-msg="V??rifiez votre saisie sur les champs : Le champ 'Nom' doit ??tre renseign??."/>
                <div class="validation"></div>
            </div> 
                
            
            <div class="form-box user-icon mb-0">
            <p>Phone number</p> 
              <input type="text" name="phone" id="phone" data-rule="maxlen:10" data-msg="V??rifiez votre saisie sur les champs : Le champ 'T??l??phone' doit ??tre renseign??. Minimum 10 chiffres"/>
                      <div class="validation"></div>
            </div>

              <div class="form-box user-icon mb-0">
              <p>E-mail</p>
                <input type="email" name="email" id="email" data-rule="email" data-msg="V??rifiez votre saisie sur les champs : Le champ 'E-mail' est obligatoire."/>
                      <div class="validation"></div>
                 </div> 
                 
               <div class="form-box user-icon mb-0">
              <p> Residential Address</p>
                <input type="text" name="residential" id="adresse" data-rule="required" data-msg="please fill this filled"/>
                <div class="validation"></div>
              </div>
                 <div class="form-box user-icon mb-0">
              <p> Date</p>
                <input type="date" name="date" id="adresse" data-rule="required" data-msg="please fill this filled"/>
                <div class="validation"></div>
              </div>
        
                   <div class="form-box user-icon mb-0">
                <p>Plot Number</p>
                 <input type="text" name="plot_number" id="fonction" data-rule="required" data-msg="please fill this filled"/>
                 <div class="validation"></div>
                </div>
                  </div> 

                <div class="col-lg-6 col-md-6 col-sm-12">
                   <div class="form-box user-icon mb-0">
                  <p>Layout/Location</p>
                    <input type="text" name="layout" data-rule="required" data-msg="please fill this filled"/>
                    <div class="validation"></div>
                  </div>
                  <div class="form-box user-icon mb-0">
                     <p>Buyer/Agent/proxy</p>
                    <input type="text" name="customer"  placeholder="Choose one" id="ville" data-rule="required" data-msg="V??rifiez votre saisie sur les champs : Le champ 'Ville' doit ??tre renseign??." placeholder="choose one" />
                     <div class="validation"></div>
                  </div> 

                   <div class="form-box user-icon mb-0">
                  <p>Inspection Date</p>  
                    <input type="date" name="inspection_date" id="phone" data-rule="maxlen:10" data-msg="V??rifiez votre saisie sur les champs : Le champ 'T??l??phone' doit ??tre renseign??. Minimum 10 chiffres"/>
                            <div class="validation"></div>
                  </div>
                    <div class="form-box user-icon mb-0">
                  <p>Survey payment</p>
                    <input type="text" name="payment_survey" id="adresse" data-rule="required" data-msg="please fill this filled" placeholder="Cash / Bank / Not Paid" />
                    <div class="validation"></div>
                  </div>

                    
                    <div class="form-box user-icon mb-0">
                  <p>Payment Status</p>
                    <input type="text" name="payment_status" id="fonction" data-rule="required" data-msg="please fill this filled" placeholder="Cash / Bank / Not Paid"/>
                    <div class="validation"></div>
                  </div>


                
                  <p> Approved BY</p>
                    <input type="text" name="approved_by" id="fonction" data-rule="required" data-msg="please fill this filled"/>
                    <div class="validation"></div>
                  </div>
                </div>
             <div class="col-lg-12 submit-info mb-45 ml-0">
              <button class="submit-btn2" type="submit" style="background-color:#0EA10F; width:80%;">Submit Form</button>
              </div>

            </form>
          </div>
        </div>
        </center>
                          
    <!-- Consultants Form End -->
        @include('layout.footer')
     </body>
</html>