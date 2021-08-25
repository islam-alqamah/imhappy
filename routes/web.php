<?php

use App\Http\Controllers\Account\BranchesController;
use App\Http\Controllers\Account\CitiesController;
use App\Http\Controllers\Account\EditorController;
use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Admin\SurveyTemplatesController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\urway\UrWayController;
use App\Models\Plan;
use GuzzleHttp\Middleware;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\MaintenanceMode;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Ticket\TicketsController;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Team\TeamMemberController;
use App\Http\Controllers\Ticket\CommentsController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Subscriptions\PlanController;
use App\Http\Controllers\Admin\StripeBalanceController;
use App\Http\Controllers\Admin\DownloadBackupController;
use App\Http\Controllers\Admin\PlanController as StripePlan;
use JoelButcher\Socialstream\Http\Controllers\OAuthController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionController;
use JoelButcher\Socialstream\Http\Controllers\Inertia\PasswordController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionCardController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionSwapController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionCancelController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionCouponController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionResumeController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionInvoiceController;


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




Route::get('/view/point/{point}', [FrontEndController::class, 'view'] )->name('view.point');
Route::post('/feedback/submit/{form}', [FrontEndController::class, 'feedback'] )->name('feedback.submit');
Route::post('/survey/submit/{form}', [FrontEndController::class, 'survey'] )->name('survey.submit');
Route::get('/feedback/thanks/{form}', [FrontEndController::class, 'thanks'] )->name('feedback.thanks');

Route::group(['middleware' => 'language'], function () {
    Route::get('/', [FrontEndController::class,'index'])->name('home');
    Route::get('oauth/{provider}', [OAuthController::class, 'redirectToProvider'])->name('oauth.redirect');
    Route::get('auth/{provider}/callback',[OAuthController::class, 'handleProviderCallback'])->name('oauth.callback');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::middleware(['auth:sanctum', 'verified'])
        ->get('/dashboard',[DashboardController::class,'index'] )->name('dashboard');

    Route::middleware(['auth:sanctum', 'verified'])
        ->get('/charts',[DashboardController::class,'charts'] )->name('charts');
    Route::middleware(['auth:sanctum', 'verified'])
        ->post('/charts',[DashboardController::class,'charts'] )->name('charts');
    Route::middleware(['auth:sanctum', 'verified'])
        ->get('/reports',[DashboardController::class,'reports'] )->name('reports');

    Route::middleware(['auth:sanctum', 'verified'])
        ->post('/reports',[DashboardController::class,'reports'] )->name('reports');


    Route::post('account/profile/save', [SettingsController::class,'save_profile'])->name('account.profile.save');
    Route::group(['prefix' => 'account', 'as' => 'account.', 'middleware' => ['auth:sanctum', 'verified']], function () {
        Route::view('security', 'account.security')->name('security');
        Route::view('password', 'account.password')->name('password');
        Route::view('social', 'profile.social')->name('social');
        Route::get('settings', [SettingsController::class,'index'])->name('settings');
        Route::post('settings/save', [SettingsController::class,'save'])->name('settings.save');
        Route::get('profile', [SettingsController::class,'profile'])->name('profile');
        Route::get('plan', function () {
            $team = Auth::user()->personalTeam();
            $plans = Plan::all();
            return view('account.plan', ['plans' => $plans]);
        })->name('plan');

        Route::post('subscribe/new',[UrWayController::class,'payment_request'])->name('new.subscription');
        Route::get('payment/response',[UrWayController::class,'payment_response'])->name('payment.response');
        Route::get('payments',[AccountController::class,'payments'])->name('payments');
        Route::get('payments/{payment}',[AccountController::class,'payment'])->name('payment.view');

    });

    Route::group(['namespace' => 'Subscriptions', 'middleware' => 'auth'], function () {
        Route::get('plans', [PlanController::class, 'index'])->name('subscription.plans')->middleware('not.subscribed');
        Route::get('/subscriptions', ['App\Http\Controllers\Subscriptions\SubscriptionController', 'index'])->name('subscriptions');
        Route::post('/subscriptions', ['App\Http\Controllers\Subscriptions\SubscriptionController', 'store'])->name('subscriptions.store');
    });
    Route::get('/test', function () {
        $beautymail = app()->make(Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('emails.welcome', [], function ($message) {
            $message
                ->from('info@fastmesaj.com')
                ->to('dukenst2006@gmail.com', 'John Smith')
                ->subject('Welcome!');
        });
    });
    // Route::get('accept/{token}', [TeamMemberController::class, 'acceptInvite'])->name('teams.accept_invite');

    Route::group(['middleware' => 'verified', 'namespace' => 'Account', 'prefix' => 'account'], function () {
        Route::get('/', [AccountController::class, 'index'])->name('account');
        Route::get('/preference', [AccountController::class, 'preference'])->name('account.preference');

        Route::group(['namespace' => 'Subscriptions',['middleware' => 'subscribed'], 'prefix' => 'subscriptions'], function () {
            Route::get('/', [SubscriptionController::class, 'index'])->name('account.subscriptions');

            Route::get('/cancel', [SubscriptionCancelController::class, 'index'])->name('account.subscriptions.cancel');
            Route::post('/cancel', [SubscriptionCancelController::class, 'store']);

            Route::get('/resume', [SubscriptionResumeController::class, 'index'])->name('account.subscriptions.resume');
            Route::post('/resume', [SubscriptionResumeController::class, 'store']);

            Route::get('/swap', [SubscriptionSwapController::class, 'index'])->name('account.subscriptions.swap');
            Route::post('/swap', [SubscriptionSwapController::class, 'store']);

            Route::get('/card', [SubscriptionCardController::class, 'index'])->name('account.subscriptions.card');
            Route::post('/card', [SubscriptionCardController::class, 'store']);
            Route::post('/newcard', [SubscriptionCardController::class, 'newPaymentMethod'])->name('account.subscriptions.newcard');

            Route::get('/coupon', [SubscriptionCouponController::class, 'index'])->name('account.subscriptions.coupon');
            Route::post('/coupon', [SubscriptionCouponController::class, 'store']);

            Route::get('/invoices', [SubscriptionInvoiceController::class, 'index'])->name('account.subscriptions.invoices');
            Route::get('/invoices/{id}', [SubscriptionInvoiceController::class, 'show'])->name('account.subscriptions.invoice');
        });
    });
    Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'account', 'as' => 'ticket.'], function () {
        /* Ticket Routes */
        Route::get('new-ticket', [TicketsController::class, 'create'])->name('create');

        Route::post('new-ticket', [TicketsController::class, 'store']);

        Route::get('my_tickets', [TicketsController::class, 'userTickets'])->name('index');

        Route::get('tickets/{ticket_id}', [TicketsController::class, 'show'])->name('show');

        Route::post('comment', [CommentsController::class, 'postComment'])->name('comment');
        Route::post('close_ticket', [TicketsController::class, 'close_by_user'])->name('close_by_user');
    });

    Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'analytics', 'as' => 'analytics.'], function () {
        /* Ticket Routes */
        Route::get('charts', [TicketsController::class, 'create'])->name('charts');
        Route::get('responses', [TicketsController::class, 'index'])->name('responses');

    });
    Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'points', 'as' => 'points.'], function () {
        /* Ticket Routes */
        Route::get('points/all', [BranchesController::class, 'all_points'])->name('all');
    });
    Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'analytics', 'as' => 'analytics.'], function () {
        /* Ticket Routes */
        Route::get('charts', [TicketsController::class, 'create'])->name('charts');
        Route::get('charts', [TicketsController::class, 'create'])->name('charts');
        Route::get('responses', [TicketsController::class, 'index'])->name('responses');

    });
    Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'branches', 'as' => 'branches.'], function () {
        /* Branches Routes */
        Route::get('branches', [BranchesController::class, 'index'])->name('branches');
        Route::get('branches/export', [BranchesController::class, 'export_branches'])->name('export');
        Route::post('branches/import', [BranchesController::class, 'import_branches'])->name('import');
        Route::post('branches/new', [BranchesController::class, 'store'])->name('branches.new');
        Route::post('branches/update', [BranchesController::class, 'update'])->name('branches.update');
        Route::get('branches/delete/{branch}', [BranchesController::class, 'delete'])->name('branches.delete');
        Route::get('branches/points/{branch}', [BranchesController::class, 'points'])->name('branches.points');
        Route::post('branches/points/{branch}/new', [BranchesController::class, 'new_point'])->name('points.new');
        Route::get('branches/points/{point}/delete', [BranchesController::class, 'delete_point'])->name('points.delete');

        Route::get('points/export', [BranchesController::class, 'export_points'])->name('points.export');
        Route::post('points/import', [BranchesController::class, 'import_points'])->name('points.import');

        Route::get('responses/export', [BranchesController::class, 'export_responses'])->name('responses.export');
        Route::post('responses/import', [BranchesController::class, 'import_responses'])->name('responses.import');

        Route::get('branches/branch/{branch}/export', [BranchesController::class, 'export_branch'])->name('branch.export');
        Route::get('branches/points/{point}/responses', [BranchesController::class, 'responses'])->name('points.responses');
        Route::post('branches/points/{point}/responses', [BranchesController::class, 'responses'])->name('points.responses');
        Route::get('branches/{branch}/points/{point}/editor', [EditorController::class, 'index'])->name('points.editor');
        Route::post('branches/{branch}/points/{point}/editor', [EditorController::class, 'update'])->name('editor.save');
        Route::get('cities', [CitiesController::class, 'index'])->name('cities');
        Route::post('cities/new', [CitiesController::class, 'store'])->name('cities.new');

    });


    Route::impersonate();

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:sanctum', 'role:admin']], function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('index');
        Route::resource('/users', UserController::class);

        Route::resource('/permissions', PermissionController::class);

        Route::resource('/roles', RoleController::class);

        // Survey Templates
        Route::get('survey/templates', [SurveyTemplatesController::class, 'index'])->name('survey.templates');
        Route::post('survey/templates/new/{template}', [SurveyTemplatesController::class, 'save_template'])->name('survey.template.new');
        Route::get('survey/templates/delete/{template}', [SurveyTemplatesController::class, 'delete'])->name('survey.template.delete');
        Route::get('survey/templates/edit/{template}', [SurveyTemplatesController::class, 'index'])->name('survey.template.edit');

        /* Plans Resource Routes */
        Route::resource('/plans', StripePlan::class);
        Route::resource('/coupons', CouponController::class);

        // Admin Ticket system
        Route::get('tickets', [TicketsController::class, 'index'])->name('tickets');

        Route::post('close_ticket/{ticket_id}', [TicketsController::class, 'close']);
        Route::get('tickets/{ticket_id}', [TicketsController::class, 'adminshow']);

        Route::view('backups', 'admin.backup.index')->name('backup.index');
        Route::get('download-backup', DownloadBackupController::class);
        Route::get('maintenance', MaintenanceMode::class)->name('maintenance');
        Route::get('subscriptions-cancel', ['App\Http\Controllers\Admin\SubscriptionController', 'cancelSubscription'])->name('subscription.cancel');
        Route::get('subscriptions', ['App\Http\Controllers\Admin\SubscriptionController', 'subscription'])->name('subscriptions');

        Route::get('/stripe/charges', [StripeBalanceController::class , 'index']);
        Route::get('/stripe/charges/{id}', [StripeBalanceController::class , 'show']);
        Route::get('/stripe/balance', [StripeBalanceController::class , 'index']);
    });
    
});