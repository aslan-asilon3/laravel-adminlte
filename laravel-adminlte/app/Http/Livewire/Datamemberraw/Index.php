<?php

namespace App\Http\Livewire\Datamemberraw;

use Livewire\Component;
use App\Models\UnicharmMemberRaw;
use App\Exports\ExportUnicharmMemberRaw;
use Maatwebsite\Excel\Facades\Excel;


class Index extends Component
{
    public function render()
    {
        return view('livewire.datamemberraw.index');
    }


    public function ajax(Request $request)
    {
        $data_member_raw = UnicharmMemberRaw::select('id', 'id_member', 'no_hp','status_cek_data', 'created_at');
        //var_dump(json_encode($request->id_member));exit();
        if (!empty($request->id_member)) {
            
            $data_member_raw->where('id_member', $request->id_member);
        }

        if (!empty($request->no_hp)) {
            $data_member_raw->where('no_hp', $request->no_hp);
        }

        if (!empty($request->status_cek_data)) {
            $data_member_raw->where('no_hp', $request->status_cek_data);
        }

        $data_member_raw->orderBy('id', 'ASC');

        $datatables = UnicharmMemberRaw::datatables($data_member_raw);

        return $datatables;
    }

    public function export() 
    {
        return Excel::download(new ExportUnicharmMemberRaw, 'data-member ' .now('l F Y'). '.xlsx');
    }
}
