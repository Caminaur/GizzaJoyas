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
        $product->name = $row[1];
        $product->price = $row[2];
        if ($row[4]!='') {
          $product->onSale = true;
          $product->discount = $row[4];
        }
        $product->save();
      }
    }
}
