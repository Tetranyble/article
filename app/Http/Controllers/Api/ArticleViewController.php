<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleViewController extends Controller
{
    /**
     * @OA\Get(
     *     path="/articles/{articleId}/view",
     *     tags={"Articles"},
     *     summary="The Article view count",
     *     description="The Article view count",
     *     operationId="Api/ArticleViewController::invoke",
     *
     *     @OA\Parameter(
     *         name="articleId",
     *         in="path",
     *         description="The Article resource ID",
     *         required=true,
     *
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *
     *         @OA\JsonContent(
     *              example={ "view_count":38464}
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
            'view_count' => $article->views,
        ]);
    }
}
