<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as convertImage;


class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.login');
    }
    public function register()
    {
        return view('pages.register');
    }
    public function loginProcess()
    {
        $validate = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'required' => 'Perlu diisi!!!',
        ]);

        if (Auth::attempt($validate)) {
            request()->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withErrors(['msg' => 'Kombinasi Salah']);
    }

    public function registerProcess()
    {

        // dd(request()->all());
        $validate = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'min:5', 'confirmed'],

        ], [
            'required' => 'Perlu diisi !!!',
            'unique' => 'Username Sudah Ada !!!',
            'numeric' => 'Harus angka !!!',
            'email' => 'harus berupa emamil !!!',
            'password.min' => 'Minimal 5 Karakter !!!',
            'username.min' => 'Minimal 5 Karakter !!!'
        ]);
        $validate['roles'] = 1;
        $validate['password'] = bcrypt(request()->password);
        // dd($validate);
        $data = User::create($validate);
        $data->save();
        return redirect()->route('login')->with('status', 'Register Berhasil');
    }
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('welcome');
    }
    public function updateUser()
    {
        $validated = request()->validate([
            'name' => 'required',
            'password' => ['required', 'min:5',],
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        // dd($validated);
        $user = User::find(Auth::user()->id);
        if ($user->image) {
            unlink($user->image);
        }
        $webp_image = convertImage::make(request()->file('file'))->encode('webp', 90)->save('storage/images/' . request()->file('file')->hashName() . '.webp');

        $hasil = $user->update([
            'name' => $validated['name'],
            'email' => request()['email'],
            'password' => bcrypt($validated['password']),
            'image' => $webp_image->basePath(),
        ]);
        if (!$hasil) {
            return redirect()->back()->withErrors(['msg' => 'Gagal Update']);
        } else
            return redirect()->back()->with('status', 'Berhasil Update');
    }
    public function deleteuser()
    {
        $user = User::find(request()->id);
        if ($user->image) {
            unlink($user->image);
        }
        $user->delete();
        return redirect()->back()->with('status', 'Berhasil Delete');
    }
}
