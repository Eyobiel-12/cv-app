<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
//Route::get('/', function(){
//   return "<h1> Server connect successfully done!</h1>";
//};

//Page routes
Route::get('/', [HomeController::class, 'page']);
Route::get('/projects', [ProjectController::class, 'page']);
Route::get('/resume', [ResumeController::class, 'page']);
Route::get('/contact', [ContactController::class, 'page']);
Route::get('/services', function () {
    return view('pages.services');
});


// Admin auth routes - zorg dat deze routes altijd toegankelijk zijn
Route::get('/admin', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin', [AuthController::class, 'adminLogin'])->name('admin.login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard routes - geen middleware meer, controle in controller
Route::prefix('dashboard')->group(function () {
    // Hoofddashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // CV beheer
    Route::post('/resume', [DashboardController::class, 'updateResume'])->name('resume.update');
    Route::post('/resume/password', [DashboardController::class, 'updatePassword'])->name('resume.password.update');
    Route::delete('/resume', [DashboardController::class, 'deleteResume'])->name('resume.delete');
    Route::get('/check-password', [DashboardController::class, 'checkPasswordStatus'])->name('resume.password.check');
    
    // Download statistieken
    Route::get('/downloads', [DashboardController::class, 'downloadStats'])->name('dashboard.downloads');
    
    // Contact berichten
    Route::get('/contacts', [DashboardController::class, 'contacts'])->name('dashboard.contacts');
    Route::delete('/contacts/{id}', [DashboardController::class, 'deleteContact'])->name('dashboard.contacts.delete');
    
    // Projecten beheer
    Route::get('/projects', [ProjectController::class, 'dashboardProjects'])->name('dashboard.projects');
    Route::post('/projects', [ProjectController::class, 'createProject'])->name('dashboard.projects.create');
    Route::put('/projects/{id}', [ProjectController::class, 'updateProject'])->name('dashboard.projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'deleteProject'])->name('dashboard.projects.delete');
    
    // Programmeertalen beheer
    Route::post('/programming-languages', [ProjectController::class, 'createProgrammingLanguage'])->name('dashboard.programming-languages.create');
    Route::delete('/programming-languages/{id}', [ProjectController::class, 'deleteProgrammingLanguage'])->name('dashboard.programming-languages.delete');
});

//All GET request from DB
Route::get('/getAllContacts', [ContactController::class, 'getAllContacts']);
Route::get('/getAaboutDetails', [HomeController::class, 'getAaboutDetails']);
Route::get('/getEducationDetails', [ResumeController::class, 'getEducationDetails']);
Route::get('/getExperienceDetails', [ResumeController::class, 'getExperienceDetails']);
Route::get('/getHeroproperties', [HomeController::class, 'getHeroproperties']);
Route::get('/getLanguageDetails', [ResumeController::class, 'getLanguageDetails']);
Route::get('/getProfessionalSkill', [ResumeController::class, 'getProfessionalSkill']);
Route::get('/getAllProjectDetails', [ProjectController::class, 'getAllProjectDetails']);
Route::get('/getResumeLink', [ResumeController::class, 'getResumeLink']);
Route::get('/getSeoProperties', [HomeController::class, 'getSeoProperties']);
Route::get('/getSocialLinks', [HomeController::class, 'getSocialLinks']);
Route::get('/getResumeInfo', [ResumeController::class, 'getResumeInfo']);
Route::get('/getResumeDownloadStats', [ResumeController::class, 'getResumeDownloadStats']);

//All Post Request from DB
Route::post('/postAaboutDetails', [HomeController::class, 'postAaboutDetails']);
Route::post('/postAContact', [ContactController::class, 'postAContact']);
Route::post('/postEducationDetails', [ResumeController::class, 'postEducationDetails']);
Route::post('/postExperienceDetails', [ResumeController::class, 'postExperienceDetails']);
Route::post('/postHeroproperties', [HomeController::class, 'postHeroproperties']);
Route::post('/postLanguageDetails', [ResumeController::class, 'postLanguageDetails']);
Route::post('/postProfessionalSkill', [ResumeController::class, 'postProfessionalSkill']);
Route::post('/postSingleProjectDetails', [ProjectController::class, 'postSingleProjectDetails']);
Route::post('/postResumeLink', [ResumeController::class, 'postResumeLink']);
Route::post('/postSeoProperties', [HomeController::class, 'postSeoProperties']);
Route::post('/postSocialLinks', [HomeController::class, 'postSocialLinks']);

// Resume file upload and download routes
Route::post('/uploadResumeFile', [ResumeController::class, 'uploadResumeFile']);
Route::post('/downloadResume', [ResumeController::class, 'downloadResume']);

Route::post('/lang-switch', function() {
    $lang = request('lang');
    if (in_array($lang, ['en', 'nl'])) {
        Session::put('locale', $lang);
        App::setLocale($lang);
    }
    return back();
})->name('lang.switch');

