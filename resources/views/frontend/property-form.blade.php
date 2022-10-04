 @include('layout.header')
<title>GeoHomes | Property Search</title>

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
        <div class="slider-area2 section-bg2" data-background="/assets/img/materials/client-banner.jpg">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2">
                                <h2>PSR Form</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->

    <!-- Property Search Request Form starts here -->


        <div class="container">
                 <div class="row">
                    <div class="col-12 mt-40 padding-40">
                        <h2 class="contact-title mt-30 padding-40" style="color:black">PROPERTY SEARCH REQUEST (PSR) FORM</h2>
                    </div>
                  </div>

                          <!-- it gives feedback messages -->
                                      @if($message = Session::get('success'))
                                      <div class="alert alert-suucess">
                                        <p style="color:#0EA10F;">{{$message}}</p>
                                      </div>
                                      @endif

                                      @if($message = Session::get('error'))
                                      <div class="alert alert-danger">
                                        <p style="color:red;">{{$message}}</p>
                                      </div>
                                      @endif
                                      <!-- feedback message ends here -->

                        <form class="form-contact contact_form" action="{{route('property-form')}}" method="POST" novalidate="novalidate">
                            <div class="row">
                               
                                <div class="col-sm-6 col-md-6 col-lg-4 ">
                                    <div class="form-group">
                                        <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
                                        <span class="text-danger">{{$errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 ">
                                     <div class="form-group">
                                        <input class="form-control valid" name="phone" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mobile Line'" placeholder="Mobile Line">
                                        <span class="text-danger">{{$errors->first('phone') }}</span>
                                    </div>
                                </div>
                                 
                              
                                <div class="col-sm-6 col-md-6 col-lg-4 ">
                                    <div class="form-group">
                                       <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                       <span class="text-danger">{{$errors->first('email') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 ">
                                    <div class="form-group">
                                       <input class="form-control valid" name="residential_address" id="phone" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Residential Address '" placeholder="Residential Address">
                                       <span class="text-danger">{{$errors->first('residential_address') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 ">
                                    <div class="form-group">
                                       <input class="form-control valid" name="office_address" id="office_address" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'office address'" placeholder="Office Address">
                                       <span class="text-danger">{{$errors->first('office_address') }}</span>
                                    </div>
                                </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 ">
                                    <div class="form-group">
                                       <input class="form-control valid" name="plot_number" id="plot_number" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'plot number'" placeholder="Plot Number">
                                       <span class="text-danger">{{$errors->first('plot_number') }}</span>
                                    </div>
                                </div>
                                    
                                 <div class="col-sm-6 col-md-6 col-lg-4 ">
                                    <div class="form-group">
                                       <select name="location" id="select2">
                                      <option value="Divine City">Divine City Layout</option>
                                      <option value="Beloved">Beloved Layout</option>
                                       <option value="Golden Gate" >Golden Gate</option>
                                         <option value="Precious">Precious</option>
                                        <option value="Monic " >Monic</option>
                                        <option value="Valley of Life" >Valley of Life</option>
                                         <option value="Destiny" >Destiny</option>
                                        <option value="Christa City" >Christa City</option>
                                        <option value="blue lake" >Blue lake</option>
                                         <option value="peace" >Peace</option>
                                        <option value="Agu bite" >Agu Bite</option>
                                            </select>
                                            <span class="text-danger">{{$errors->first('location') }}</span>
                                    </div>
                                </div>
                                 <div class="col-sm-6 col-md-6 col-lg-4 ">
                                    <div class="form-group">
                                    <input class="form-control valid" name="date" id="date" type="date" onfocus="this.placeholder = ''" onblur="this.placeholder = 'date'" placeholder="Inspection Date" >
                                    <span class="text-danger">{{$errors->first('date') }}</span>
                                    </div>
                                </div>
                                 <div class="col-sm-6 col-md-6 col-lg-4 ">
                                    <div class="form-group">
                                       <input class="form-control valid" name="approved_by" id="approved_by" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'approved by'" placeholder="Approved By" >
                                       <span class="text-danger">{{$errors->first('approved_by') }}</span>
                                    </div>
                                </div>
                                 <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                       <input class="form-control valid" name="customer" id="customere" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Buyer/Agent/proxy'" placeholder="Buyer/Agent/proxy">
                                       <span class="text-danger">{{$errors->first('customer') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                       <input class="form-control valid" name="survey_payment" id="payment_survey" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Cash / Bank / Not Paid'" placeholder="Cash / Bank / Not Paid">
                                       <span class="text-danger">{{$errors->first('payment_survey') }}</span>
                                    </div>
                                </div>
                                    
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                       <input class="form-control valid" name="payment_status" id="payment_status" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Cash / Bank / Not Paid'" placeholder="Cash / Bank / Not Paid">
                                       <span class="text-danger">{{$errors->first('payment_status') }}</span>
                                    </div>
                                </div>
                           <div class="col-sm-6 col-lg-4 submit-info mb-40">
                             <button class="submit-btn2" type="submit" style="background-color:#0EA15F; margin-left:none; border-radius: 5px;">Submit</button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
                        <!-- contact-form 
                        <center>
                        <div class="container">
                        <div class="form-wrapper mt-50">
                            <form id="contact-form" action="#" method="POST">

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

                                <div class="row">
                                    <div class="col-12">
                                        <p class="contact-title mt-20 padding-40 text-center" style="color:black">PROPERTY SEARCH REQUEST (PSR) FORM</p>
                                       </div>
                                         <div class="col-lg-6 col-md- col-sm-12 align-items-center">
                                        <div class="form-box user-icon mb-10">
                                            <input type="text" name="name" placeholder="Client FullName">
                                        </div>
                                        <div class="form-box email-icon mb-10">
                                            <input type="tel" name="phone" placeholder="Mobile Line">
                                        </div>
                                        <div class="form-box email-icon mb-10">
                                            <input type="email" name="email" placeholder="Email">
                                        </div>
                                        <div class="form-box email-icon mb-10">
                                            <input type="text" name="residential_address" placeholder="Residential Address">
                                        </div>
                                        <div class="form-box email-icon mb-10">
                                            <input type="text" name="office_address" placeholder="Office Address">
                                        </div>
                                          <div class="form-box email-icon mb-10">
                                            <input type="text" name="plot_number" placeholder="Plot Number">
                                        </div>
                                        <select name="location" class="select-form ml-60 mb-20" data-rule="required" >
                                        <option value="" disabled>Choose Layout</option>
                                          <option value="Divine City">Divine City Layout</option>
                                          <option value="Beloved">Beloved Layout</option>
                                           <option value="Golden Gate" >Golden Gate</option>
                                             <option value="Precious">Precious</option>
                                            <option value="Monic " >Monic</option>
                                            <option value="Valley of Life" >Valley of Life</option>
                                             <option value="Destiny" >Destiny</option>
                                            <option value="Christa City" >Christa City</option>
                                            <option value="blue lake" >Blue lake</option>
                                             <option value="peace" >Peace</option>
                                            <option value="Agu bite" >Agu Bite</option>
                                            
                                            </select>
                                    </div>
                                    
                                        <div class="col-lg-6 col-md-6 col-sm-12 align-items-center">
                                        <div class="form-box email-icon mb-10">
                                            <input type="date" name="date" placeholder="Inspection Date" required="date">
                                        </div>

                                        <div class="form-box email-icon mb-10">
                                            <input type="text" name="approved_by" placeholder="Approved By">
                                        </div>
                                       
                                       <div class="form-box user-icon mb-0">
                                     <p>Buyer/Agent/proxy</p>
                                    <input type="text" name="customer"  placeholder="Choose one" id="ville" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ 'Ville' doit être renseigné." placeholder="choose one" />
                                     <div class="validation"></div>
                                  </div> 
                                    <div class="form-box user-icon mb-0">
                                  <p>Survey payment</p>
                                    <input type="text" name="survey_payment" id="adresse" data-rule="required" data-msg="please fill this filled" placeholder="Cash / Bank / Not Paid" />
                                    <div class="validation"></div>
                                  </div>
                
                                    
                                    <div class="form-box user-icon mb-0">
                                  <p>Payment Status</p>
                                    <input type="text" name="payment_status" id="fonction" data-rule="required" data-msg="please fill this filled" placeholder="Cash / Bank / Not Paid"/>
                                    <div class="validation"></div>
                                  </div>
                                   <div class="form-box user-icon mb-10">
                                  <input type="date" name="date" placeholder="Date" required="location">
                                 </div>
                                  </div>
                                </div>
                                <div class="col-lg-12 submit-info mb-40 ml-0">
                                 <button class="submit-btn2" type="submit" style="background-color:#0EA10F; width:80%;">Submit Form</button>
                              </div>
                            </form> 
                        </div>
                    </div>
                    </center>

    <!-- Property Search Request Form End -->
@include('layout.footer')
  </body>
</html>