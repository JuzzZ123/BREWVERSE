<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Products extends Controller
{
    public function displayImage($id)
    {
        $productModel = new \App\Models\ProductModel();
        $product = $productModel->find($id);
        
        if ($product && $product['image']) {
            // Detect mime type from image content
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($product['image']);
            
            // Set the content type header
            header('Content-Type: ' . $mimeType);
            
            // Output the image data
            echo $product['image'];
            exit;
        }
        
        // If no image found, return a 404
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
} 