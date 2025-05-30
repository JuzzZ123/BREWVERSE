<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database;



class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'product_name',
        'description',
        'price',
        'category',
        'image',
        'rating',
        'status'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'product_name' => 'required|min_length[3]|max_length[255]',
        'price' => 'required|numeric|greater_than[0]',
        'category' => 'required|in_list[Hot Coffee,Iced Coffee,Pastries,Desserts]',
        'image' => 'permit_empty|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,2048]',
        'rating' => 'permit_empty|numeric|greater_than_equal_to[0]|less_than_equal_to[5]',
        'status' => 'required|in_list[in_stock,out_of_stock]'
    ];

    protected $validationMessages = [
        'product_name' => [
            'required' => 'Product name is required',
            'min_length' => 'Product name must be at least 3 characters long',
            'max_length' => 'Product name cannot exceed 255 characters'
        ],
        'price' => [
            'required' => 'Price is required',
            'numeric' => 'Price must be a number',
            'greater_than' => 'Price must be greater than 0'
        ],
        'category' => [
            'required' => 'Category is required',
            'in_list' => 'Please select a valid category'
        ],
        'image' => [
            'is_image' => 'The uploaded file must be an image',
            'mime_in' => 'The image must be in JPG, JPEG, or PNG format',
            'max_size' => 'The image size cannot exceed 2MB'
        ],
        'rating' => [
            'numeric' => 'Rating must be a number',
            'greater_than_equal_to' => 'Rating must be between 0 and 5',
            'less_than_equal_to' => 'Rating must be between 0 and 5'
        ],
        'status' => [
            'required' => 'Status is required',
            'in_list' => 'Status must be either in stock or out of stock'
        ]
    ];
}
