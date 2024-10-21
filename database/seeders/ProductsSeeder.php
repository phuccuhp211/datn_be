<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Image;
use App\Models\ProductOption;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Thức ăn cho thú cưng
            [
                'name' => 'Thức ăn cho chó vị gà',
                'description' => 'Thức ăn dinh dưỡng cho chó với hương vị gà.',
                'type' => '1',
                'images' => ['food1_1.webp', 'food1_2.webp'],
                'sizes' => [
                    [
                        'price' => 100000,
                        'discount_price' => 90000,
                        'size' => '500g',
                        'options' => [
                            ['flavor' => 'Gà', 'quantity' => 10],
                            ['flavor' => 'Thịt bò', 'quantity' => 5],
                        ]
                    ],
                    [
                        'price' => 120000,
                        'discount_price' => null,
                        'size' => '1kg',
                        'options' => [
                            ['flavor' => 'Gà', 'quantity' => 8],
                            ['flavor' => 'Cá hồi', 'quantity' => 7],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Thức ăn cho mèo vị cá',
                'description' => 'Thức ăn cho mèo vị cá hồi, bổ dưỡng.',
                'type' => '1',
                'images' => ['food2_1.webp', 'food2_2.webp'],
                'sizes' => [
                    [
                        'price' => 95000,
                        'discount_price' => 85000,
                        'size' => '500g',
                        'options' => [
                            ['flavor' => 'Cá hồi', 'quantity' => 12],
                            ['flavor' => 'Cá ngừ', 'quantity' => 10],
                        ]
                    ],
                    [
                        'price' => 120000,
                        'discount_price' => null,
                        'size' => '1kg',
                        'options' => [
                            ['flavor' => 'Cá hồi', 'quantity' => 9],
                        ]
                    ],
                ]
            ],
            // Các sản phẩm khác
            [
                'name' => 'Áo thun đỏ cho chó',
                'description' => 'Áo thun thời trang màu đỏ cho thú cưng.',
                'type' => '2',
                'images' => ['clothes1_1.jpg', 'clothes1_2.jpg'],
                'sizes' => [
                    [
                        'price' => 110000,
                        'discount_price' => 100000,
                        'size' => 'M',
                        'options' => [
                            ['color' => 'Đỏ', 'quantity' => 8],
                            ['color' => 'Vàng', 'quantity' => 6],
                        ]
                    ],
                    [
                        'price' => 130000,
                        'discount_price' => null,
                        'size' => 'L',
                        'options' => [
                            ['color' => 'Xanh', 'quantity' => 4],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Áo thun xanh cho mèo',
                'description' => 'Áo thun màu xanh cho mèo.',
                'type' => '2',
                'images' => ['clothes2_1.jpg', 'clothes2_2.jpg'],
                'sizes' => [
                    [
                        'price' => 105000,
                        'discount_price' => 95000,
                        'size' => 'S',
                        'options' => [
                            ['color' => 'Xanh', 'quantity' => 6],
                        ]
                    ],
                    [
                        'price' => 120000,
                        'discount_price' => null,
                        'size' => 'M',
                        'options' => [
                            ['color' => 'Đen', 'quantity' => 3],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Lược chải lông chó mèo',
                'description' => 'Dụng cụ chăm sóc lông cho thú cưng, dễ sử dụng.',
                'type' => '3',
                'images' => ['tool1_1.webp', 'tool1_2.webp'],
                'sizes' => [
                    [
                        'price' => 50000,
                        'discount_price' => 45000,
                        'size' => 'S',
                        'options' => [
                            ['color' => 'Hồng', 'quantity' => 20],
                        ]
                    ],
                    [
                        'price' => 60000,
                        'discount_price' => null,
                        'size' => 'M',
                        'options' => [
                            ['color' => 'Xám', 'quantity' => 15],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Bát ăn cho chó mèo',
                'description' => 'Bát ăn bằng nhựa cao cấp cho chó mèo.',
                'type' => '3',
                'images' => ['tool2_1.webp', 'tool2_2.webp'],
                'sizes' => [
                    [
                        'price' => 35000,
                        'discount_price' => 30000,
                        'size' => 'M',
                        'options' => [
                            ['color' => 'Trắng', 'quantity' => 15],
                        ]
                    ],
                    [
                        'price' => 40000,
                        'discount_price' => null,
                        'size' => 'L',
                        'options' => [
                            ['color' => 'Đen', 'quantity' => 10],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Bóng cao su cho chó',
                'description' => 'Đồ chơi bóng cao su cho chó, bền bỉ và an toàn.',
                'type' => '4',
                'images' => ['toy1_1.webp', 'toy1_2.webp'],
                'sizes' => [
                    [
                        'price' => 60000,
                        'discount_price' => null,
                        'size' => 'M',
                        'options' => [
                            ['color' => 'Vàng', 'quantity' => 15],
                        ]
                    ],
                    [
                        'price' => 70000,
                        'discount_price' => 65000,
                        'size' => 'L',
                        'options' => [
                            ['color' => 'Xanh', 'quantity' => 10],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Đồ chơi chuột cho mèo',
                'description' => 'Đồ chơi chuột bông nhỏ gọn cho mèo.',
                'type' => '4',
                'images' => ['toy2_1.jpg', 'toy2_2.jpg'],
                'sizes' => [
                    [
                        'price' => 45000,
                        'discount_price' => 40000,
                        'size' => 'S',
                        'options' => [
                            ['color' => 'Xám', 'quantity' => 12],
                        ]
                    ],
                    [
                        'price' => 50000,
                        'discount_price' => null,
                        'size' => 'M',
                        'options' => [
                            ['color' => 'Trắng', 'quantity' => 8],
                        ]
                    ],
                ]
            ],
        ];

        foreach ($products as $productData) {
            $product = Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'type' => $productData['type'],
            ]);

            foreach ($productData['images'] as $imageUrl) {
                Image::create([
                    'reference_id' => $product->id,
                    'table' => 'products',
                    'url' => $imageUrl,
                ]);
            }
            foreach ($productData['sizes'] as $sizeData) {
                $size = ProductSize::create([
                    'product_id' => $product->id,
                    'price' => $sizeData['price'],
                    'discount_price' => $sizeData['discount_price'],
                    'size' => $sizeData['size'],
                ]);

                foreach ($sizeData['options'] as $optionData) {
                    ProductOption::create([
                        'size_id' => $size->id,
                        'flavor' => $productData['type'] == 1 ? $optionData['flavor'] : null,
                        'color' => $productData['type'] != 1 ? $optionData['color'] : null,
                        'quantity' => $optionData['quantity'],
                    ]);
                }
            }
        }
    }
}
