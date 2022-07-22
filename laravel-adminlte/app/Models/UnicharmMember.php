<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DataTables;

class UnicharmMember extends Model
{
    use HasFactory;

    protected $table = 'unicharm_members';
    protected $guarded = [];

    protected $fillable = [
        'id_member',
        'no_hp',
    ];

    public static function datatables($data_member)
    {
        $datatables = Datatables::of($data_member)
            ->editColumn('created_at', function(UnicharmMember $unicharm_member) {
                if (!empty($unicharm_member->created_at)) {
                    $result = date("d M Y", strtotime($unicharm_member->created_at));
                } else {
                    $result = NULL;
                }

                return $result;
            })
            ->orderColumns(['id_member', 'no_hp'], '-:column $1')
            ->make(true);

        return $datatables;
    }

}
