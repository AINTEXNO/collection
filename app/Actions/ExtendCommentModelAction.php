<?php


namespace App\Actions;


use App\Models\Comment;

class ExtendCommentModelAction
{
    public function __invoke($comments)
    {
        $comments->each(function($item) {
            $item->created = date_format($item->created_at, "d F, Y");;
            $item->photo = $item->user->photo;
            $item->name = "{$item->user->name} {$item->user->surname}";
            $item->author = $item->user->api_token;
        });

        return $comments;
    }
}
