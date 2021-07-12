<?php

namespace App\Imports;

use App\Models\User;
use App\Models\siswas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;

use Auth;
use Spatie\Permission\Models\Role;
use Hash;

HeadingRowFormatter::default('none');

class SiswasImport implements ToArray, WithHeadingRow, WithEvents
{
    public $sheetNames;
    public $sheetData;

    public function __construct(){
        $this->sheetNames = [];
        $this->sheetData = [];
    }
    public function array(array $array)
    {
        $this->sheetData[$this->sheetNames[count($this->sheetNames)-1]] = $array;
    }
    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) {
                $this->sheetNames[] = $event->getSheet()->getTitle();
            }
        ];
    }
    public function chunkSize(): int
    {
        return 100;
    }


    public function getSheetNames() {
        return $this->sheetData;
    }
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new siswas([
    //             'nis'=>$row['nis'],
    //          //   'slug'=>str_slug($row[0]),
    //             'nama'=>$row['nama'],
    //             'gender'=>$row['gender'],
    //             'thnMasuk'=>$row['thnmasuk'],
    //             'bapak'=>$row['bapak'],
    //             'ibu'=>$row['ibu'],
    //             'hpOrtu'=>$row['hportu'],
    //             'agama'=>$row['agama'],
    //             'alamat'=>$row['alamat']
                
            
    //     ]);
    //  }

    //  public function collection(Collection $collection)
    // {
    //     foreach ($collection as $row) {
    //     if ($row->filter()->isNotEmpty()) {

    //         $user = User::create([
    //             'username'=>$row['nis'],
    //             'password'=>Hash::make('12345678'),
    //             'name'=>$row['nama'],
    //         ]);
    //         //$role_r = Role::where('name', '=', 'Siswa')->firstOrFail();
    //         //$user->assignRole($role_r);

    //             $siswas = siswas::create([
    //             'nis'=>$row['nis'],
    //          //   'slug'=>str_slug($row[0]),
    //             'nama'=>$row['nama'],
    //             'gender'=>$row['gender'],
    //             'thnMasuk'=>$row['thnmasuk'],
    //             'bapak'=>$row['bapak'],
    //             'ibu'=>$row['ibu'],
    //             'hpOrtu'=>$row['hportu'],
    //             'agama'=>$row['agama'],
    //             'alamat'=>$row['alamat'],
    //             'user_id'=>$user->id

    //             ]);

    //     }
                
    //   }
       
    //  }
    
}
