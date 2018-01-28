<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * @var string
     */
    protected $table;

    /**
     * BookPolicy constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->table = $user->getTable();
    }

    /**
     * @param User   $user
     * @param string $ability
     * @param Book $model
     *
     * @return bool
     */
    public function before(User $user, $ability, Book $model)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the book.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return mixed
     */
    public function view(User $user, Book $book)
    {
        if (!$user->hasPermissionTo("view $this->table")) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can display the role.
     *
     * @param  \App\Models\User  $user
     * @param  Book $book
     * @return mixed
     */
    public function display(User $user, Book $book)
    {
        if (!$user->hasPermissionTo("display $this->table")) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can create books.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (!$user->hasPermissionTo("create $this->table")) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can update the book.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return mixed
     */
    public function update(User $user, Book $book)
    {
        if ($user->id !== $book->user_id) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can delete the book.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return mixed
     */
    public function delete(User $user, Book $book)
    {
        if ($user->id !== $book->user_id) {
            return false;
        };

        return true;
    }
}
