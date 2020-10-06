(function () {
    let rteToolBarOptions = [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture']],
        ['view', ['fullscreen', 'help']],
    ],
        $tags,
        $tagHiddenField,
        currentFocus;

    function init() {
        $tags = $('#tags-input');
        $tagHiddenField = $('[name="tags"]');

        attachEvents();

        $('.rte-editor-big').each(function () {
            let $this = $(this);
            $this.summernote({
                placeholder: 'Type your question here',
                tabsize: 2,
                height: 400,
                toolbar: rteToolBarOptions,
                callbacks: {
                    onImageUpload: uploadRteImage
                }
            });
            if ($this.attr('value')) {
                $this.summernote("code", $this.attr('value'));
            }
        });

        $('.rte-editor-one-line').each(function () {
            let $this = $(this);
            $this.summernote({
                placeholder: 'Type your answer here',
                tabsize: 2,
                toolbar: rteToolBarOptions,
                callbacks: {
                    onImageUpload: uploadRteImage
                }
            });
            if ($this.attr('value')) {
                $this.summernote("code", $this.attr('value'));
            }
        });
    }

    function uploadRteImage(files) {
        var fd = new FormData(),
            $this = $(this);

        fd.append('image', files[0]);

        $.ajax({
            url: '/admin/prelims/upload-mcq-image',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
        }).done(function (resp) {
            if (resp.status) {
                var imgTemp = `/storage/${resp.path}`;
                $this.summernote('insertImage', imgTemp);
            }
        }).fail(function () {
            console.error('Uploading RTE failed!!');
        });
    }

    function attachEvents() {
        $(document).on('click', '.delete-tag', deleteTags);

        $(document).on('click', '#save-mcq', saveMcq);

        $tags.on('input', handleTagsInput);

        $tags.keydown(handleTagsKeydown);

        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });

        $(document).on('click', '#update-mcq', updateMcq);
    }

    function handleTagsInput() {
        var autocompleteList,
            suggestion,
            $this = $(this),
            val = this.value;

        closeAllLists();
        if (!val) { return false; }
        currentFocus = -1;
        autocompleteList = $(`<div class="autocomplete-items"></div>`)

        $this.parent().append(autocompleteList);

        $.get('/admin/search-tag', { q: val }).done(function (resp) {
            for (var i = 0; i < resp.length; i++) {
                var suggestionName = resp[i].name;

                if (suggestionName.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    suggestion = $(`<div data-id="${resp[i].id}"><strong>${suggestionName.substr(0, val.length)}</strong>${suggestionName.substr(val.length)}</div>`)
                    suggestion.on("click", function (e) {
                        $tags.val($(this).text());
                        $tags.focus();
                        addTag($this, $(this).data('id'));
                        closeAllLists();
                    });
                    autocompleteList.append(suggestion);
                }
            }
        }).fail(function () {
            console.error('Failed to get Tag suggestion!!');
        });
    }

    function handleTagsKeydown(e) {
        var $this = $(this),
            autocompleteList = $this.siblings('.autocomplete-items')
        if (autocompleteList.length) autocompleteList = autocompleteList.find('div');

        if (e.keyCode == 40) {
            currentFocus++;
            addActive(autocompleteList);
        } else if (e.keyCode == 38) {
            currentFocus--;
            addActive(autocompleteList);
        } else if (e.keyCode === 13) {
            e.preventDefault();
            if (currentFocus > -1) {
                if (autocompleteList.length) autocompleteList.get(currentFocus).click();
            } else {
                addTag($this);
                closeAllLists();
            }
        }
    }

    function closeAllLists(elmnt) {
        currentFocus = -1;
        $(".autocomplete-items").remove();
    }

    function addTag($context, id) {
        var value = $context.val(),
            $tags = $context.closest('.card-body').find('.tags'),
            template = $context.closest('.card-body').find('.template').html(),
            $tag = $(template.replace('{name}', value));

        if (id) {
            $tagHiddenField.val($tagHiddenField.val() + id + ',');
            $tag.attr('data-tagid', id);
        } else {
            $.post('/admin/save-tag', { name: value }).done(function (resp) {
                if (resp.id) {
                    $tagHiddenField.val($tagHiddenField.val() + resp.id + ',');
                    $tag.attr('data-tagid', resp.id);
                }
            });
        }

        $tags.append($tag);
        $context.val('');
    }

    function addActive(autocompleteList) {
        /*a function to classify an item as "active":*/
        if (!autocompleteList.length) return false;
        /*start by removing the "active" class on all items:*/
        autocompleteList.removeClass('autocomplete-active');
        if (currentFocus >= autocompleteList.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (autocompleteList.length - 1);
        autocompleteList.get(currentFocus).classList.add("autocomplete-active");
    }

    function saveMcq(e) {
        e.preventDefault();
        var error = false,
            answer = $('[name="answer"]:checked').length ? $('[name="answer"]:checked').val() : '',
            data = {};

        $('.card').removeClass('validation-failed');

        $('select, .rte-editor').each(function () {
            var $this = $(this),
                val = $this.val();

            if (typeof val !== 'string' || val === '') {
                $this.closest('.card').addClass('validation-failed');
                error = true;
            }

            data[$this.attr('name')] = val;
        });

        if (answer === '') {
            $('[name="answer"]').closest('.card').addClass('validation-failed');
            error = true;
        }

        if (error) {
            $.toaster({
                message: 'Please fill the required fields',
                title: 'Validation Error',
                priority: 'danger',
                settings: {
                    'timeout': 5000
                }
            });
            return false;
        }

        data.answer = answer;

        if ($tagHiddenField.val()) {
            let tagsArr = $tagHiddenField.val().split(',');
            data.tags = tagsArr.filter(function (elem) {
                return (typeof elem === 'string' && elem !== '');
            }).map(function (elem) {
                return elem.trim();
            });
        }

        showLoader();

        $.post('/admin/prelims/create-mcq', data).done(function () {
            let uri = `${location.pathname}?subject=${data.subject}&topic=${data.topic}`;
            location.href = uri;
        }).fail(function () {
            console.error('Call to store MCQ failed!!');
        }).always(function () {
            hideLoader();
        });
    };

    function updateMcq(e) {
        e.preventDefault();
        var error = false,
            $context = $(this),
            mcqId = $context.data('mcq-id'),
            answer = $('[name="answer"]:checked').length ? $('[name="answer"]:checked').val() : '',
            data = {};

        $('.card').removeClass('validation-failed');

        $('select, .rte-editor').each(function () {
            var $this = $(this),
                val = $this.val();

            if (typeof val !== 'string' || val === '') {
                $this.closest('.card').addClass('validation-failed');
                error = true;
            }

            data[$this.attr('name')] = val;
        });

        if (answer === '') {
            $('[name="answer"]').closest('.card').addClass('validation-failed');
            error = true;
        }

        if (error) {
            utils.showError('Please fill the required fields', 'Validation Error');
            return false;
        }

        data.answer = answer;

        if ($tagHiddenField.val()) {
            let tagsArr = $tagHiddenField.val().split(',');
            data.tags = tagsArr.filter(function (elem) {
                return (typeof elem === 'string' && elem !== '');
            }).map(function (elem) {
                return elem.trim();
            });
        }

        showLoader();
        $.post(`/admin/prelims/update-mcq/${mcqId}`, data).done(function (resp) {
            if (resp.status) {
                location.href = '/admin/prelims/manage-mcq';
            } else {
                utils.showError('Unable to edit the MCQ. Please try again!!', 'Network Error');
            }
        }).fail(function () {
            console.error('Call to store MCQ failed!!');
        }).always(function () {
            hideLoader();
        });
    };

    function deleteTags(e) {
        e.preventDefault();
        let $tag = $(this).closest('li'),
            tagId = $tag.attr('data-tagid'),
            currentTags = $tagHiddenField.val();
        if (currentTags) {
            let newTags = currentTags.split(',').filter(function (elem) {
                return tagId !== elem.trim()
            }).reduce(function (aggr, elem) {
                return aggr += ',' + elem;
            });
            $tagHiddenField.val(newTags);
        }
        $tag.remove();
    }

    $(document).ready(init);
})();
