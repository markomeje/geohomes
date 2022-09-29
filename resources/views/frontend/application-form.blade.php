      @include('layout.header')
<title>GeoHomes | Application</title>
</head>

<body>
    <!-- Header -->
      @include('layout.navbar')
    </header>
 <!--? Hero Start -->
        <div class="slider-area2 section-bg2" data-background="assets/img/materials/application-form-banner.jpg">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2">
                                <h2>Application Form</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <!-- booking Form starts here -->
                  <div class="container">
                 <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title mt-30 padding-40" style="">Please fill the form below</h2>
                    </div>
                  </div>

                          <!-- it gives feedback messages -->
                                   <div>
                                  @if(session()->has('success'))
                                  <div class="alert alert-success">{{session()->get('success')}}</div>

                                  @elseif(session()->has('error'))
                                  <div class="alert alert-danger">{{session()->get('error')}}</div>
                                  
                                   @endif

                                </div>

                                      <!-- feedback message ends here -->

                        <form class="form-contact contact_form" action="{{route('application-form')}}" method="POST" novalidate="novalidate">
                            <div class="row">
                               
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
                                         <span class="text-danger">{{$errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                     <div class="form-group">
                                        <input class="form-control valid" name="surname" id="surname" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Surname'" placeholder="Surname">
                                        <span class="text-danger">{{$errors->first('surname') }}</span>
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
                                       <input class="form-control valid" name="date_of_birth" id="date_of_birth" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'date of birth'" placeholder="Date Of Birth">
                                       <span class="text-danger">{{$errors->first('date_of_birth') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="gender" id="gender" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'gender'" placeholder="gender">
                                        <span class="text-danger">{{$errors->first('gender') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="marital_status" id="marital_status" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Marital Status'" placeholder="Marital Status">
                                       <span class="text-danger">{{$errors->first('marital_status') }}</span>
                                    </div>
                                </div>
                                    <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="state" id="state" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'state'" placeholder="State">
                                       <span class="text-danger">{{$errors->first('state') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                    <input class="form-control valid" name="country" id="country" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'country'" placeholder="Country">
                                    <span class="text-danger">{{$errors->first('state') }}</span>
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
                                       <input class="form-control valid" name="local_government_area" id="local_government_area" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'local government area'" placeholder="Local Government Area">
                                       <span class="text-danger">{{$errors->first('local_government_area') }}</span>
                                    </div>
                                </div>
                                    <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="organization" id="organization" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'organization'" placeholder="Organization">
                                       <span class="text-danger">{{$errors->first('organization') }}</span>
                                    </div>
                                </div>
                                   <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="office_address" id="country" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'office address'" placeholder="Office Address">
                                       <span class="text-danger">{{$errors->first('office_address') }}</span>
                                    </div>
                                </div>
                                    <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                       <input class="form-control valid" name="property_type" id="service" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'property type'" placeholder="Property Type">
                                       <span class="text-danger">{{$errors->first('property_type') }}</span>
                                    </div>
                                </div>
                           <div class="col-sm-6 col-lg-12 submit-info mb-40">
                             <button class="submit-btn2" type="submit" style="background-color:#0EA15F; margin-left:none; border-radius: 10px;">Submit Form</button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        </div>
<!--
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

            @if($message = Session::get('first'))
            <div class="alert alert-danger">
            <p style="color:red;">{{$message}}</p>
            </div>
            @endif
            feedback message ends here 
    <div class="row">

      <div class="col-lg-6 col-md-6 col-sm-12">

            <div class="form-group">
            <p>Full Name <span>*</span></p>
        <input type="text" name="name" id="prenom" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ 'Prénom' doit être renseigné."required=""/>
                <div class="validation"></div>
      </div>
      <div class="form-group">
              <p>Surname<span>*</span></p>
                <input type="text" name="surname" id="nom" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ 'Nom' doit être renseigné."required=""/>
                <div class="validation"></div>
       </div> 

       <div class="form-group">
      <p>Phone number <span>*</span></p>  
        <input type="text" name="phone" id="phone" data-rule="maxlen:10" data-msg="Vérifiez votre saisie sur les champs : Le champ 'Téléphone' doit être renseigné. Minimum 10 chiffres"required=""/>
                <div class="validation"></div>
      </div>

      <div class="form-group">
      <p>E-mail <span>*</span></p>  
      <input type="email" name="email" id="email" data-rule="email" data-msg="Vérifiez votre saisie sur les champs : Le champ 'E-mail' est obligatoire."required=""/>
       <div class="validation"></div>
      </div>  

      <div class="form-group">
      <p>Date of Birth <span>*</span></p>
        <input type="date" name="date_of_birth" id="society" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ 'Société' doit être renseigné."required=""/>
         <div class="validation"></div>
      </div>

      <div class="form-group">
      <p>Gender <span>*</span></p>
        <input type="text" name="gender" id="ville" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ 'Ville' doit être renseigné." placeholder="Male/Female/Other" required=""/>
         <div class="validation"></div>
      </div> 

        <div class="form-group">
      <p>Marital Status<span>*</span></p>
        <input type="text" name="marital_status" id="ville" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ 'Ville' doit être renseigné." placeholder="single/married/ etc" required=""/>
         <div class="validation"></div>  
      </div>
  </div>

   <div class="col-lg-6 col-md-6 col-sm-12"> 
      <div class="form-group">
      <p>State<span>*</span></p>
        <input type="text" name="state" id="ville" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ 'Ville' doit être renseigné."required=""/>
                <div class="validation"></div>
      </div>  

       <div class="form-group">
      <p>Country<span>*</span></p>
        <input type="text" name="country" id="ville" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ 'Ville' doit être renseigné."required=""/>
                <div class="validation"></div>
      </div>

      <div class="form-group">
      <p> Residential Address <span>*</span></p>
        <input type="text" name="residential" id="adresse" data-rule="required" data-msg="please fill this filled"required=""/>
                <div class="validation"></div>
      </div>

      <div class="form-group">
      <p> Local Government Area<span>*</span></p>
        <input type="text" name="local_government_area" data-rule="required" data-msg="please fill this filled"required=""/>
                <div class="validation"></div>
      </div>

      <div class="form-group">
      <p>Organization / Employer<span>*</span></p>
        <input type="text" name="organization" data-rule="required" data-msg="please fill this filled"required=""/>
                <div class="validation"></div>
      </div>

     <div class="form-group">
      <p>Office Adress<span>*</span></p>
        <input type="text" name="office_address" data-rule="required" data-msg="please fill this filled"required=""/>
                <div class="validation"></div>
      </div>

      <div class="form-group">
      <p>Property Type<span>*</span></p>
      <input type="text" name="property_type" id="fonction" data-rule="required" data-msg="please fill this filled"required=""/>
      <div class="validation"></div>
      </div>
      </div>  
  </div>
  </div>
<button type="submit" class="bouton-contact mb-30 mt-0" style="width:60%;">Send</button>
</form> 
</div>
</div>
</center> -->

 @include('layout.footer')
</body>
</html>