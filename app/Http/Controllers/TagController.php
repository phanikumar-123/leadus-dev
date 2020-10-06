<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getAllTags()
    {
        $tags = Tag::all();
        return response($tags->toJson())->header('Content-Type', 'application/json');
    }

    public function getLikeTags(Request $request)
    {
        $data = $request->validate([
            'q' => 'required|string'
        ]);

        $searchParm = '%' . $data['q'] . '%';
        $results = Tag::where('name', 'like', $searchParm)
            ->orderBy('name', 'asc')
            ->get();
        return response()->json($results);
    }

    public function saveTag(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $msg = [];

        $tag = Tag::where('name', $data['name'])->first();

        if ($tag == null) {
            $tag = new Tag;

            $tag->name = $data['name'];
            $tag->save();

            $msg = array(
                'created' => true,
                'id' => $tag->id
            );
        } else {
            $msg = array(
                'created' => false,
                'id' => $tag->id
            );
        }

        return response()->json($msg);
    }
}
