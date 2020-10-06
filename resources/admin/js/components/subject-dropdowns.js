$(document).ready(function () {
    var $form = $('.prelims-subject-topic-form');

    if ($form.length) {
        var $subject = $form.find('.subject'),
            $topic = $form.find('.topic'),
            data,
            queryParamSubject = utils.getParameterByName('subject'),
            queryParamTopic = utils.getParameterByName('topic');

        $.get('/admin/prelims/get-syllabus').done(function (resp) {
            if (typeof resp === 'object' && resp.length) {
                data = resp;
                $subject.empty();
                var fragment = document.createDocumentFragment();
                fragment.appendChild($('<option value="">Select Subject</option>').get(0));
                data.forEach(function (sub, i) {
                    fragment.appendChild($(`<option value="${sub.name}" data-id="${i}">${sub.name}</option>`).get(0));
                });
                $subject.html(fragment);

                if (queryParamSubject) {
                    $subject.val(queryParamSubject);
                    $subject.trigger('change');
                }

                if ($subject.attr('value')) {
                    $subject.val($subject.attr('value'));
                    $subject.trigger('change');
                }
            }
        }).fail(function () {
            console.error('Call to fetch prelims syllabus failed!!');
        });

        $subject.change(function () {
            var $this = $(this),
                subject = data[$this.find('option:selected').data('id')];

            $topic.tooltip('dispose');
            $('.mcq-details-wrapper').addClass('d-none');

            if (subject) {
                var topics = subject.topics;
                if (topics.length) {
                    var fragment = document.createDocumentFragment();
                    fragment.appendChild($('<option value="">Select Topic</option>').get(0));
                    topics.forEach(function (topic) {
                        var topicName = topic,
                            tooltipHtml = '';
                        if (topicName.length > 28) {
                            topicName = topicName.substring(0, 27) + '...';
                            tooltipHtml = `title="${topic}"`;
                        }
                        fragment.appendChild($(`<option ${tooltipHtml} value="${topic}">${topicName}</option>`).get(0));
                    });
                    $topic.html(fragment);

                    if(queryParamTopic) {
                        $topic.val(queryParamTopic);
                        $topic.trigger('change');
                    }

                    if ($topic.attr('value')) {
                        $topic.val($topic.attr('value'));
                        $topic.trigger('change');
                    }
                }
            } else {
                $topic.html('<option value="">Select Topic</option>');
            }
        });

        $topic.change(function () {
            var $this = $(this),
                selectedOptionText = $this.find('option:selected').text(),
                val = $this.val();
            if (val) {
                $('.mcq-details-wrapper').removeClass('d-none');
            }

            if (selectedOptionText.endsWith('...')) {
                var tooltip = {
                    title: $this.val()
                };
                $this.tooltip(tooltip);
            } else {
                $this.tooltip('dispose');
            }
        });
    }
});
