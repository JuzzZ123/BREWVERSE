<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Home extends \CodeIgniter\Controller
{
    public function mainDashboard(): string
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->where('status', 'in_stock')
                                       ->orderBy('category', 'ASC')
                                       ->orderBy('product_name', 'ASC')
                                       ->findAll();

        return view('main_dashboard', $data);
    }
    
    public function menu()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->where('status', 'in_stock')
                                       ->orderBy('category', 'ASC')
                                       ->orderBy('product_name', 'ASC')
                                       ->findAll();

        // Group products by category
        $data['productsByCategory'] = [];
        foreach ($data['products'] as $product) {
            $data['productsByCategory'][$product['category']][] = $product;
        }

        return view('menu_view', $data);
    }
}
