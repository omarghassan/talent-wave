<?php

// User Controllers
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DocumentController as UserDocumentController;
use App\Http\Controllers\TicketController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController; // Using alias for conflict resolution
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\AdminLeaveController;
use App\Http\Controllers\Admin\LeaveBalanceController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;


use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\HRMiddleware;
use App\Models\Attendance;
use App\Models\Department;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('employee')->middleware('user')->group(function () {
    Route::get('/dashboard', function () {
        return view('public.pages.dashboard');
    })->name('dashboard');

    Route::resource('profile', UserController::class);

    Route::resource('leaves', LeaveController::class);
    Route::get('/leaves/{id}/edit', [LeaveController::class, 'edit'])->name('leaves.edit');
    Route::put('/leaves/{leave}', [LeaveController::class, 'update'])->name('leaves.update');

    Route::resource('attendances', AttendanceController::class);
    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.check-in');
    Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.check-out');

    Route::resource('docs', UserDocumentController::class);

    Route::resource('tickets', TicketController::class);
});

// Route::get('/documents', [UserDocumentController::class, 'index'])->name('use.documents');
// Route::get('/documents/create', [UserDocumentController::class, 'create'])->name('upload');
// Route::post('/documents', [UserDocumentController::class, 'store'])->name('documents.store');

// Admin Routes
Route::middleware(['guest:admin'])->group(function () {
    Route::get('/admin/login', [AdminController::class, 'show_login_form'])->name('admin.login.show');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/hrs/hr', [AdminController::class, 'index'])->name('hr.index');
    Route::get('/hrs/create', [AdminController::class, 'create'])->name('hr.create');
    Route::post('/hrs/create', [AdminController::class, 'store'])->name('hr.store');
    Route::get('/hr/edit/{id}', [AdminController::class, 'edit'])->name('hr.edit');
    Route::post('/hrs/update{id}', [AdminController::class, 'update'])->name('hr.update');
    Route::delete('/hrs/delete/{id}', [AdminController::class, 'soft_delete'])->name('hr.soft_delete');
    Route::get('/hrs/deletedhr', [AdminController::class, 'show_deletedHR'])->name('hr.index_deleted');
    Route::post('/hrs/restore/{id}', [AdminController::class, 'restore'])->name('hr.restore');
    Route::delete('/hrs/create/{id}', [AdminController::class, 'destroy'])->name('hr.destroy');
});

Route::prefix('admin')->middleware(['hr'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });


    //////////////admin users
    Route::get('/adminusers/create', [AdminUserController::class, 'create'])->name('admin.create');
    Route::get('/adminusers/users', [AdminUserController::class, 'index'])->name('all_users');
    Route::post('/adminusers/create', [AdminUserController::class, 'store'])->name('add_new_employee');
    Route::get('/adminusers/logout', [AdminController::class, 'logout'])->name('admin_logout');
    Route::post('/admin/adminusers/logout', [AdminController::class, 'logout'])->name('admin_logout');
    Route::get('/adminusers/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.edit_user');
    Route::put('/adminusers/edit/{id}', [AdminUserController::class, 'update'])->name('admin.user_update');
    Route::delete('/adminusers/softdelete/{id}', [AdminUserController::class, 'destroy'])->name('admin.user_softdelete');
    Route::get('/adminusers/deletedusers', [AdminUserController::class, 'show_deleted_users'])->name('deletedeusers.index');
    Route::delete('/adminusers/delete/{id}', [AdminUserController::class, 'delete_user'])->name('admin.delete_user');
    Route::post('/adminusers/restore/{id}', [AdminUserController::class, 'restore'])->name('admin.restore_user');
    Route::get('/adminusers/show/{id}', [AdminUserController::class, 'show'])->name('admin.show_user');
    Route::get('/download-users-pdf', [AdminUserController::class, 'downloadPDF'])->name('employees.download.pdf');
    Route::get('/hr/show/{id}', [AdminController::class, 'show'])->name('hr.show');
    Route::get('/hr/show/{id}', [AdminController::class, 'show'])->name('hr.show');
    ///////////

    //////////admin department
    Route::get('/departments/departments', [DepartmentController::class, 'index'])->name('all_department');
    Route::post('/departments/departments', [DepartmentController::class, 'store'])->name('create.department');
    Route::delete('departments/departments/{id}', [DepartmentController::class, 'soft_delete'])->name('department.softdelete');
    Route::get('/departments/deleted_departments', [DepartmentController::class, 'deleted_departments'])->name('all.deleted_departments');
    Route::delete('/departments/delete/{id}', [DepartmentController::class, 'destroy'])->name('department.delete');
    Route::post('/departments/restore/{id}', [DepartmentController::class, 'restore'])->name('department.restore');
    Route::get('/departments/departments/{id}', [DepartmentController::class, 'edit'])->name('edit.department');
    Route::put('/departments/{id}', [DepartmentController::class, 'update']);
    Route::get('/department/{id}', [DepartmentController::class, 'show'])->name('department.show');
    ///////////////////

    //////////attendances
    Route::get('/attendance', [AdminAttendanceController::class, 'index'])->name('admin.attendances');
    Route::get('/attendance/pdf', [AdminAttendanceController::class, 'downloadAttendancePdf'])->name('attendance.pdf');
    ///////////

    ////////documents
    Route::get('/document', [DocumentController::class, 'index'])->name('document.index');
    Route::get('/documents/download/{id}', [DocumentController::class, 'download'])->name('documents.download');
    Route::put('/document/rejecte/{id}', [DocumentController::class, 'reject'])->name('document.rejecte');
    Route::put('/document/approve/{id}', [DocumentController::class, 'approve'])->name('document.approve');
    Route::get('/documents/view/{id}', [DocumentController::class, 'view'])->name('documents.view');
    ////////////////

    ///////////leaves
    Route::get('/leaves', [AdminLeaveController::class, 'index'])->name('admin.leaves.index');
    Route::patch('/leaves/{leave}/approve', [AdminLeaveController::class, 'approve'])->name('admin.leaves.approve');
    Route::patch('/leaves/{leave}/reject', [AdminLeaveController::class, 'reject'])->name('admin.leaves.reject');
    Route::get('employees/download-pdf', [AdminLeaveController::class, 'downloadPdf'])->name('leaves.download.pdf');
    // Leave types management
    Route::get('/leave-types', [LeaveTypeController::class, 'index'])->name('admin.leave-types.index');
    Route::post('/leave-types', [LeaveTypeController::class, 'store'])->name('admin.leave-types.store');
    Route::patch('/leave-types/{leaveType}', [LeaveTypeController::class, 'update'])->name('admin.leave-types.update');

    // Leave balances management
    Route::get('/leave/leave-balance', [LeaveBalanceController::class, 'index'])->name('admin.leave-balances.index');
    Route::get('/leave/leave-balance/{id}', [LeaveBalanceController::class, 'show_update'])->name('balance.update');
    Route::post('/leave-balances', [LeaveBalanceController::class, 'update'])->name('admin.leave-balances.update');
    Route::get('/employees', [LeaveBalanceController::class, 'downloadPdf'])->name('leave.pdf');
    /////////////////

    //////////admin documents type
    Route::get('/document-type', [DocumentTypeController::class, 'index'])->name('document_type.index');
    Route::post('/document-type', [DocumentTypeController::class, 'store'])->name(name: 'create.documenttype');
    Route::delete('/document-type/{id}', [DocumentTypeController::class, 'soft_delete'])->name('documettype.softdelete');
    Route::delete('/document-type/delete/{id}', [DocumentTypeController::class, 'destroy'])->name('documenttype.delete');
    Route::post('/document-type/restore/{id}', [DocumentTypeController::class, 'restore'])->name('documenttype.restore');
    Route::get('/document-type/departments/{id}', [DocumentTypeController::class, 'edit'])->name('documenttype.department');

    Route::put('/documenttype/{id}', [DocumentTypeController::class, 'update']);

    Route::get('/document-type/{id}', [DocumentTypeController::class, 'show'])->name('documenttype.show');
    ///////////////////

    // Ticket routes for admins
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
    Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('admin.tickets.show');
    Route::patch('/tickets/{ticket}/approve', [AdminTicketController::class, 'approve'])->name('admin.tickets.approve');
    Route::patch('/tickets/{ticket}/reject', [AdminTicketController::class, 'reject'])->name('admin.tickets.reject');
    Route::get('/tickets-pdf', [AdminTicketController::class, 'downloadPdf'])->name('admin.tickets.pdf');
});
