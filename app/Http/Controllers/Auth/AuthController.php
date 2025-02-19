<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration(): View
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request): RedirectResponse
    {
        // Validasi input
        
       
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
      
        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();
      
        // Cek jika user ditemukan dan password cocok
        if ($user && $request->password === $user->password) {
            // Login berhasil
            Auth::login($user);
            //menyimpan data user dalam session
            session([
                'id' => $user->user_id,
                'name' => $user->name,
                'logged_in' => true, // menyimpan status login
            ]);
            return redirect()->intended('home')->withSuccess('You have successfully logged in');
        }

      // jika gagal login
    return back()->WithErrors([
        'username' => 'username atau password salah.',
    ]);
}
    
    
    
      
    /**
     * Write code on Method
     *
     * @return response()
     */
   public function postRegistration(Request $request)
{
    // Validasi data
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    // Debug: Cek apakah password yang di-hash sesuai
    dd(Hash::make($request->password));

    // Simpan ke database
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password); // Enkripsi password
    $user->save();

    // Login otomatis setelah registrasi
    Auth::login($user);

    return redirect("karyawan")->withSuccess('Great! You have successfully registered.');
}
    
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('karyawans');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout(request $request)
    {
   // hapus session yang menyimpan informasi login
   $request->session()->forget(['logged_in', 'id', 'name']);
   // logout user dari sistem
   Auth::logout();
   $request->session()->flush(); // Hapus semua session
   $request->session()->invalidate();
   $request->session()->regenerateToken();
   return response()->view('auth.login');
    }
}