<?php

namespace App\Imports;

use App\MOdels\TempUser;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TempUsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new TempUser([
            'id_number' => $row['id_number'],
            'name' => $row['name'],
            'email' => $row['email'],
            'address' => $row['address'],
            'place' => $row['place'],
            'date' => $row['date'],
            'parent_email' => $row['parent_email'],
            'departement' => $row['departement'],
        ]);
    }
}
