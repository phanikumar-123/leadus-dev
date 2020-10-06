$(document).ready(function () {

    let data = {};

    function init() {
        attachEvents();
    }

    function attachEvents() {
        $('.fetch-mcqs-form').submit(fetchMcqs);
        $(document).on('click', '.delete-mcq', deleteMcq);
    }

    function fetchMcqs(e) {
        e.preventDefault();
        let $this = $(this),
            error = false;

        $this.closest('.card').removeClass('validation-failed');

        $this.find('select').each(function () {
            if (typeof this.value !== 'string' || this.value === '') {
                $(this).closest('.card').addClass('validation-failed');
                error = true;
            }
        });

        if (error) {
            return false;
        }

        data = {
            'subject': $this.find('.subject').val(),
            'topic': $this.find('.topic').val()
        }

        loadMcqs();
    }

    function loadMcqs() {
        showLoader();
        $.get('/admin/prelims/get-mcqs', data).done(function (resp) {
            $('#mcq-table-body').empty();
            if (Array.isArray(resp) && resp.length) {
                let template = $('#mcq-row-template').html(),
                    fragment = document.createDocumentFragment();

                resp.forEach(function (mcq, i) {
                    let mcqHtml = template,
                        tags = '';
                    mcqHtml = mcqHtml.replace('{qno}', (i + 1));
                    mcqHtml = mcqHtml.replace('{subject}', mcq.subject);
                    mcqHtml = mcqHtml.replace('{topic}', mcq.topic);
                    mcqHtml = mcqHtml.replace('{mcqid}', mcq.id);
                    mcqHtml = mcqHtml.replace('{editurl}', `/admin/prelims/edit-mcq/${mcq.id}`);
                    if (Array.isArray(mcq.tags) && mcq.tags.length) {
                        mcq.tags.forEach(function (tag, i) {
                            tags += tag.name;
                            if (i < (mcq.tags.length - 1)) {
                                tags += ', ';
                            }
                        });
                    }
                    mcqHtml = mcqHtml.replace('{tags}', tags);
                    fragment.append($(mcqHtml).get(0));
                });
                $('#mcq-table-body').append(fragment);
            }
            $('#dataTable').DataTable();
            $('.mcq-table-row').removeClass('d-none');
        }).always(function () {
            hideLoader();
        })
    }

    function deleteMcq(e) {
        e.preventDefault();
        let id = $(this).data('id');
        var confirmed = confirm('Are you sure you want to delete this MCQ? Press Yes to confirm.');

        if (id && confirmed) {
            showLoader();
            $.get(`/admin/prelims/delete-mcq/${id}`).done(function (resp) {
                if (resp.status) {
                    loadMcqs();
                } else {
                    utils.showError('Unable to delete the mcq. Please try again!!', 'Network Error')
                }
            }).always(function () {
                hideLoader();
            })
        }
    }

    $(document).ready(init);
});
