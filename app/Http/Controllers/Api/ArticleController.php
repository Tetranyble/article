<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/articles",
     *     tags={"Articles"},
     *     summary="The Article paginated resource  collection",
     *     description="The Article resource collection",
     *     operationId="Api/ArticleController::index",
     *
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search term to filter",
     *         required=false,
     *
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *     @OA\Parameter(
     *         name="quantity",
     *         in="query",
     *         description="The resource per page",
     *         required=false,
     *
     *         @OA\Schema(
     *             type="string",
     *             format="int32"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="The paginated Article resource collection",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(ref="#/components/schemas/ArticleResource")
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
     * Display a listing of the Article resource.
     *
     * @param  GeneralRequest  $request
     * @return ArticleCollection
     */
    public function index(Request $request)
    {
        $articles = (new Article)->with('author')->filter($request)
            ->paginate($request->quantity ?? 10);

        return new ArticleCollection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/articles/{article}",
     *     tags={"Articles"},
     *     summary="The Article resource",
     *     description="The Article resource",
     *     operationId="Api/ArticleController::show",
     *
     *     @OA\Parameter(
     *         name="article",
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
     *         description="The Article resource",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(ref="#/components/schemas/ArticleResource")
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
    public function show(Article $article)
    {

        return $this->success(
            new ArticleResource($article->load('author'))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
