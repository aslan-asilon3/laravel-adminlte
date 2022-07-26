<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DataTables;

class UnicharmMemberRaw extends Model
{
    use HasFactory;

    protected $table = 'unicharm_member_raw';
    protected $guarded = [];

    protected $fillable = [
        'id_member',
        'no_hp',
        'status_cek_data',
    ];

    public static function datatables($data_member_raw)
    {
        $datatables = Datatables::of($data_member_raw)
            ->editColumn('created_at', function(UnicharmMemberRaw $unicharm_member_raw) {
                if (!empty($unicharm_member_raw->created_at)) {
                    $result = date("d M Y", strtotime($unicharm_member_raw->created_at));
                } else {
                    $result = NULL;
                }

                return $result;
            })
            ->editColumn('status_cek_data', function($data){
                return $data->status_cek_data == "1" ? "<span class='badge badge-primary'>Active</span>" : "<span class='badge badge-danger'>Inactive</span>";
            })
            ->rawColumns(['status_cek_data'])
            ->make(true);

        return $datatables;
    }
}
