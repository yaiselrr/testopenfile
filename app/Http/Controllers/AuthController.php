<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;
use App\Exceptions\CustomException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    private $authRepository;

    public function __construct(AuthRepository $authRepo)
    {
        $this->authRepository = $authRepo;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $register = $this->authRepository->register($request);

            return $register;
        } catch (CustomException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'type' => trans('msgs.type_error')
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => trans('msgs.msg_error_contact_the_adminitrator'),
                'type' => trans('msgs.type_error')
            ], 500);
        }
    }

    public function authenticate(AuthRequest $request)
    {
        try {
            return $this->authRepository->authenticate($request);
        } catch (CustomException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'type' => trans('msgs.type_error')
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Error',
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            return $this->authRepository->logout($request);
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Error',
            ], 500);
        }
    }

    public function getDataUser(Request $request)
    {
        try {
            return $this->authRepository->getDataUser($request);
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Error',
            ], 500);
        }
    }
}
