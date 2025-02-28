<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Events\DatabaseOperation;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        "title",
        "description",
        "type",
        "language",
        "editor",
        "category",
        "price",
        "author",
        "cover",
    ];
    protected static function boot()
    {
        parent::boot();

        static::created(function ($book) {
            event(new DatabaseOperation('insert', $book->getTable(), auth()->id()));
        });

        static::updated(function ($book) {
            event(new DatabaseOperation('update', $book->getTable(), auth()->id()));
        });

        static::deleted(function ($book) {
            event(new DatabaseOperation('delete', $book->getTable(), auth()->id()));
        });
    }
}
