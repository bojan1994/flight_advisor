<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given comment belongs to the user.
     *
     * @param \App\Models\User $user
     * @param Comment $comment
     * @return bool
     */
    public function userComment(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
