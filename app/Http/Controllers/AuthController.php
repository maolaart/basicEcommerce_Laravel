<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        $credentials = request(['email','password']);
        
        if(auth()->attempt($credentials)){
            $token = auth::guard('api')->attempt($credentials); 
            // dd($token);

            return response()->json([
                'success'=>true,
                'message'=>'Login Berhasil',
                'token'=>$token
            ]);

            // cookie()->queue('token',$token,60);
            // return redirect('/dashboard');
        }

        return response()->json([
            'success'=>false,
            'message'=>'password atau email salah!'
        ]);

        // return back()->withErrors([
        //     'error'=>'password atau email salah!'
        // ]);
        
        
        // $credentials = request(['email','password']);

        // if (! $token = auth()->attempt($credentials)) {
        //     return response()->json(['email or password invalid!'], 401);
        // }

        // return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register(Request $request)
    {
        //  dd($request->all());
         $validator = Validator::make($request->all(),[
            'nama_member' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:konfirmasi_password',
            'konfirmasi_password' => 'required|same:password',

        ]);

        if ($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        unset($input['konfirmasi_password']);
        $member = Member::create($input);

        return response()->json([ 
            'data' => $member
        ]);
    }

    public function login_member()
    {
        return view('auth.login_member');
    }

    public function login_member_action(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        
        ]);

        if ($validator->fails()){

            Session::flash('errors',$validator->errors()->toArray());
            return redirect('/login_member');

            // return response()->json(
            //     $validator->errors(),422
            // );
        }

        $credentials = $request->only('email','password');

        // $credentials = $request->only('email','password');
        $member =  Member::where('email',$request->email)->first();
        // dd($member);

        if($member){
            if(Auth::guard('webmember')->attempt($credentials))
            {
                $request->session()->regenerate();
                // 
                return redirect('/');

                // return response()->json([
                //     'message'=>'success',
                //     'data'=>$member
                // ]);
            }else{

                Session::flash('failed','Invalid Password');
                return redirect('/login_member');

                // return response()->json([
                //     'message'=>'failed',
                //     'data'=>'password invalid!'
                // ]);
            }
        }else{

            Session::flash('failed','Invalid Account');
            return redirect('/login_member');

            // return response()->json([
            //     'message'=>'failed',
            //     'data'=>'email invalid!'
            // ]);
        }

    }
    public function register_member()
    {
        return view('auth.register_member');
    }

    public function register_member_action(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_member' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:konfirmasi_password',
            'konfirmasi_password' => 'required|same:password',

        ]);

        if ($validator->fails()){
            // dd($validator->errors());
            Session::flash('errors',$validator->errors()->toArray());
            return redirect('/register_member');

            // return response()->json(
            //     $validator->errors(),422
            // );
        }

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        unset($input['konfirmasi_password']);
        Member::create($input);

        Session::flash('success','Your account has been created');

        // return response()->json([ 
        //     'data' => $member
        // ]);

        return redirect('/login_member');

    }


    public function logout()
    {
        Session::flush();
        return redirect('/login');

        // auth()->logout();

        // return response()->json(['message' => 'Successfully logged out']);
    }
    public function logout_member()
    {
        Auth::guard('webmember')->logout();

        Session::flush();

        return redirect('/');
    }
}
