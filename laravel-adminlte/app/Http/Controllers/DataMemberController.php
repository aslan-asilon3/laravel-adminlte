<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnicharmMember;
use App\Exports\ExportUnicharmMember;
use Maatwebsite\Excel\Facades\Excel;

class DataMemberController extends Controller
{
    //

    public function ajax(Request $request)
    {
        $data_member = UnicharmMember::select('id', 'id_member', 'no_hp', 'created_at');
        //var_dump(json_encode($request->id_member));exit();
        if (!empty($request->id_member)) {
            
            $data_member->where('id_member', $request->id_member);
        }

        if (!empty($request->no_hp)) {
            $data_member->where('no_hp', $request->no_hp);
        }

        $data_member->orderBy('id', 'ASC');

        $datatables = UnicharmMember::datatables($data_member);

        return $datatables;
    }
}
