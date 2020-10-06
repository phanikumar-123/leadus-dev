@extends('layouts.admin-base')

@section('title', 'Admin :: Create MCQ')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{$mode ?? '' == 'edit' ? 'Edit MCQ' : 'Create MCQ'}}</h1>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Select subject and topic</h6>
                </div>
                <div class="card-body">
                    <form class="form-inline prelims-subject-topic-form">
                        <label for="subject" class="mr-sm-2">Select subject:</label>
                        <select class="form-control mb-2 mr-sm-2 subject" name="subject" id="subject" value="{{$mcq->subject ?? ''}}">
                            <option value="">Select Subject</option>
                        </select>
                        <label for="topic" class="mr-sm-2">Select topic:</label>
                        <select class="form-control mb-2 mr-sm-2 topic" name="topic" id="topic" value="{{$mcq->topic  ?? ''}}">
                            <option value="">Select Topic</option>
                        </select>
                    </form>
                </div>
                <div class="card-footer validation-msg">
                    * Please select a subject and topic
                </div>
            </div>
        </div>
    </div>

    <div class="mcq-details-wrapper d-none">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Question</h6>
                    </div>
                    <div class="card-body">
                        <textarea class="rte-editor rte-editor-big" name="question" value="{{$mcq->question ?? ''}}"></textarea>
                    </div>
                    <div class="card-footer validation-msg">
                        * Please enter the question
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Option A</h6>
                    </div>
                    <div class="card-body">
                        <textarea class="rte-editor rte-editor-one-line" name="optionA" value="{{$mcq->option_a ?? ''}}"></textarea>
                    </div>
                    <div class="card-footer validation-msg">
                        * Please enter text for option A
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Option B</h6>
                    </div>
                    <div class="card-body">
                        <textarea class="rte-editor rte-editor-one-line" name="optionB" value="{{$mcq->option_b ?? ''}}"></textarea>
                    </div>
                    <div class="card-footer validation-msg">
                        * Please enter text for option B
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Option C</h6>
                    </div>
                    <div class="card-body">
                        <textarea class="rte-editor rte-editor-one-line" name="optionC" value="{{$mcq->option_c ?? ''}}"></textarea>
                    </div>
                    <div class="card-footer validation-msg">
                        * Please enter text for option C
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Option D</h6>
                    </div>
                    <div class="card-body">
                        <textarea class="rte-editor rte-editor-one-line" name="optionD" value="{{$mcq->option_d ?? ''}}"></textarea>
                    </div>
                    <div class="card-footer validation-msg">
                        * Please enter text for option D
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Correct Answer</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <label for="answer">Select the correct answer for this question:</label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="answer" value="A" {{isset($mcq->answer) && $mcq->answer == 'A' ? 'checked' : ''}}>Option A
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="answer" value="B" {{isset($mcq->answer) && $mcq->answer == 'B' ? 'checked' : ''}}>Option B
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="answer" value="C"    {{isset($mcq->answer) && $mcq->answer == 'C' ? 'checked' : ''}}>Option C
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="answer" value="D" {{isset($mcq->answer) && $mcq->answer == 'D' ? 'checked' : ''}}>Option D
                            </label>
                        </div>
                    </div>
                    <div class="card-footer validation-msg">
                        * Please select the correct answer for this question
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tags</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group autocomplete">
                            <input type="text" class="form-control" id="tags-input" placeholder="Add tags (optional)">
                        </div>
                        <ul class="tags">
                            <script type="text/template" class="template">
                                <li><a href="javascript:void(0)" class="tag">{name}<i class="fas fa-fw fa-times delete-tag"></i></a></li>
                            </script>
                            @if (isset($mcq->tags))
                                @foreach ($mcq->tags as $tag)
                                    <li data-tagid="{{$tag->id}}"><a href="javascript:void(0)" class="tag">{{$tag->name}}<i class="fas fa-fw fa-times delete-tag"></i></a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <input type="hidden" name="tags" value="{{$tags ?? ''}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 save-btn">
                <button type="button" data-mcq-id="{{$mcq->id ?? ''}}" class="btn btn-primary" id="{{$mode ?? '' == 'edit' ? 'update-mcq' : 'save-mcq'}}">Save MCQ</button>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
