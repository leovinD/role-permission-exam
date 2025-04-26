<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     */
    public function view(User $user, Post $post)
    {
        // Check if the user can 'view' any post or a specific post
        if ($user->hasRole('admin')) {
            return true;
        }

        if ($user->hasRole('editor') && $user->can('view posts')) {
            return true;
        }

        // Check if the user owns the post (for authors)
        if ($user->hasRole('author') && $user->id === $post->user_id) {
            return true;
        }

        return $user->can('view posts');
    }

    /**
     * Determine whether the user can view any post.
     */
    public function viewAny(User $user)
    {
        // Admin or Editor can view all posts
        if ($user->hasRole('admin') || $user->hasRole('editor')) {
            return true;
        }

        return $user->can('view any posts');
    }

    /**
     * Determine whether the user can create a post.
     */
    public function create(User $user)
    {
        // Admin and Editor can create posts
        if ($user->hasRole('admin') || $user->hasRole('editor')) {
            return true;
        }

        // Check if user has permission to create posts
        return $user->can('create posts');
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post)
    {
        // Admin can update any post
        if ($user->hasRole('admin')) {
            return true;
        }

        // Editor can update any post
        if ($user->hasRole('editor') && $user->can('update posts')) {
            return true;
        }

        // Author can only update their own posts
        if ($user->hasRole('author') && $user->id === $post->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post)
    {
        // Admin can delete any post
        if ($user->hasRole('admin')) {
            return true;
        }

        // Editor can delete any post
        if ($user->hasRole('editor') && $user->can('delete posts')) {
            return true;
        }

        // Author can delete their own posts
        if ($user->hasRole('author') && $user->id === $post->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the post.
     */
    public function restore(User $user, Post $post)
    {
        // Admin can restore any post
        if ($user->hasRole('admin')) {
            return true;
        }

        // Editor can restore any post
        if ($user->hasRole('editor') && $user->can('restore posts')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the post.
     */
    public function forceDelete(User $user, Post $post)
    {
        // Admin can permanently delete any post
        if ($user->hasRole('admin')) {
            return true;
        }

        // Editor can permanently delete any post
        if ($user->hasRole('editor') && $user->can('force delete posts')) {
            return true;
        }

        return false;
    }
}
