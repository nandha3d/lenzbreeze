<?php

namespace App\Http\Controllers\SalePro\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Cache;
use DB;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Note: guest middleware removed to avoid redirect loop
        // caused by the route prefix /salepro
    }

    public function showLoginForm()
    {
        if(isset($_COOKIE['language']))
            \App::setLocale($_COOKIE['language']);
        else
            \App::setLocale('en');

        // Getting theme
        if(isset($_COOKIE['theme']))
            $theme = $_COOKIE['theme'];
        else
            $theme = 'light';

        // Get general setting value from salepro database
        try {
            $general_setting = Cache::remember('general_setting', 60*60*24*365, function () {
                return DB::table('general_settings')->latest()->first();
            });
        } catch (\Exception $e) {
            $general_setting = null;
        }

        if(!$general_setting) {
            try {
                $sqlPath = public_path('salepro-assets/tenant_necessary.sql');
                if (file_exists($sqlPath)) {
                    DB::unprepared(file_get_contents($sqlPath));
                }
                $general_setting = DB::table('general_settings')->latest()->first();
            } catch (\Exception $e) {
                $general_setting = (object)[
                    'site_logo' => null,
                    'company_name' => 'SalePro',
                ];
            }
        }

        $numberOfUserAccount = 0;
        try {
            $numberOfUserAccount = \App\Models\User::where('is_active', true)->count();
        } catch (\Exception $e) {
            // DB not ready yet
        }

        return view('backend.auth.login', compact('theme', 'general_setting', 'numberOfUserAccount'));
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if(auth()->attempt(array($fieldType => $input['name'], 'password' => $input['password'])))
        {
            setcookie('login_now', 1, time() + (86400 * 1), "/");
            return redirect('/admin/dashboard');
        }
        else {
            return redirect()->route('login')->with('error', 'Username And Password Are Wrong.');
        }
    }
}
