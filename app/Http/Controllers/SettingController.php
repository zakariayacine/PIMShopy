<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use App\Models\CvsImportation;
use App\Models\StorageCloud;
use App\Models\Tinypng;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apis = Tinypng::where('user_id', auth()->id())->get();
        return view('settings', compact('apis'));
    }
    public function importation(Request $request)
    {
    }
    public function utilisateur(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($request->old_password && $request->password_confirmation === $request->password) {
            $validated = $request->validate([
                    'password' => ['string', 'min:8', 'confirmed'],
                    'old_password' => [
                        function ($attribute, $value, $fail) {
                            if (!Hash::check($value, Auth::user()->password)) {
                                $fail('Old Password didn\'t match');
                            }
                        },
                    ],
                ]);
        $user->password = Hash::make($request->password);

        } if ($request->email) {
            $validated = $request->validate([
                    'email' => ['string', 'email', 'max:255', 'unique:users'],
                ]);
        $user->email = $request->email;
        } if ($request->name) {
            $validated = $request->validate([
                    'name' => ['string', 'max:255'],
                ]);
        $user->name = $request->name;
        }
        if($user->isDirty()){
            $user->save();
        }else{
            return redirect('/settings');
        }
        return redirect('/settings');
    }

    public function tinypng(Request $request)
    {
        $validated = $request->validate([
            'tinyapi' => [
                function ($attribute, $value, $fail) {
                    try {
                        \Tinify\setKey($value);
                        \Tinify\validate();
                    } catch (\Tinify\AccountException $e) {
                        // Verify your API key and account limit.
                        $fail($e->getMessage());
                    } catch (\Tinify\ClientException $e) {
                        // Check your source image and request options.
                        $fail($e->getMessage());
                    } catch (\Tinify\ServerException $e) {
                        // Temporary issue with the Tinify API.
                        $fail($e->getMessage());
                    } catch (\Tinify\ConnectionException $e) {
                        // A network connection error occurred.
                        $fail($e->getMessage());
                    } catch (Exception $e) {
                        // Something else went wrong, unrelated to the Tinify API.
                        $fail($e->getMessage());
                    }
                },
            ],
        ]);
         \Tinify\setKey($request->tinyapi);
         $start_time = \Carbon\Carbon::parse($request->date);
         $finish_time = \Carbon\Carbon::parse(today());
         $days = $start_time->diffInDays($finish_time, false);
            $tinypng = new Tinypng();
            $tinypng->API = $request->tinyapi;
            $tinypng->Number = \Tinify\compressionCount();
            $tinypng->Days = $days;
            $tinypng->user_id = auth()->id();
            $tinypng->save();
        
        return redirect('/settings');
    }

    public function cloud(Request $request)
    {
    }
}
