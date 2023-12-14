<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="User", version="0.1")
 */
class UserController extends Controller
{
  

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
    }

       /**
 * @OA\Post(
 * path="/login",
 *summary="cette route permet de se connecter",

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'user' => $user,
                'authorization' => [
                    'token' => $user->createToken('ApiToken')->plainTextToken,
                    'type' => 'bearer',
                ]
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

      /**
 * @OA\Post(
 * path="/registre",
 *summary="cette route permet de fzaire une inscription",

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function register(Request $request)
    {
        if (preg_match('/[@]/', $request->email)) {
            $eamil_userNameValidator  = 'required|string|email|max:255|unique:users';
        } else {
            $eamil_userNameValidator  = 'required|string|max:10|unique:users';
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => $eamil_userNameValidator,
            'password' => 'required|string|min:6',
            'datedeNaissance' => 'nullable|date',
            'telephone' => 'nullable|regex:/^(\+)?[0-9]{9}$/',
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'datedeNaissance' => $request->datedeNaissance,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'domaine_id' => $request->domaine_id,
        ]);
        return response()->json([
            'message' => 'Compte créer',
            'user' => $user
        ]);
    }

      /**
 * @OA\Get(
 * path="/logout",
 *summary="cette route permet de se deconnecter",

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
    /**
 * @OA\Post(
 * path="/ModifierProfil/{user}",
 *summary="cette route permet de modifier son profil ",
 *@OA\Parameter(
*name="user",
*in="path",
*required=true,
*description="user qu'on veut modifier",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function update(Request $request,  User $user)
    {
        if (preg_match('/[@]/', $request->email)) {
            $eamil_userNameValidator  = 'required|string|email|max:255|unique:users';
        } else {
            $eamil_userNameValidator  = 'required|string|max:10|unique:users';
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => $eamil_userNameValidator,
            'datedeNaissance' => 'nullable|date',
            'telephone' => 'nullable|numeric|digits:9',
        ]);

        $user->nom  = $request->nom;
        $user->prenom =  $request->prenom;
        $user->email = $request->email;
        $user->datedeNaissance =  $request->datedeNaissance;
        $user->telephone = $request->telephone;
        $user->role_id = $request->role_id;
        $user->domaine_id = $request->domaine_id;
        $user->update();

        return response()->json(['message' => 'User updated successfully!']);
    }

    /**
 * @OA\Post(
 * path="/ModifierMotdePasse/{user}",
 *summary="cette route permet de modifier son mot de passe ",
 *@OA\Parameter(
*name="user",
*in="path",
*required=true,
*description="user qui veut moodifier son mot de passe",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json('Le mot de passe actuel est incorrect.');
        }

        $user->password = Hash::make($request->password);
        $user->update();

        return response()->json(['success', 'Le mot de passe a été mis à jour avec succès.']);
    }
}
