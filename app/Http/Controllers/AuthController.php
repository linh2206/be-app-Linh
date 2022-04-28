<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Http\ControllersController;
use App\Services\UserService;
class AuthController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    public function me(Request $request)
    {
        $user = JWTAuth::user();
        $user['type'] = $request->input('type') ?? null;
        return response()->json([
            'status' => 'success', 
            'user' => $user
        ]);
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (!$token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        
        $expires_at = \Config::get('jwt.ttl');
        return response([
            'status' => 'success',
            'token' => $token,
            'expiration' => $expires_at
        ]);
    }
    
    public function logout(Request $request) 
    {
        $this->validate($request, ['token' => 'required']);
        
        try {
            JWTAuth::invalidate($request->input('token'));
            return response([
                'status' => 'success',
                'msg' => 'You have successfully logged out.'
            ]);
        } catch (JWTException $e) {
            return response([
                'status' => 'error',
                'msg' => 'Failed to logout, please try again.'
            ]);
        }
    }
    
    public function getList(GetListUserRequest $request)
    {
        try {
            $params = $request->validated();

            $listParam = ListParam::fromArray($params);

            $data = $this->service->getList($listParam);
            return $data;
        } catch (\Exception $ex) {
            return badRequest($ex->getMessage());
        }
    }

    public function register(Request $request)
    {
        $params = $request->all();
        $data = $this->service->create($params);
        return $data;
    }
    
    public function update(Request $request)
    {
        $params = $request->all();
        $data = $this->service->update($params);
        return $data;
    }
    
    public function getById($id)
    {
        $data = $this->service->find($id);
        return $data;
    }
    
    public function getListRegisters(Request $request)
    {
        try {
            $params = $request->all();

            $data = $this->service->getListRegisters($params);
            return $data;
        } catch (\Exception $ex) {
            return badRequest($ex->getMessage());
        }
    }
}