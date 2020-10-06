<?php

namespace App\Http\Controllers;

use App\McqQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use stdClass;

class PrelimsController extends Controller
{
    public function renderCreateMcqView()
    {
        $mcq = new stdClass;
        return view('admin.create-mcq', ['mcq' => $mcq]);
    }

    public function renderManageMcqView()
    {
        return view('admin.manage-mcq');
    }

    public function getPrelimsSyllabus()
    {
        $syllabusFile = File::get(base_path('resources/data/prelims-syllabus-data.json'));
        return response($syllabusFile)->header('Content-Type', 'application/json');
    }

    public function saveMcqImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $path = $request->file('image')->store('mcq-questions', 'public');

        $msg = array(
            'status' => true,
            'path' => $path
        );

        return response()->json($msg);
    }

    private function validateMcq(Request $request)
    {
        return $request->validate([
            'subject' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'question' => 'required|string',
            'optionA' => 'required|string',
            'optionB' => 'required|string',
            'optionC' => 'required|string',
            'optionD' => 'required|string',
            'answer' => 'required|string|max:2',
            'tags' => 'nullable|array'
        ]);
    }

    public function createMcq(Request $request)
    {
        $this->validateMcq($request);

        $mcqQuestion = McqQuestion::create([
            'subject' => $request->subject,
            'topic' => $request->topic,
            'question' => $request->question,
            'option_a' => $request->optionA,
            'option_b' => $request->optionB,
            'option_c' => $request->optionC,
            'option_d' => $request->optionD,
            'answer' => $request->answer
        ]);

        $mcqQuestion->tags()->sync($request->tags);

        $msg = array(
            'status' => true,
            'id' => $mcqQuestion->id
        );

        return response()->json($msg);
    }

    public function getMcqs(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string|max:255',
            'topic' => 'required|string|max:255'
        ]);

        $mcqs = McqQuestion::with('tags')->where([
            ['subject', $data['subject']],
            ['topic', $data['topic']]
        ])->get();
        return response()->json($mcqs);
    }

    public function editMcq($id)
    {
        $mcq = McqQuestion::with('tags')->find($id);
        $tags = '';
        foreach ($mcq->tags as $tag) {
            $tags .= $tag->id . ',';
        }
        return view('admin.create-mcq', [
            'mcq' => $mcq,
            'mode' => 'edit',
            'tags' => $tags
        ]);
    }

    public function updateMcq($id, Request $request)
    {
        $this->validateMcq($request);

        $status = McqQuestion::find($id)
            ->update([
                'subject' => $request->subject,
                'topic' => $request->topic,
                'question' => $request->question,
                'option_a' => $request->optionA,
                'option_b' => $request->optionB,
                'option_c' => $request->optionC,
                'option_d' => $request->optionD,
                'answer' => $request->answer
            ]);

        $msg = array(
            'status' => $status
        );

        return response()->json($msg);
    }

    public function deleteMcq($id)
    {
        $count = McqQuestion::destroy($id);

        $msg = array(
            'status' => $count > 0
        );

        return response()->json($msg);
    }
}
