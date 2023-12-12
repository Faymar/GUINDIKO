<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(title="Roles", version="0.1")
 */
class RoleController extends Controller
{
          /**
 * @OA\Get(
 * path="/listerRoles",
 *summary="cette route permet de lister tous les roles qui ne sont pas archivés (supprimer)",

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function index()
    {
        return response()->json(Role::where('estArchive', false)->get());
    }


  /**
 * @OA\Post(
 * path="/ajouterRoles",
 *summary="cette route permet d'ajouter un role'",

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function store(StoreRoleRequest $request)
    {
        $request->validated($request->all());

        $role = new Role();
        $role->nomRole = $request->input('nomRole');
        $role->save();

        return response()->json($role);
    }

    /**
 * @OA\Get(
 * path="/voirRoles/{role}",
 *summary="cette route permet d'afficher un role",
 *@OA\Parameter(
*name="role",
*in="path",
*required=true,
*description="role qu'on veut afficher",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function show(Role $role)
    {
        return response()->json($role);
    }

    /**
 * @OA\Post(
 * path="/modifierRoles/{role}",
 *summary="cette route permet de modifier un role",
 *@OA\Parameter(
*name="role",
*in="path",
*required=true,
*description="role qu'on veut modifier",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $request->validated($request->all());

        $role->nomRole = $request->input('nomRole');
        $role->update();

        return response()->json($role);
    }

    
    /**
 * @OA\Get(
 * path="/supprimerRoles/{role}",
 *summary="cette route permet de supprimer (archiver) un role",
 *@OA\Parameter(
*name="role",
*in="path",
*required=true,
*description="role qu'on veut supprimer (archiver)",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function destroy(Role $role)
    {
        $role->estArchive = true;
        $role->update();

        return response()->json($role);
    }
}
