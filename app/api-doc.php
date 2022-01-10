<?php

/**  @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Swagger MF-Bank",
 *         description="This is a sample server MF-Bank server.",
 *         termsOfService="http://localhost:8000/api/terms/",
 *         @OA\Contact(
 *             email="fatih.altun00@hotmail.com"
 *         ),
 *         @OA\License(
 *             name="Apache 2.0",
 *             url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *         )
 *     ),
 * )
*/ 

/** @OA\Get(
     *     path="/api/users",
     *     summary="Users info",
     *     tags={"users"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *      @OA\JsonContent(
     *          type="array", 
     *          @OA\Items(ref="#/components/schemas/User")
     *      )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Invalid value",
     *      @OA\JsonContent(
     *          type="array", 
     *          @OA\Items(ref="#/components/schemas/User")
     *      )
     *     ),
     *      security={
     *          {"bearer_token": {}}
     *      }
     * )
*/

/** @OA\Post(
    *     path="/api/users",
    *     summary="User Created",
    *     tags={"users"},
    *     operationId="store",
    *     @OA\RequestBody(
    *       description="Store a user",
    *       required=true,
    *       @OA\JsonContent(ref="#/components/schemas/User")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="successful operation",
    *     ),
    *     @OA\Response(
    *         response="400",
    *         description="Invalid value",
    *     ),
    * )
*/

/** @OA\Delete(
    *     path="/api/users",
    *     summary="User Delete",
    *     tags={"users"},
    *     @OA\Response(
    *         response=200,
    *         description="successful operation",
    *     ),
    *     @OA\Response(
    *         response="400",
    *         description="Invalid value",
    *     ),
    *      security={
    *          {"bearer_token": {}}
    *      }
    * )
*/

/** @OA\Post(
    *     path="/api/login",
    *     summary="Login",
    *     tags={"users"},
    *     operationId="login",
    *     @OA\RequestBody(
    *       description="Login User",
    *       required=true,
    *       @OA\JsonContent(ref="#/components/schemas/User")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="successful operation",
    *     ),
    *     @OA\Response(
    *         response="400",
    *         description="Invalid value",
    *     ),
    * )
*/

/** @OA\Get(
     *     path="/api/historyBalance",
     *     summary="History Balance info",
     *     tags={"history"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Invalid value",
     *     ),
     *      security={
     *          {"bearer_token": {}}
     *      }
     * )
*/

/** @OA\Put(
    *     path="/api/amountOperations",
    *     summary="Amount Operations",
    *     tags={"operations"},
    *     operationId="amountOperations",
    *     @OA\RequestBody(
    *       description="Amount Operations",
    *       required=true,
    *       @OA\JsonContent(ref="#/components/schemas/Amount")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="successful operation",
    *     ),
    *     @OA\Response(
    *         response="400",
    *         description="Invalid value",
    *     ),
    *      security={
    *          {"bearer_token": {}}
    *      }
    * )
*/

/** @OA\SecurityScheme(
  *     type="http",
  *     securityScheme="bearer_token",
  *     scheme="bearer",
  *     bearerFormat="JWT"
  * )
*/