<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class McqQuestion extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tags_mcq_questions', 'mcq_question_id', 'tag_id');
    }
}
