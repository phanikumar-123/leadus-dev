@extends('layouts.admin-base')

@section('title', 'Admin :: Manage MCQ\'s')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Manage MCQ's</h1>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Please select</h6>
                </div>
                <div class="card-body">
                    <form class="form-inline prelims-subject-topic-form fetch-mcqs-form">
                        <label for="subject" class="mr-sm-2">Select subject:</label>
                        <select class="form-control mb-2 mr-sm-2 subject" id="subject">
                            <option value="">Select Subject</option>
                        </select>
                        <label for="topic" class="mr-sm-2">Select topic:</label>
                        <select class="form-control mb-2 mr-sm-2 topic" id="topic">
                            <option value="">Select Topic</option>
                        </select>
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </form>
                </div>
                <div class="card-footer validation-msg">
                    * Please select a subject and topic
                </div>
            </div>
        </div>
    </div>

    <div class="row mcq-table-row d-none">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Available MCQ's</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mcq-table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Question No.</th>
                                    <th>Subject</th>
                                    <th>Topic</th>
                                    <th>Tags</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody id='mcq-table-body'></tbody>
                        </table>

                        <script type="text/template" id="mcq-row-template">
                            <tr>
                                <td>{qno}</td>
                                <td>{subject}</td>
                                <td>{topic}</td>
                                <td>{tags}</td>
                                <td class="options-col">
                                    <a class="delete-mcq" data-id="{mcqid}" href="#"><i class="fas fa-fw fa-trash"></i></a>
                                    <a href="{editurl}"><i class="fas fa-fw fa-edit"></i></a>
                                </td>
                            </tr>
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
