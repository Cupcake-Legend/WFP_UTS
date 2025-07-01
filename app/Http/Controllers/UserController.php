<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Reward;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function admin()
    {
        $categories = Category::withCount('menus')->get();
        $menus = Menu::with('category')->get();
        $rewards = Reward::all();
        $orders = Order::all();

        return view('admin.index', compact('categories', 'menus', 'rewards', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.create');


        //
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'alamat' => $validated['alamat'],
            'password' => Hash::make($validated['password']),
            'roles' => 'user',
            'poin' => 0,
        ]);

        return redirect()->route('index')->with("Message", "Account have been created");
    }


    /**
     * Store a newly created resource in storage.
     */

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|string",
            "password" => "required|string"
        ]);

        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(["email" => $email, "password" => $password])) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->roles === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('index');
            }
        } else {


            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route("index"));
    }

    public function loginView()
    {
        return view("auth.login");
    }

    public function profile()
    {
        $user = User::with([
            'orders',
            'rewards.reward'
        ])->findOrFail(Auth::id());

        return view('profile', compact('user'));
    }


    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users",
            "password" => "required|string|min:6",
            "no_hp" => "required|string|min:11",
            "alamat" => "required|string",
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->poin = 0;
        $user->roles = "user";
        $user->save();

        return redirect()->route('users.index')->with("success", "User Created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function editProfile()
    {
        // Langsung ambil user yang sedang login, tidak perlu $id dari URL
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users,email,$id",
            "password" => "nullable|string|min:6",
            "no_hp" => "required|string|min:11",
            "alamat" => "required|string",
            "roles" => "required|in:user,admin"
        ]);

        $user->name = $request->name;
        $user->email = $request->email;


        if ($request->filled("password")) {
            $user->password = bcrypt($request->password);
        }
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->roles = $request->roles;

        $user->save();

        // return redirect()->route('users.index')->with("success", "User Updated!");
        return redirect()->route('profile')->with("success", "Profil berhasil diperbarui!");



        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        return redirect()->route('users.index')->with("success", "User Deleted!");
        //
    }
}
