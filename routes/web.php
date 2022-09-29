<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['web'])->domain(env('APP_URL'))->group(function() {

  Route::get('/', [App\Http\Controllers\frontend\HomeController::class, 'index'])->name('home');

  Route::get('/about', [App\Http\Controllers\frontend\AboutController::class, 'index'])->name('about');

  Route::get('/affiliate', [App\Http\Controllers\frontend\AffiliateController::class, 'index'])->name('affiliate');
  Route::post('/affiliate', [App\Http\Controllers\frontend\AffiliateController::class, 'AffiliateInsert'])->name('affiliate');

  Route::get('/blogs', [App\Http\Controllers\frontend\BlogController::class, 'index'])->name('blogs');

  Route::get('/blogdetail/{id}', [App\Http\Controllers\frontend\BlogController::class, 'blogdetail'])->name('blogdetail');
  Route::get('/blogdetail/blogdetail/{id}', [App\Http\frontend\Controllers\BlogController::class, 'blogdetail'])->name('blogdetail');

  Route::get('/application-form', [App\Http\Controllers\frontend\ApplicationController::class, 'index'])->name('application-form');
  Route::post('/application-form', [App\Http\Controllers\frontend\ApplicationController::class, 'ApplicationInsert'])->name('application-form');

  Route::get('/constructions', [App\Http\Controllers\frontend\ConstructionController::class, 'index'])->name('constructions');
  Route::get('/book-inspection', [App\Http\Controllers\frontend\BookInspectionController::class, 'index'])->name('book-inspection');
   Route::post('/book-inspection', [App\Http\Controllers\frontend\BookInspectionController::class, 'BookingInsert'])->name('book-inspection');

  Route::get('/cis-form', [App\Http\Controllers\frontend\CisFormController::class, 'index'])->name('cis-form');
   Route::post('/cis-form', [App\Http\Controllers\frontend\CisFormController::class, 'CisInsert'])->name('cis-form');

  Route::get('/contact', [App\Http\Controllers\frontend\ContactController::class, 'index'])->name('contact');
  Route::post('/contact', [App\Http\Controllers\frontend\ContactController::class, 'Contactinsert'])->name('contact');
  Route::get('/gallery', [App\Http\Controllers\frontend\GalleryController::class, 'index'])->name('gallery');

  Route::get('/consultancy', [App\Http\Controllers\frontend\ConsultancyController::class, 'index'])->name('consultancy');

  Route::get('/lifting-form', [App\Http\Controllers\frontend\LiftingFormController::class, 'index'])->name('lifting-form');

  Route::get('/consultants-form', [App\Http\Controllers\frontend\ConsultantsFormController::class, 'index'])->name('consultants-form');
Route::post('/consultants-form', [App\Http\Controllers\frontend\ConsultantsFormController::class, 'ConsultantsInsert'])->name('consultants-form');
  Route::get('/estate-detail', [App\Http\Controllers\frontend\EstatedetailController::class, 'index'])->name('estate-detail');

  Route::get('/our-work', [App\Http\Controllers\frontend\OurWorkController::class, 'index'])->name('our-work');

  Route::get('/our-estate', [App\Http\Controllers\frontend\OurEstateController::class, 'index'])->name('our-estate');

  Route::get('/site-form', [App\Http\Controllers\frontend\SiteFormController::class, 'index'])->name('site-form');
  Route::post('/site-form', [App\Http\Controllers\frontend\SiteFormController::class, 'SiteInsert'])->name('site-form');

  Route::get('/property-form', [App\Http\Controllers\frontend\PropertySearchController::class, 'index'])->name('property-form');
  Route::post('/property-form', [App\Http\Controllers\frontend\PropertySearchController::class, 'propertyInsert'])->name('property-form');

  Route::get('/real-estate', [App\Http\Controllers\frontend\RealEstateController::class, 'index'])->name('real-estate');

  Route::get('/career', [App\Http\Controllers\frontend\CareerController::class, 'index'])->name('career');
  Route::get('/services', [App\Http\Controllers\frontend\ServicesController::class, 'index'])->name('services');
  Route::get('/energys', [App\Http\Controllers\frontend\EnergyController::class, 'index'])->name('energys');
  Route::get('/logistics', [App\Http\Controllers\frontend\LogisticController::class, 'index'])->name('logistics');
  Route::get('/agricultures', [App\Http\Controllers\frontend\AgricultureController::class, 'index'])->name('agricultures');
  Route::get('/minerals', [App\Http\Controllers\frontend\MineralController::class, 'index'])->name('minerals');
  Route::get('/medicals', [App\Http\Controllers\frontend\MedicalController::class, 'index'])->name('medicals');
  Route::get('/resetpassword', [\App\Http\Controllers\frontend\ResetPasswordController::class, 'admin'])->name('resetpassword');
  Route::post('/resetpassword', [App\Http\Controllers\frontend\ResetPasswordController::class ,'Resetpasswordlink'])->name('resetpassword');
  Route::get('/createnewpassword', [\App\Http\Controllers\frontend\ResetPasswordController::class, 'NewPasswordForm'])->name('createnewpassword');
  Route::post('/createnewpassword', [App\Http\Controllers\frontend\ResetPasswordController::class ,'CreateNewPassword'])->name('createnewpassword');

  Route::get('/admin/login', [App\Http\Controllers\frontend\LoginController::class, 'admin'])->name('login');
  Route::post('/admin/login', [App\Http\Controllers\frontend\LoginController::class, 'checklogin'])->name('login.checklogin');
  Route::post('/', [App\Http\Controllers\frontend\HomeController::class, 'NewsInsert'])->name('home');
  Route::post('/', [App\Http\Controllers\frontend\ContactController::class, 'ContactInsert'])->name('home');
});


Route::middleware(['web','auth','admin'])->domain(env('APP_URL'))->group(function() {
  
  Route::post('/admin/logout', [App\Http\Controllers\admin\LogoutController::class, 'logout'])->name('logout');
  Route::get('/admin/dashboard', [App\Http\Controllers\admin\DashboardController::class, 'admin'])->name('dashboard');

  Route::controller(App\Http\Controllers\admin\UserController::class)->group(function () {
   Route::get('/admin/viewuser', 'admin')->name('viewuser');
    Route::post('/admin/adduser', 'adduser')->name('adduser');
     Route::post('/admin/updateuser','Update')->name('updateuser');

    Route::post('/admin/deleteuser/{id}','DeleteUser')->name('deleteuser');
    /* Granting access to a user */
    Route::post('/admin/createAllow/{id}','GrantCreateAccess')->name('createAllow');
    Route::post('/admin/viewAllow/{id}','GrantViewAccess')->name('viewAllow');
    Route::post('/admin/updateAllow/{id}','GrantUpdateAccess')->name('updateAllow');
    Route::post('/admin/deleteAllow/{id}','GrantDeleteAccess')->name('deleteAllow');

    /* Denying  access to a user Route*/
    Route::post('/admin/createDeny/{id}','DenyCreateAccess')->name('createDeny');
    Route::post('/admin/viewDeny/{id}','DenyViewAccess')->name('viewDeny');
    Route::post('/admin/updateDeny/{id}','DenyUpdateAccess')->name('updateDeny');
    Route::post('/admin/deleteDeny/{id}','DenyDeleteAccess')->name('deleteDeny');
    /* The end Denying  access to a user Route*/
  });
  Route::controller(App\Http\Controllers\admin\AffiliateTableController::class)->group(function () {
    Route::get('/admin/affiliates', 'admin')->name('affiliates');
    Route::get('/admin/editaffiliate/{id}', 'editForm')->name('editaffiliate/{id}');
    Route::post('/admin/editaffiliate/{id}', 'Edit')->name('editaffiliate/{id}');
    Route::post('/admin/affiliate/{id}','delete')->name('delete');
 });

  Route::controller(App\Http\Controllers\admin\BookingTableController::class)->group(function () {
    Route::get('/admin/booking', 'admin')->name('booking');
    Route::get('/admin/bookinspection', 'BookingForm')->name('bookinspection');
    Route::post('/admin/bookinspection','InsertBookingForm')->name('bookinspection');
    Route::get('/admin/viewbooking/{id}', 'viewBooking')->name('viewbooking/{id}');
    Route::get('/admin/editbooking/{id}', 'editForm')->name('editbooking/{id}');
    Route::post('/admin/editbooking/{id}', 'Edit')->name('editbooking/{id}');
    Route::post('/admin/booking/{id}', 'delete')->name('delete');
  });


  Route::controller(App\Http\Controllers\admin\ContactTableController::class)->group(function () {
    Route::get('/admin/contacts', 'admin')->name('contacts');
    Route::get('/admin/editcontact/{id}', 'editForm')->name('editcontact/{id}');
    Route::post('/admin/editcontact{id}', 'Edit')->name('editcontact/{id}');
    Route::post('/admin/contact/{id}', 'delete')->name('delete');

  });

  Route::controller(App\Http\Controllers\admin\CISTableController::class)->group(function () {
    Route::get('/admin/cis', 'admin')->name('cis');
    Route::get('/admin/cisform', 'CISForm')->name('cisform');
    Route::post('/admin/cisform','CisInsert')->name('cisform');
    Route::get('/admin/viewcis/{id}','viewCIS')->name('viewcis/{id}');
    Route::get('/admin/editcis/{id}', 'editForm')->name('editcis/{id}');
    Route::post('/admin/editcis/{id}', 'Edit')->name('editcis/{id}');
    Route::post('/admin/cis/{id}', 'delete')->name('delete');
  });

  Route::controller(App\Http\Controllers\admin\PSRTableController::class)->group(function () {
    Route::get('/admin/psr', 'admin')->name('property');
    Route::get('/admin/propertyform', 'PSRForm')->name('propertyform');
    Route::post('/admin/propertyform', 'InsertPSR')->name('propertyform');
    Route::get('/admin/viewproperty/{id}', 'viewPSRT')->name('viewproperty/{id}');
    Route::get('/admin/editproperty/{id}', 'editForm')->name('editproperty/{id}');
    Route::post('/admin/editproperty/{id}', 'Edit')->name('editproperty/{id}');
    Route::post('/admin/propertysearch/{id}', 'delete')->name('delete');
  });

  Route::controller(App\Http\Controllers\admin\SiteInspectionTableController::class)->group(function () {
    Route::get('/admin/inspection', 'admin')->name('inspection');
    Route::get('/admin/siteform', 'siteInpectionForm')->name('siteform');
    Route::post('/admin/siteform','InsertSiteInspection')->name('siteform');
    Route::get('/admin/viewinspection/{id}', 'viewInspectionTable')->name('viewinspection/{id}');
    Route::get('/admin/editsiteinspection/{id}', 'editForm')->name('editsiteinspection/{id}');
    Route::post('/admin/editsiteinspection/{id}', 'Edit')->name('editsiteinspection/{id}');
    Route::post('/admin/inspection/{id}', 'delete')->name('delete');
    });


  Route::controller(App\Http\Controllers\admin\ApplicationTableController::class)->group(function () {
    Route::get('/admin/application',  'admin')->name('application');
    Route::get('/admin/applicationforms', 'ApplicationForm')->name('applicationforms');
    Route::post('/admin/applicationforms','InsertApplicationForm')->name('applicationforms');
    Route::post('/admin/editapplication/{id}', 'Edit')->name('editapplication/{id}');
    Route::get('/admin/editapplication/{id}', 'editForm')->name('editapplication/{id}');
    Route::post('/admin/application/{id}', 'delete')->name('delete');
  });

  Route::controller(App\Http\Controllers\admin\ShopController::class)->group(function () {
    Route::get('/admin/portifolio', 'admin')->name('portifolio');
    Route::get('/admin/addportifolio', 'addShopForm')->name('addportifolio');
    Route::post('/admin/addportifolio', 'PortifolioInsert')->name('addportifolio');
    Route::get('/admin/editportifolio/{id}', 'editForm')->name('editportifolio/{id}');
    Route::post('/admin/editportifolio/{id}','Edit')->name('editportifolio/{id}');
    Route::get('/admin/viewportifolio/{id}', 'viewShop')->name('viewportifolio/{id}');
    Route::post('/admin/portifolio/{id}', 'delete')->name('delete');
  });

  Route::controller(App\Http\Controllers\admin\ConstructionTableController::class)->group(function () {
    Route::get('/admin/constructiontable', 'admin')->name('constructiontable');
    Route::get('/admin/addconstruction', 'addConstructionForm')->name('addconstruction');
    Route::post('/admin/addconstruction', 'ConstructionInsert')->name('addconstruction');
    Route::post('/admin/editconstruction/{id}', 'Edit')->name('editconstruction/{id}');
    Route::get('/admin/viewconstruction/{id}', 'viewConstruction')->name('viewconstruction/{id}');
    Route::get('/admin/editconstruction/{id}', 'editForm')->name('editconstruction/{id}');
    Route::post('/admin/constructiontable/{id}', 'delete')->name('delete');
  });
  Route::controller(App\Http\Controllers\admin\ConsultantsFormTableController::class)->group(function () {
    Route::get('/admin/consultant', 'admin')->name('consultant');
    Route::get('/admin/consultantform', 'ConsultantForm')->name('consultantform');
    Route::post('/admin/consultantform','InsertConsultantForm')->name('consultantform');
    Route::get('/admin/viewconsultant/{id}', 'viewConsultant')->name('viewconsultant/{id}');
    Route::get('/admin/editconsultant/{id}', 'editForm')->name('editconsultant/{id}');
    Route::post('/admin/editconsultant/{id}', 'Edit')->name('editconsultant/{id}');
    Route::post('/admin/consultants/{id}', 'delete')->name('delete');
  });
  Route::controller(App\Http\Controllers\admin\ConsultancyPageTableController::class)->group(function () {
    Route::get('/admin/consultancytable', 'admin')->name('consultancytable');
    Route::get('/admin/addconsultancy', 'addConsultancyForm')->name('addconsultancy');
    Route::post('/admin/addconsultancy', 'ConsultancyInsert')->name('addconsultancy');
    Route::get('/admin/editconsultancy/{id}', 'editForm')->name('editconsultancy');
    Route::post('/admin/editconsultancy/{id}', 'Edit')->name('editconsultancy');
    Route::get('/admin/viewconsultancy/{id}', 'viewConsultancy')->name('viewconsultancy');
    Route::post('/admin/consultancytable/{id}', 'delete')->name('delete');
  });

  Route::controller(App\Http\Controllers\admin\EstateTableController::class)->group(function () {
    Route::get('/admin/estatetable', 'admin')->name('estatetable');
    Route::get('/admin/addestate', 'addEstateForm')->name('addestate');
    Route::post('/admin/addestate', 'estateInsert')->name('addestate');
    Route::post('/admin/editestate/{id}', 'Edit')->name('editestate/{id}');
    Route::get('/admin/viewestate/{id}', 'viewEstate')->name('viewestate');
    Route::get('/admin/editestate/{id}', 'editForm')->name('editestate/{id}');
    Route::post('/admin/estatetable/{id}', 'delete')->name('delete');
  });
  Route::controller(App\Http\Controllers\admin\MineralTableController::class)->group(function () {
    Route::get('/admin/mineraltable', 'admin')->name('mineraltable');
    Route::get('/admin/addmineral',  'addMineralForm')->name('addmineral');
    Route::post('/admin/editmineral/{id}', 'Edit')->name('editmineral/{id}');
    Route::post('/admin/addmineral', 'MineralInsert')->name('addmineral');
    Route::get('/admin/viewmineral/{id}', 'viewMineral')->name('viewmineral/{id}');
    Route::get('/admin/editmineral/{id}','editForm')->name('editmineral/{id}');
    Route::post('/admin/mineral/{id}', 'delete')->name('delete');
  });

  Route::controller(App\Http\Controllers\admin\MedicalTableController::class)->group(function () {
    Route::get('/admin/medicaltable', 'admin')->name('medicaltable');
    Route::get('/admin/addmedical', 'addMedicalForm')->name('addmedical');
    Route::post('/admin/addmedical', 'MedicalInsert')->name('addmedical');
    Route::post('/admin/editmedical/{id}', 'Edit')->name('editmedical/{id}');
    Route::get('/admin/viewmedical/{id}', 'viewMedical')->name('viewmedical/{id}');
    Route::get('/admin/editmedical/{id}','editForm')->name('editmedical/{id}');
    Route::post('/admin/medical/{id}', 'delete')->name('delete');
  });

  Route::controller(App\Http\Controllers\admin\AgricultureTableController::class )->group(function () {
    Route::get('/admin/agriculture', 'admin')->name('agriculturetable');
    Route::get('/admin/addagriculture', 'addAgricultureForm')->name('addagriculture');
    Route::post('/admin/addagriculture', 'AgricultureInsert')->name('addagriculture');
    Route::post('/admin/editagriculture/{id}','Edit')->name('editagriculture/{id}');
    Route::get('/admin/viewagriculture/{id}', 'viewAgriculture')->name('viewagriculture/{id}');
    Route::get('/admin/editagriculture/{id}', 'editForm')->name('editagriculture/{id}');
    Route::post('/admin/agriculture/{id}', 'delete')->name('delete');
  });

  Route::controller(App\Http\Controllers\admin\LogisticTableController::class)->group(function () {
    Route::get('/admin/logistictable', 'admin')->name('logistictable');
    Route::get('/admin/addlogistic',  'addLogisticForm')->name('addlogistic');
    Route::post('/admin/addlogistic', 'LogisticInsert')->name('addlogistic');
    Route::post('/admin/editlogistic/{id}', 'Edit')->name('editlogistic/{id}');
    Route::get('/admin/viewlogistic/{id}', 'viewLogistic')->name('viewlogistic/{id}');
    Route::get('/admin/editlogistic/{id}', 'editForm')->name('editlogistic/{id}');
    Route::post('/admin/logistic/{id}', 'delete')->name('delete');
  });
  Route::controller(App\Http\Controllers\admin\EnergyTableController::class)->group(function () {
    Route::get('/admin/energy', 'admin')->name('energy');
    Route::get('/admin/addenergy', 'addEnergyForm')->name('addenergy');
    Route::post('/admin/addenergy', 'EnergyInsert')->name('addenergy');
    Route::post('/admin/editenergy/{id}', 'Edit')->name('editenergy');
    Route::get('/admin/viewenergy/{id}', 'viewEnergy')->name('viewenergy');
    Route::get('/admin/editenergy/{id}', 'editForm')->name('editenergy');
    Route::post('/admin/energy/{id}', 'delete')->name('delete');
  });
  Route::controller(App\Http\Controllers\admin\AboutTableController::class)->group(function () {
    Route::get('/admin/abouttable', 'admin')->name('abouttable');
    Route::get('/admin/addabout',  'addAboutForm')->name('addabout');
    Route::post('/admin/addabout', 'AboutInsert')->name('addabout');
    Route::post('/admin/editabout/{id}', 'Edit')->name('editabout/{id}');
    Route::get('/admin/viewabout/{id}', 'viewAbout')->name('viewabout/{id}');
    Route::get('/admin/editabout/{id}', 'editForm')->name('editabout/{id}');
    Route::post('/admin/about/{id}', 'delete')->name('delete');

  });
   Route::controller(App\Http\Controllers\admin\BlogTableController::class)->group(function () {
    Route::get('/admin/blog', ['admin'])->name('blog');
    Route::get('/admin/blogpost', ['addBlogForm'])->name('blogpost');
    Route::post('/admin/blogpost', ['BlogInsert'])->name('blogpost');
    Route::get('/admin/editblog/{id}', ['editForm'])->name('editblog/{id}');
    Route::post('/admin/editblog/{id}', ['Edit'])->name('editblog/{id}');
    Route::get('/admin/viewblog/{id}', ['viewBlogTable'])->name('viewblog/{id}');
    Route::post('/admin/blogpost/{id}', ['delete'])->name('delete');

    
  });

});

Route::middleware(['web', 'auth'])->get('/admin/dashboard', function () {
  if (auth()->check()) {
    $role = auth()->user()->role;
    switch ($role) {
      case 'manager':
      $sudomain = 'manager';
      break;
      default:
      $sudomain = 'admin';
      break;
    }

    return redirect()->route("{$sudomain}.dashboard");
  }

  return redirect()->route('home');

})->name('dashboard');

Route::fallback(function () {
  Route::middleware(['web'])->domain('https://www.geohomesgroup.com')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
  });

  return redirect()->route('home');
});






