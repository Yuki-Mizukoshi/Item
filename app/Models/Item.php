<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;// 追加

class Item extends Model
{
    use Sortable; //追加

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'price',
        'stock',
        'type',
        'detail',
    ];

    const TYPES=[
        '1'=>'テレビ',
        '2'=>'冷蔵庫',
        '3'=>'洗濯機',
        '4'=>'オーブンレンジ',
        '5'=>'ガスコンロ'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
}
