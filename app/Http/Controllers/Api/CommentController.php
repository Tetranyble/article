<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralRequest;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/articles/{articleId}/comment",
     *     tags={"Comments"},
     *     summary="The Comment paginated resource  collection",
     *     description="The Comment resource collection",
     *     operationId="Api/CommentController::index",
     *
     *     @OA\Parameter(
     *         name="articleId",
     *         in="path",
     *         description="The article resource Id",
     *         required=true,
     *
     *         @OA\Schema(
     *             type="string",
     *             format="int32"
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
     *         description="The paginated Comment resource collection",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(ref="#/components/schemas/CommentResource")
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
     * @return CommentCollection
     */
    public function index(GeneralRequest $request)
    {
        //I have intentionally remove filtering and others
        // this is bare minimum
        $comments = Comment::paginate($request->quantity ?? 10);

        return new CommentCollection($comments);
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
     *     path="/articles/{articleId}/comment/{commentId}",
     *     tags={"Comments"},
     *     summary="The Comment resource",
     *     description="The Comment resource",
     *     operationId="Api/CommentController::show",
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
     *     @OA\Parameter(
     *         name="commentId",
     *         in="path",
     *         description="The comment resource Id",
     *         required=true,
     *
     *         @OA\Schema(
     *             type="string",
     *             format="int32"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="The Comment resource",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(ref="#/components/schemas/CommentResource")
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
     * @param  Article  $article
     * @return JsonResponse
     */
    public function show($articleId, $commentId)
    {
        $comment = Comment::where('article_id', $articleId)
            ->where('id', $commentId)->firstOrFail();

        return $this->success(
            new CommentResource($comment->load('author'))
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
