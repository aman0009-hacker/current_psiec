<?php

namespace App\Providers;


// use Laravel\Fortify\Contracts\RegisterResponse;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Crypt;
use App\Rules\ReCaptcha;
use Illuminate\Validation\ValidationException;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    Fortify::verifyEmailView(function(){
     return view('auth.verify-email');
     });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $this->app->singleton(
            \Laravel\Fortify\Contracts\RegisterResponse::class,
            \App\Http\Responses\RegisterResponse::class,
        );

        //new code start may strrt
        Fortify::registerView(function () {
            return view('auth.signUp');
        });
        Fortify::authenticateUsing(function (Request $request) {

            $request->validate([
               'g-recaptcha-response' => ['required', new ReCaptcha]
            ]);

            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            } else {
                if (!$user) {
                    throw ValidationException::withMessages([
                        'email' => 'The provided email is not registered.',
                    ]);
                } else {
                    throw ValidationException::withMessages([
                        'password' => 'The provided password is incorrect.',
                    ]);
                }
            }
           
         });
        Fortify::loginView(function () {
            return view('auth.login');
        });
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });


        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        //Fortify::CreateNewUser(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // RateLimiter::for('login', function (Request $request) {
        //     $email = (string) $request->email;

        //     return Limit::perMinute(5)->by($email.$request->ip());
        // });

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip())->response(function () {
                return redirect()->route('login')->with('error', 'Too many failed login attempts.');
            });
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        //new code start may
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $emailResetUrl = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
            return (new MailMessage)
                ->subject(Lang::get('Reset Password Notification'))
                ->view('email.reset_password', [
                    'url' => $emailResetUrl
                ]);
        });

        //new code data


    }
}