<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseSectionController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\FeeheadController;
use App\Http\Controllers\Admin\BatchfeeController;
use App\Http\Controllers\Admin\StudentmanageController;
use App\Http\Controllers\Admin\SmsController;
use App\Http\Controllers\Admin\FeesController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\AddPaymentController;
use App\Http\Controllers\Admin\GlobalController; //global controller
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\DuereminderController;
use App\Http\Controllers\Admin\FinancialReportController;



// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', function () {
    return view('layouts.dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/Admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/Admin/password-update', [ProfileController::class, 'Passwordupdate'])->name('password.change'); //upadate password

    Route::get('/Admin/logout', [ProfileController::class, 'Adminlogout'])->name('admin.logout'); //admin logout 

    Route::post('/Admin/change/profile-photo', [ProfileController::class, 'ChangeProfilePhoto'])->name('change.profilephoto'); //change profile photo 

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');





    Route::prefix('admin')->group(function () {

        Route::get('/search-students', [GlobalController::class, 'GlobalStudentSearch'])->name('global.student.search');
    });

    //course route
    Route::prefix('admin')->group(function () {

        Route::get('/all-courses', [CourseController::class, 'AllCourse'])->name('all.course');

        Route::post('/courses-store', [CourseController::class, 'CourseStore'])->name('course.store');

        Route::get('/courses-edit/{id}', [CourseController::class, 'CourseEdit'])->name('course.edit');

        Route::post('/courses-update', [CourseController::class, 'CourseUpdate'])->name('course.update');

        Route::get('/courses-delete/{id}', [CourseController::class, 'CourseDelete'])->name('course.delete');
    });


    //course section route
    Route::prefix('admin/course-section/')->group(function () {

        Route::get('/index', [CourseSectionController::class, 'CourseSectionIndex'])->name('course.section.index');

        Route::post('/search-item', [CourseSectionController::class, 'SearchSection'])->name('search.section');

        Route::post('/store', [CourseSectionController::class, 'SectonStore'])->name('section.store');

        Route::get('/edit/{id}', [CourseSectionController::class, 'SectionEdit'])->name('section.edit');

        Route::post('/update', [CourseSectionController::class, 'SectionUpdate'])->name('course-section.update');

        Route::get('/delete/{id}', [CourseSectionController::class, 'SectionDelete'])->name('section.delete');
    });




    //batch route
    Route::prefix('admin/batch')->group(function () {

        Route::get('/all-batch/list', [BatchController::class, 'AllBatch'])->name('all.batch');

        Route::post('/filter-batch/list', [BatchController::class, 'FilterData'])->name('filter.data');

        Route::post('/batch-store', [BatchController::class, 'BatchStore'])->name('batch.store');

        Route::get('/batch-edit/{id}', [BatchController::class, 'BatchEdit'])->name('batch.edit');

        Route::post('/batch-update', [BatchController::class, 'BatchUpdate'])->name('batch.upate');

        Route::get('/batch-delete/{id}', [BatchController::class, 'BatchDelete'])->name('batch.delete');


        Route::get('/running-batch', [BatchController::class, 'RunningBatch'])->name('running.batch');

        Route::get('/running-batch/student-list/{id}', [BatchController::class, 'RunningBatchStudent'])->name('batch.studentlist');

        Route::get('/running-batch/active-student-list/{id}', [BatchController::class, 'BatchActiveStudent'])->name('batch.active.student');

        Route::get('/running-batch/inactive-student-list/{id}', [BatchController::class, 'BatchInactiveStudent'])->name('batch.inactive.student');

        Route::get('/running-batch/section-student-list/{id}/{batch_id}', [BatchController::class, 'SectionStudents'])->name('section.students');
    });



    //student fee head route
    Route::prefix('admin/Student')->group(function () {

        Route::get('/all-fee-head', [FeeheadController::class, 'AllfeeHead'])->name('student.fee');

        Route::post('/store-fee-head', [FeeheadController::class, 'StoreFeehead'])->name('feehead.store');

        Route::get('/edit-feehead/{id}', [FeeheadController::class, 'EditFeehead'])->name('feehead.edit');
    });



    //batch fee route
    Route::prefix('admin/Batch')->group(function () {

        Route::get('/fee/{id}', [BatchfeeController::class, 'BatchfeeList'])->name('batchfee.list');

        Route::post('/batch-fee-store', [BatchfeeController::class, 'StoreBatchfee'])->name('batchfee.store');

        Route::get('/edit-batchfee/{id}', [BatchfeeController::class, 'EditBatchfee'])->name('edit.batchfee');
        Route::post('/update-batchfee', [BatchfeeController::class, 'UpdateBatchfee'])->name('update.batchfee');
        Route::get('/delete-batchfee/{id}', [BatchfeeController::class, 'DeleteBatchfee'])->name('delete.batchfee');
    });

    //sms settings route
    Route::prefix('admin/sms')->group(function () {

        Route::get('/sms-setting', [SmsController::class, 'CreateSms'])->name('sms.setting');

        Route::post('/settings', [SmsController::class, 'SettingsStore'])->name('settings.store');

        Route::get('/sms-create', [SmsController::class, 'SmsCreate'])->name('sms.create');

        Route::post('/sms-send', [SmsController::class, 'SmsSend'])->name('sms.send');

        Route::get('/sms-log-delete/{id}', [SmsController::class, 'Deletesmslog'])->name('delete.smslog');

        Route::get('/sms-template', [SmsController::class, 'SmsTemplate'])->name('sms.template');

        Route::post('/sms-template-add', [SmsController::class, 'TemplateStore'])->name('template.store');

        Route::get('/sms-template-edit/{id}', [SmsController::class, 'TemplateEdit'])->name('template.edit');

        Route::post('/sms-template-update', [SmsController::class, 'TemplateUpdate'])->name('template.update');

        Route::get('/sms-template-delete/{id}', [SmsController::class, 'TemplateDelete'])->name('template.delete');

        Route::get('/sms-log', [SmsController::class, 'SmsLog'])->name('sms.log');

        //send group sms
        Route::post('/send-group-sms', [SmsController::class, 'SendgroupSms'])->name('sendgroup.sms');

        //send group sms
        Route::post('/send-group-sms', [SmsController::class, 'SendgroupSms'])->name('sendgroup.sms');

        //send group smsreminder for course wise dues students
        Route::post('/send-group-smsreminder/course-dues-students/{course_id}', [SmsController::class, 'SendremindCWDStd'])->name('coursewise.group.smsreminder');

        //send group smsreminder for all dues students
        Route::post('/send-group-smsreminder/all-dues-students', [SmsController::class, 'AllDuesStudents'])->name('alldues.group.smsreminder');
    });



    //Student management route
    Route::prefix('admin/student')->group(function () {

        Route::get('/chose-course', [StudentmanageController::class, 'ChoseCourse'])->name('chose.course');

        Route::post('/create', [StudentmanageController::class, 'CreateStudent'])->name('create.student');

        Route::post('/add', [StudentmanageController::class, 'StoreStudent'])->name('store.student');

        Route::get('/student-list', [StudentmanageController::class, 'StudentList'])->name('student.list');

        Route::get('/stdmanage-list', [StudentmanageController::class, 'StdmanageList'])->name('stdmanage_list');


        Route::post('/search-student', [StudentmanageController::class, 'SearchStudent'])->name('search.student');

        Route::get('/view/student-details/{id}', [StudentmanageController::class, 'ViewSutdentDetails'])->name('view.student-details');

        Route::get('/edit/student/{id}', [StudentmanageController::class, 'EditStudent'])->name('edit.student');

        Route::post('/update/student', [StudentmanageController::class, 'UpdateStudent'])->name('student.update');

        Route::get('/delete/student/{id}', [StudentmanageController::class, 'DeleteStudent'])->name('student.delete');

        Route::get('/pending/student', [StudentmanageController::class, 'PendingStudents'])->name('pending.students');

        Route::get('/pending/student/delete/{id}', [StudentmanageController::class, 'PendingStudentsDelete'])->name('pending.students.delete');


        // active student route 
        Route::get('/active/student/{id}', [StudentmanageController::class, 'ActiveStudent'])->name('active.student');


        // active student route 
        Route::get('/active/student/{id}', [StudentmanageController::class, 'ActiveStudentList'])->name('active.studentlist');

        // inactive student route 
        Route::get('/inactive/student/{id}', [StudentmanageController::class, 'InactiveStudentList'])->name('inactive.studentlist');

        // promotion student route 
        Route::get('/promotion/student', [StudentmanageController::class, 'PromotionCreate'])->name('promotion.search');

        // find student
        Route::post('/promotion/student', [StudentmanageController::class, 'FindStudent'])->name('find.student');

        //get dynamic data for promotion class
        Route::get('/get-course-data', [StudentmanageController::class, 'GetCourseData'])->name('student.getCourseData');

        //promotion student for next class
        Route::post('/promotion/student/next-class', [StudentmanageController::class, 'PromotionStudent'])->name('promotion.student');

        Route::get('/course/student/{course_id}', [StudentmanageController::class, 'CoursewideStudent'])->name('coursewise.student');
    });


    //fee route
    Route::prefix('admin/student/fee')->group(function () {

        Route::get('/create', [FeesController::class, 'CreateFee'])->name('create.fee');

        Route::post('/add', [FeesController::class, 'FeeAdd'])->name('fee.add');
    });

    //expense category route
    Route::prefix('admin/expense/category')->group(function () {

        Route::get('/list', [ExpenseCategoryController::class, 'ExpenseCategoryList'])->name('expensecategory.list');

        Route::post('/store', [ExpenseCategoryController::class, 'ExpenseCategoryStore'])->name('expensecategory.store');

        Route::get('/edit/{id}', [ExpenseCategoryController::class, 'ExpenseCategoryEdit'])->name('expensecategory.edit');

        Route::post('/update', [ExpenseCategoryController::class, 'ExpenseCateroyUpdate'])->name('update.expcategory');

        Route::get('/delete/{id}', [ExpenseCategoryController::class, 'ExpensecatDelete'])->name('expensecategory.delete');
    });


    //expense route
    Route::prefix('admin/expense')->group(function () {

        Route::get('/list', [ExpenseController::class, 'ExpenseList'])->name('expense.list');

        Route::get('/filter', [ExpenseController::class, 'ExpenseList'])->name('filter.expense');

        Route::post('/store', [ExpenseController::class, 'ExpenseStore'])->name('expense.store');

        Route::get('/edit/{id}', [ExpenseController::class, 'ExpenseEdit'])->name('expense.edit');

        Route::post('/update', [ExpenseController::class, 'ExpenseUpdate'])->name('update.expense');

        Route::get('/delete/{id}', [ExpenseController::class, 'ExpenseDelete'])->name('expense.delete');
    });


    //payment route
    Route::prefix('admin/payment')->group(function () {

        Route::get('/create', [AddPaymentController::class, 'CreatePayment'])->name('add.payment');

        Route::post('/search-student', [AddPaymentController::class, 'SearchStudent'])->name('search.students');

        Route::post('/get-batch', [AddPaymentController::class, 'Getbatches'])->name('get.batches');

        Route::get('/student/list', [AddPaymentController::class, 'StudentList'])->name('paystudent.list');

        Route::post('/collect', [AddPaymentController::class, 'FessCollect'])->name('collect.fess');


        Route::get('/no-dues-list/{course_id}/{batch_id}', [AddPaymentController::class, 'NoduesStudents'])->name('nodues.students');

        Route::get('/dues-list/{course_id}/{batch_id}', [AddPaymentController::class, 'DuesStudents'])->name('dues.students');

        Route::get('/dues-list', [AddPaymentController::class, 'AlldueAddPayment'])->name('all.due.addpayment');


        Route::get('/dues-list-filter/{course_id}/{section_id}', [AddPaymentController::class, 'Allduefilter'])->name('alldue.filter');



        //pay search
        Route::get('/search-pay-list', [AddPaymentController::class, 'Paysearch'])->name('search.pay');

        // get batch and section for show payment list 
        Route::get('/get-batches-section/{course_id}', [AddPaymentController::class, 'getbatchsection'])->name('get.batch.section');

        //get payment list route
        Route::post('/get-batches-section', [AddPaymentController::class, 'Getpaymentlist'])->name('show.payment.list');
    });


    //due reminder route
    Route::prefix('admin/student')->group(function () {

        Route::get('/due-reminder/{id}', [DuereminderController::class, 'SingleReminder'])->name('due.reminder');
    });


    //paymet route
    Route::prefix('admin/student')->group(function () {

        Route::get('/account/{id}', [AccountController::class, 'StudentAccountDetails'])->name('student.account');
    });


    //Financial report route
    Route::prefix('admin/report')->group(function () {

        Route::get('/financial/report', [FinancialReportController::class, 'FinancialReport'])->name('financial.report');
    });
});









require __DIR__ . '/auth.php';
