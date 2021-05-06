<?php

namespace App\Imports;

use App\Models\Stock;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class StocksImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[0]!='id') {

            $stock = Stock::find($row[0]);
            $product = Product::find($stock->product_id);
            dd($product,$stock);
            if ($row[1]) {
            $stock->name = $row[1];
            }

            if ($row[2]) {
            $stock->price = $row[2];
            }

            if ($row[4]!='') {
            $stock->onSale = 1;
            $stock->discount = $row[4];
            }

            if ($row[4]==0) {
            $stock->onSale = 0;
            $stock->discount = 0;
            }

            $stock->save();
      }
    }
}
