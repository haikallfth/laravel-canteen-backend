<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // paginate(10) berfungsi untuk menampilkan 10 user per halaman, jadi halaman 1 10 user, halaman 2 10 user, dst
        // ->when($request->input('name'), function($query, $name) { return $query->where('name', 'like' , '%' . $name . '%');}) ->orderBy('id', 'desc') INI ADALAH CODE UNTUK MENGAKTIFKAN SEARCH BAR
        // query itu yg warnanya biru kayak when, input, where, orderBY dan paginate
        $users = User::query()
        ->when($request->input('name'), function($query, $name) {
            return $query->where('name', 'like' , '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        // variable $users di file ini harus di compact biar di index.blade.php bisa di panggil di view, klo ga di compact gabisa dipanggil kemana-mana
        // return view ini ngambil dari folder view trs ke folder pages trs ke users trs ke file index gitu
        return view('pages.users.index', compact('users')); 
    }
    
    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // validasi ini berfungsi bahwa field apa yang wajib diisi dan field apa yang boleh null
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|min:9',
            'role' => 'required',
        ]);

        $data = ([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        User::create($data);
        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'role' => 'required',
        ]);
        $user = User::findOrFail($id);
        $data = ([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role
        ]);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }else{
            unset($data['password']);
        }

        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
