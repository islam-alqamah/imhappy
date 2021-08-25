<?php

namespace App\Imports;

use App\Models\Branch;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BranchesImport implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        return new Branch([
            'name' => $row['branch_name'],
            'phone' => $row['branch_phone'],
            'address' => $row['branch_address'],
            'team_id' => currentTeam()->id,
            'city_id'=>1
        ]);
    }
}
