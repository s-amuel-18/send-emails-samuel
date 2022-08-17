<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Requirements extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function datatableRequirementsQuery()
    {
        return DB::table("requirements AS req")
            ->select(
                "req.id AS req_id",
                "req.user_id",
                "req.category_id",
                "req.name AS req_name",
                "req.description AS req_description",
                "req.url AS req_url",
                "req.created_at AS req_created_at",
                "req.updated_at AS req_update_at",
                "us.username AS us_username",
                "cat.name AS cat_name",
            )
            ->leftJoin("users AS us", function ($j) {
                $j->on("us.id", "=", "req.user_id")
                    ->whereNull("us.deleted_at");
            })
            ->leftJoin("categories AS cat", function ($j) {
                $j->on("cat.id", "=", "req.category_id")
                    ->whereNull("us.deleted_at");
            })
            ->whereNull("req.deleted_at");
    }
}
