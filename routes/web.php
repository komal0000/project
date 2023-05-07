<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\AssessmentController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ExamSubjectController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\storyController as AdminStoryController;
use App\Http\Controllers\Admin\StudentAttendanceController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\storyController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use Beta\Microsoft\Graph\Model\Group;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

//services
Route::get('service-type', [HomeController::class, 'serviceTypes'])->name('service.types');
Route::get('service-single/{service}', [HomeController::class, 'serviceSingle'])->name('service.single');

Route::get('image', [HomeController::class, 'image'])->name('image');
Route::get('page/@{type}', [HomeController::class, 'pageType'])->name('page.type');
Route::get('page/{id}', [HomeController::class, 'page'])->name('page');

Route::get('galleries', [HomeController::class, 'galleryType'])->name('gallery.type');
Route::get('gallery', [HomeController::class, 'gallery'])->name('gallery');

Route::get('teams', [HomeController::class, 'teamType'])->name('team.type');
Route::get('team/{id}', [HomeController::class, 'team'])->name('team');

Route::get('downloads', [HomeController::class, 'downloads'])->name('downloads');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

Route::get('story/{id}', [HomeController::class, 'story'])->name('story');
Route::get('storylist', [HomeController::class, 'storylist'])->name('storylist');
Route::get('news/{id}', [HomeController::class, 'news'])->name('news');
Route::get('newslist', [HomeController::class, 'newslist'])->name('newslist');

Route::get('Teamlist', [HomeController::class, 'teamlist'])->name('teamlist');
Route::get('Teamsingle', [HomeController::class, 'teamsingle'])->name('teamsingle');



Route::get('events', [HomeController::class, 'events'])->name('events');
Route::get('event/{id}', [HomeController::class, 'event'])->name('event');
Route::get('faq/', [HomeController::class, 'faq'])->name('faq');

Route::match(["POST", "GET"], 'contact', [ContactController::class, 'index'])->name('contact');

Route::prefix('student')->name('student.')->group(function () {
    Route::match(['GET', 'POST'], 'info', [StudentDashboardController::class, 'info'])->name('info');
    Route::match(['GET', 'POST'], '/@{email}', [StudentDashboardController::class, 'show'])->name('show');
});

Route::redirect('login', '/admin/login', 301)->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        route::match(['GET', 'POST'], 'login', [AuthController::class, 'login'])->name('login');
    });
    Route::middleware(['auth', 'role:1'])->group(function () {
        Route::match(['GET', 'POST'], 'upload', [DashboardController::class, 'upload'])->name('upload');

        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::match(['GET', 'POST'], '', [DashboardController::class, 'index'])->name('index');
        });
        route::match(['GET', 'POST'], 'email', [AuthController::class, 'email'])->name('email');

        Route::prefix('page')->name('page.')->group(function () {
            Route::get('@{type}', [PageController::class, 'index'])->name('index');
            Route::match(['get', 'post'], 'add/@{type}', [PageController::class, 'add'])->name('add');
            Route::match(['get', 'post'], 'render/@{type}', [PageController::class, 'render'])->name('render');
            Route::match(['get', 'post'], 'edit/{page}', [PageController::class, 'edit'])->name('edit');
            Route::match(['get', 'post'], 'del/{page}', [PageController::class, 'del'])->name('del');
            Route::match(['get', 'post'], 'delDoc', [PageController::class, 'delDoc'])->name('delDoc');
        });
        Route::prefix('event')->name('event.')->group(function () {
            Route::get('', [EventController::class, 'index'])->name('index');
            Route::match(['get', 'post'], 'add/', [EventController::class, 'add'])->name('add');
            Route::match(['get', 'post'], 'edit/{event}', [EventController::class, 'edit'])->name('edit');
            Route::match(['get', 'post'], 'del/{event}', [EventController::class, 'del'])->name('del');
        });
        Route::prefix('download')->name('download.')->group(function () {
            Route::prefix('type')->name('type.')->group(function () {
                Route::get('', [DownloadController::class, 'indexType'])->name('index');
                Route::match(['get', 'post'], 'add', [DownloadController::class, 'addType'])->name('add');
                Route::match(['get', 'post'], 'edit/{type}', [DownloadController::class, 'editType'])->name('edit');
                Route::match(['get', 'post'], 'del/{type}', [DownloadController::class, 'delType'])->name('del');
            });
            Route::get('manage/{type}', [DownloadController::class, 'index'])->name('index');
            Route::match(['get', 'post'], 'add/', [DownloadController::class, 'add'])->name('add');
            Route::match(['get', 'post'], 'del/{download}', [DownloadController::class, 'del'])->name('del');
        });
        Route::prefix('team')->name('team.')->group(function () {
            Route::prefix('type')->name('type.')->group(function () {
                Route::get('', [TeamController::class, 'indexType'])->name('index');
                Route::match(['get', 'post'], 'add', [TeamController::class, 'addType'])->name('add');
                Route::match(['get', 'post'], 'edit/{type}', [TeamController::class, 'editType'])->name('edit');
                Route::match(['get', 'post'], 'del/{type}', [TeamController::class, 'delType'])->name('del');
            });
            Route::get('manage/{type}', [TeamController::class, 'index'])->name('index');
            Route::match(['get', 'post'], 'add/@{type}', [TeamController::class, 'add'])->name('add');
            Route::match(['get', 'post'], 'del/{team}', [TeamController::class, 'del'])->name('del');
            Route::match(['get', 'post'], 'edit/{team}', [TeamController::class, 'edit'])->name('edit');
        });


        Route::prefix('service')->name('service.')->group(function () {
            Route::prefix('type')->name('type.')->group(function () {
                Route::get('', [ServiceController::class, 'indexType'])->name('index');
                Route::match(['get', 'post'], 'add', [ServiceController::class, 'addType'])->name('add');
                Route::match(['get', 'post'], 'edit/{type}', [ServiceController::class, 'editType'])->name('edit');
                Route::match(['get', 'post'], 'del/{type}', [ServiceController::class, 'delType'])->name('del');
                Route::match(['get', 'post'], 'render', [ServiceController::class, 'render'])->name('render');
            });
            Route::get('manage/{type}', [ServiceController::class, 'index'])->name('index');
            Route::match(['get', 'post'], 'add/@{type}', [ServiceController::class, 'add'])->name('add');
            Route::match(['get', 'post'], 'del/{service}', [ServiceController::class, 'del'])->name('del');
            Route::match(['get', 'post'], 'edit/{service}', [ServiceController::class, 'edit'])->name('edit');
        });
        Route::prefix('setting')->name('setting.')->group(function () {
            Route::match(['GET', 'POST'], '@{type}', [AdminSettingController::class, 'index'])->name('index');
            Route::match(['GET', 'POST'], '/homepage', [AdminSettingController::class, 'homepage'])->name('homepage');
            Route::match(['GET', 'POST'], '/contact', [AdminSettingController::class, 'contact'])->name('contact');
            Route::match(['GET', 'POST'], '/meta', [AdminSettingController::class, 'meta'])->name('meta');
            Route::match(['GET', 'POST'], '/about', [AdminSettingController::class, 'about'])->name('about');

            Route::prefix('slider')->name('slider.')->group(function () {
                Route::get('', [SliderController::class, 'index'])->name('index');
                Route::match(['get', 'post'], 'add', [SliderController::class, 'add'])->name('add');
                Route::match(['get', 'post'], 'edit/{slider}', [SliderController::class, 'edit'])->name('edit');
                Route::match(['get', 'post'], 'del/{slider}', [SliderController::class, 'del'])->name('del');
            });
            Route::prefix('popup')->name('popup.')->group(function () {
                Route::get('', [PopupController::class, 'index'])->name('index');
                Route::match(['get', 'post'], 'add', [PopupController::class, 'add'])->name('add');
                Route::match(['get', 'post'], 'render', [PopupController::class, 'render'])->name('render');
                Route::match(['get', 'post'], 'edit/{popup}', [PopupController::class, 'edit'])->name('edit');
                Route::match(['get', 'post'], 'del/{popup}', [PopupController::class, 'del'])->name('del');
                Route::match(['get', 'post'], 'status/{popup}/{status}', [PopupController::class, 'status'])->name('status');
            });

            Route::prefix('gallery')->name('gallery.')->group(function () {
                Route::prefix('type')->name('type.')->group(function () {
                    Route::get('', [GalleryController::class, 'indexType'])->name('index');
                    Route::match(['get', 'post'], 'add', [GalleryController::class, 'addType'])->name('add');
                    Route::match(['get', 'post'], 'edit/{type}', [GalleryController::class, 'editType'])->name('edit');
                    Route::match(['get', 'post'], 'del/{type}', [GalleryController::class, 'delType'])->name('del');
                });

                Route::get('manage/{type}', [GalleryController::class, 'index'])->name('index');
                Route::match(['get', 'post'], 'add', [GalleryController::class, 'add'])->name('add');
                Route::match(['get', 'post'], 'edit/{gallery}', [GalleryController::class, 'edit'])->name('edit');
                Route::match(['get', 'post'], 'del', [GalleryController::class, 'del'])->name('del');
            });


            Route::prefix('footer')->name('footer.')->group(function () {
                Route::match(['GET', 'POST'], '', [FooterController::class, 'index'])->name('index');
            });
        });

        Route::prefix('menu')->name('menu.')->group(function () {
            Route::get('', [MenuController::class, 'index'])->name('index');
            Route::match(['get', 'post'], 'add/', [MenuController::class, 'add'])->name('add');
            Route::match(['get', 'post'], 'edit', [MenuController::class, 'edit'])->name('edit');
            Route::match(['get', 'post'], 'del', [MenuController::class, 'del'])->name('del');
            Route::match(['get', 'post'], 'render', [MenuController::class, 'render'])->name('render');
        });

        Route::prefix('faq')->name('faq.')->group(function () {
            Route::get('', [FaqController::class, 'index'])->name('index');
            Route::match(['get', 'post'], 'add', [FaqController::class, 'add'])->name('add');
            Route::match(['get', 'post'], 'edit/{faq}', [FaqController::class, 'edit'])->name('edit');
            Route::match(['get', 'post'], 'del/{faq}', [FaqController::class, 'del'])->name('del');
        });


        Route::prefix('assessment')->name('assessment.')->group(function () {
            Route::match(['get', 'post'], 'add', [AssessmentController::class, 'add'])->name('add');
            Route::match(['get', 'post'], 'addPoint', [AssessmentController::class, 'addPoint'])->name('addPoint');
            Route::match(['get', 'post'], 'del', [AssessmentController::class, 'del'])->name('del');
            Route::match(['get', 'post'], 'update', [AssessmentController::class, 'update'])->name('update');
            Route::match(['get', 'post'], '', [AssessmentController::class, 'index'])->name('index');
            Route::match(['get', 'post'], 'manage', [AssessmentController::class, 'manage'])->name('manage');
        });





        Route::prefix('setting')->name('setting.')->group(function () {
            Route::match(['GET', 'POST'], 'caste', [SettingController::class, 'caste'])->name('caste');
            Route::match(['GET', 'POST'], 'category', [SettingController::class, 'category'])->name('category');
            Route::match(['GET', 'POST'], 'religion', [SettingController::class, 'religion'])->name('religion');
            Route::match(['GET', 'POST'], 'scheme', [SettingController::class, 'scheme'])->name('scheme');
            Route::prefix('academicyear')->name('academicyear.')->group(function () {
                route::get('', [AcademicYearController::class, 'index'])->name('index');
                route::post('add', [AcademicYearController::class, 'add'])->name('add');
                route::post('update', [AcademicYearController::class, 'update'])->name('update');
                route::post('delete', [AcademicYearController::class, 'delete'])->name('delete');
            });
        });
        Route::prefix('employee')->name('employee.')->group(function () {
            route::get('', [EmployeeController::class, 'index'])->name('index');
            route::match(['GET', 'POST'], 'add', [EmployeeController::class, 'add'])->name('add');
            route::match(['GET', 'POST'], 'update/{employee}', [EmployeeController::class, 'update'])->name('update');
            route::post('delete', [EmployeeController::class, 'delete'])->name('delete');
        });
        // Route::prefix('story')->name('story.')->group(function () {
        //     Route::get('', [storyController::class, 'index'])->name('index');
        //     Route::match(["GET", "POST"], 'add', [storyController::class, 'add'])->name('add');
        //     Route::match(["GET", "POST"], 'edit/{story}', [storyController::class, 'edit'])->name('edit');
        //     Route::match(["GET", "POST"], 'del/{story}', [storyController::class, 'del'])->name('del');
        // });
        Route::prefix('story')->name('story.')->group(function () {
            Route::get('', [AdminstoryController::class, 'index'])->name('index');
            Route::match(["GET", "POST"], 'add', [AdminstoryController::class, 'add'])->name('add');
            Route::match(["GET", "POST"], 'edit/{story}', [AdminstoryController::class, 'edit'])->name('edit');
            Route::match(["GET", "POST"], 'del/{story}', [AdminstoryController::class, 'del'])->name('del');
        });
    });
});
