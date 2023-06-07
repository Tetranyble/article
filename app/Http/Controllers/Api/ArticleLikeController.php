<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleLikeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/articles/{articleId}/like",
     *     tags={"Articles"},
     *     summary="The Article like count",
     *     description="The Article like count",
     *     operationId="Api/ArticleLikeController::invoke",
     *
     *     @OA\Parameter(
     *         name="articleId",
     *         in="path",
     *         description="The Article resource ID",
     *         required=true,
     *
     *         @OA\Schema(
     *             type="string",
     *             format="int32",
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *
     *         @OA\JsonContent(
     *              example={ "like_count":3844}
     *         )
     *     ),
     *
     *    @OA\Response(response=400, ref="#/components/responses/400"),
     *    @OA\Response(response=403, ref="#/components/responses/403"),
     *    @OA\Response(response=404, ref="#/components/responses/404"),
     *    @OA\Response(response=422, ref="#/components/responses/422"),
     *    @OA\Response(response="default", ref="#/components/responses/500")
     * )
     *
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, Article $article)
    {
        return $this->success([
            'like_count' => $article->likeCount(),
        ]);
    }
}
