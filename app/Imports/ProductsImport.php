<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      if ($row[0]!='id') {

        $product = Product::find($row[0]);

        if ($row[1]) {
          $product->name = $row[1];
        }

        if ($row[2]) {
          $product->price = $row[2];
        }

        if ($row[4]!='') {
          $product->onSale = 1;
          $product->discount = $row[4];
        }

        if ($row[4]==0) {
          $product->onSale = 0;
          $product->discount = 0;
        }

        $product->save();
      }
    }
}
