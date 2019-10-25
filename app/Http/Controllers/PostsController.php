<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostsController extends Controller
{
    public function index()
    {
        return \response()->json(Posts::paginate());
    }

    public function store(Request $request)
    {
        $post = new Posts([
            'title' => $request->title,
            'content' => $request->get('content'),
        ]);
        $post->save();
        return \response()->json($post, Response::HTTP_CREATED);
    }

    public function show(Posts $post)
    {
        return \response()->json($post);
    }

    public function update(Request $request, Posts $post)
    {
        if(null !== $request->title) {
            $post->title = $request->title;
        }
        if(null !== $request->get('content')) {
            $post->content = $request->get('content');
        }
        $post->save();
        return \response()->json($post);
    }

    public function destroy(Posts $post)
    {
        $post->delete();
        return \response()->json('DELETED');
    }
}
