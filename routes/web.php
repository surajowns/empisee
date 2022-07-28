<?php
use Illuminate\Support\Facades\Hash;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::any('/', 'LoginController@Login');
Route::any('/logout', 'LoginController@logout');

Route::any('dashboard', 'DashboardController@Dashboard');
Route::any('chart_data', 'DashboardController@ChartData');


//employee
Route::any('emp_dashboard', 'DashboardController@EmployeeDashboard');
Route::any('employee', 'EmployeeController@index')->name('employee list');
Route::any('employee_details/{id}', 'EmployeeController@employleeDetails')->name('employee details');
Route::any('edit_employee/{id}', 'EmployeeController@EditEmployee')->name('Edit Employee details');
Route::any('check_email', 'EmployeeController@CheckEmail')->name('Check Email');
Route::any('check_mobile', 'EmployeeController@CheckMobile')->name('Check Mobile');
Route::any('search_employee', 'EmployeeController@SearchEmployee')->name('Search Employee');
Route::any('search_details', 'EmployeeController@AjaxEmployeeDetails')->name('Search Employee Details');


Route::any('/update/employee/status', 'EmployeeController@AjaxEmployeeStatus')->name('Employee Status');

Route::get('pass-gen', function(){
    $hashedPassword = Hash::make('password');
    dd($hashedPassword);
});




///Department
Route::any('department ', 'EmployeeController@Department')->name('department list');
Route::any('add_employee ', 'EmployeeController@AddEmployee')->name('add employee ');
Route::any('add_department ', 'EmployeeController@AddDepartment')->name('add department ');
Route::any('change_department_name ', 'EmployeeController@ChangeDepartmentName')->name('change  department name');


///role
Route::any('role', 'RoleController@Role')->name('Role list');
Route::any('add_role', 'RoleController@AddRole')->name('Add Role');
Route::any('change_role_name', 'RoleController@ChangeRoleName')->name('Change Role Name');



///Clock in clock out
Route::any('employee_clock_in', 'ClockInOutController@EmpClockIn')->name('Employee Clock in');
Route::any('employee_clock_out', 'ClockInOutController@EmpClockOut')->name('Employee Clock in');


//Attendence
Route::any('attendence', 'AttendenceController@Index')->name('Employee Attendence');
Route::any('/attendence_report/{emp_id}', 'AttendenceController@attendenceReport')->name('Employee Attendence Report');
Route::any('/attendencestatus', 'AttendenceController@AttendenceStatus')->name('Employee Attendence status');
Route::any('/generate_attendence_report', 'AttendenceController@GenerateAttendenceReport')->name('Generate Attendence Report');




///Profile 
Route::any('profile', 'ProfileController@Index')->name('Profile');
Route::any('your_profile', 'ProfileController@YourProfile')->name('Your Profile');

Route::any('profile_setting/{id}', 'ProfileController@ProfileSetting')->name('Profile Setting');
Route::any('update_profile', 'ProfileController@updateProfile')->name('Profile Update');
Route::any('update_password', 'ProfileController@updatePassword')->name('Profile Password');
Route::any('update_profile_image', 'ProfileController@updateImage')->name('Profile Image');



////Document
Route::any('document/{id}', 'DocumentController@Index')->name('Employee Document');
Route::any('upload_document', 'DocumentController@UploadDocument')->name('Upload Document');
Route::any('update_document', 'DocumentController@UpdateDocument')->name('Update Document');
Route::any('update_signature', 'DocumentController@UpdateSignature')->name('Update Signature');


//Expense
Route::any('expense', 'ExpenseController@Index')->name('Expense');
Route::any('add_expense', 'ExpenseController@AddExpense')->name('Add Expense');
Route::any('employee_expense/{emp_id}', 'ExpenseController@Index')->name('Expense List');
Route::get('users/export/', 'ExpenseController@export');
Route::any('expensestatus', 'ExpenseController@Expensestatus')->name('Update  Leave status');




///Manage
Route::any('manage', 'ManageController@Index')->name('Manage');
Route::any('manage/permission/{id}', 'ManageController@ViewPermission')->name('Manage Permission');
Route::any('update/permission', 'ManageController@UpdatePermission')->name('Update Permission');




///leave
Route::any('leave', 'LeaveController@Index')->name('Leave');
Route::any('apply_leave', 'LeaveController@ApplyLeave')->name('Apply Leave');
Route::any('updatestatus', 'LeaveController@updatestatus')->name('Update  Leave status');
Route::any('employee_leave/{emp_id}', 'LeaveController@EmployeeLeave')->name('Update  Leave status');

Route::any('employee_leave_details', 'LeaveController@EmployeeLeaveDetails')->name('Employee Leave Details');
Route::any('assign_leave', 'LeaveController@AssignLeave')->name('Assign Assets');
Route::any('update_modal_leave', 'LeaveController@LeaveModalForUpdate')->name('Update  leave modal');
Route::any('update_leave', 'LeaveController@UpdateLeave')->name('Update Leave');
Route::any('delete_leaves', 'LeaveController@DeleteLeaves')->name('Delete leave');



Route::any('company', 'CompanyController@Index')->name('Company Details');
Route::any('add_company', 'CompanyController@AddCompany')->name('Add Company');
Route::any('edit_company', 'CompanyController@EditCompany')->name('edit Company');
Route::any('update_address', 'CompanyController@Editaddress')->name('edit Company');
Route::any('delete_company', 'CompanyController@DeleteCompany')->name('Delete Company');


///Calender
Route::any('calendar', 'CalenderController@Index')->name('Calendar');
Route::any('leave_list', 'CalenderController@LeaveList')->name('Leave list for Calendar');
Route::any('create_event', 'CalenderController@CreateEvent')->name('Create Event');
Route::any('update_event', 'CalenderController@UpdateEvent')->name('Update Event');
Route::any('delete_event', 'CalenderController@DeleteEvent')->name('Delete Event');
Route::any('ckeditor/upload', 'CalenderController@upload')->name('ckeditor.upload');


////Notifications
Route::any('notification', 'NotificationController@Index')->name('See Notification');
Route::any('notification_details/{leave_id}', 'NotificationController@NotificationDetails')->name('See Notification Details');

// Assets
Route::any('assets', 'AssetsController@Index')->name('See Assets');
Route::any('assign_assets', 'AssetsController@AssignAssets')->name('Assign Assets');
Route::any('update_modal_assets', 'AssetsController@AssetModalForUpdate')->name('Update  Assets modal');
Route::any('update_assets', 'AssetsController@UpdateAssets')->name('Update Assets');
Route::any('delete_assets', 'AssetsController@DeleteAssets')->name('Delete Assets');
Route::any('update_assets_status', 'AssetsController@updatestatus')->name('Update Assets Status');
Route::any('assets_report', 'AssetsController@GenerateAssetsReport')->name('Update Assets Status');


Route::any('save-token', 'PusherNotificationController@sendNotification');
Route::any('send-notification', 'PusherNotificationController@sendNotifications');

Route::any('salary', 'SalaryController@Index')->name('View Employee Salary Details');
Route::any('update_salary', 'SalaryController@UpdateSalary')->name('View Employee Salary Details');

Route::any('emp_salary_slip/{id}', 'SalaryController@SalarySlip')->name('Generate Employee Salary Slip');
Route::any('emp_salary', 'SalaryController@EmployeeSalary');
Route::any('ModalForUpdate', 'SalaryController@ModalForUpdate');

Route::any('salary_details_report', 'SalaryController@GenerateSalaryReport')->name('Salary Details Report');
Route::any('sendOnEmailemp_salary_slip/{id}', 'SalaryController@SendOnEmailSalarySlip')->name('Generate Employee Salary Slip');


Route::any('bank_account', 'BankAccountController@Index');
Route::any('add_bank_account', 'BankAccountController@UploadBankAccount')->name('Add Bank Account');
Route::any('updatemodal_bank_account', 'BankAccountController@ModalUpdateBankAccount')->name('Add Bank Account');

Route::any('update_bank_account', 'BankAccountController@UpdateBankAccount')->name('Update Bank Account');
Route::any('bank_details_report', 'BankAccountController@GenerateBankDetailsReport')->name(' Salary Details Report');



Route::any('employee_payment', 'PaymentController@Index')->name('Employee Payment');
Route::any('upload_payment', 'PaymentController@UploadPayment')->name('Upload Employee Payment');
Route::any('update_payment_modal', 'PaymentController@UpdatePaymentModal')->name('Update Payment Modal');
Route::any('update_payment', 'PaymentController@UpdatePayment')->name('Upload Employee Payment');



// Route::post('/save-token', [App\Http\Controllers\HomeController::class, 'saveToken'])->name('save-token');


//sales
Route::any('sales', 'SalesController@Index')->name('Sales Page');
Route::any('import', 'SalesController@import')->name('import');
Route::any('sales_export', 'SalesController@SalesExport')->name('export');
