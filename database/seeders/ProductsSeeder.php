<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
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
                'type' => 'food',
                'images' => json_encode(['food1_1.webp', 'food1_2.webp']),
                'variants' => [
                    [
                        'price' => 100000,
                        'discount_price' => 90000,
                        'size' => '500g',
                        'options' => [
                            ['flavor' => 'Gà', 'color' => 'Vàng', 'quantity' => 10],
                            ['flavor' => 'Thịt bò', 'color' => 'Đỏ', 'quantity' => 5],
                        ]
                    ],
                    [
                        'price' => 120000,
                        'discount_price' => null,
                        'size' => '1kg',
                        'options' => [
                            ['flavor' => 'Gà', 'color' => 'Vàng', 'quantity' => 8],
                            ['flavor' => 'Thịt bò', 'color' => 'Xanh', 'quantity' => 6],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Thức ăn cho mèo vị cá',
                'description' => 'Thức ăn cho mèo vị cá hồi, bổ dưỡng.',
                'type' => 'food',
                'images' => json_encode(['food2_1.webp', 'food2_2.webp']),
                'variants' => [
                    [
                        'price' => 95000,
                        'discount_price' => 85000,
                        'size' => '500g',
                        'options' => [
                            ['flavor' => 'Cá', 'color' => 'Xanh', 'quantity' => 12],
                            ['flavor' => 'Tôm', 'color' => 'Cam', 'quantity' => 7],
                        ]
                    ]
                ]
            ],
            // Tiếp tục thêm 3 sản phẩm thức ăn cho thú cưng...

            // Áo thun cho thú cưng
            [
                'name' => 'Áo thun đỏ cho chó',
                'description' => 'Áo thun thời trang màu đỏ cho thú cưng.',
                'type' => 'clothing',
                'images' => json_encode(['clothes1_1.jpg', 'clothes1_2.jpg']),
                'variants' => [
                    [
                        'price' => 110000,
                        'discount_price' => 100000,
                        'size' => 'M',
                        'options' => [
                            ['color' => 'Đỏ', 'quantity' => 8],
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
                'type' => 'clothing',
                'images' => json_encode(['clothes2_1.jpg', 'clothes2_2.jpg']),
                'variants' => [
                    [
                        'price' => 105000,
                        'discount_price' => 95000,
                        'size' => 'S',
                        'options' => [
                            ['color' => 'Xanh', 'quantity' => 6],
                        ]
                    ]
                ]
            ],
            // Tiếp tục thêm 3 sản phẩm quần áo cho thú cưng...

            // Dụng cụ cho thú cưng
            [
                'name' => 'Lược chải lông chó mèo',
                'description' => 'Dụng cụ chăm sóc lông cho thú cưng, dễ sử dụng.',
                'type' => 'tool',
                'images' => json_encode(['tool1_1.webp', 'tool1_2.webp']),
                'variants' => [
                    [
                        'price' => 50000,
                        'discount_price' => 45000,
                        'size' => 'S',
                        'options' => [
                            ['color' => 'Hồng', 'quantity' => 20],
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Bát ăn cho chó mèo',
                'description' => 'Bát ăn bằng nhựa cao cấp cho chó mèo.',
                'type' => 'tool',
                'images' => json_encode(['tool2_1.webp', 'tool2_2.webp']),
                'variants' => [
                    [
                        'price' => 35000,
                        'discount_price' => 30000,
                        'size' => 'M',
                        'options' => [
                            ['color' => 'Trắng', 'quantity' => 15],
                        ]
                    ]
                ]
            ],
            // Tiếp tục thêm 3 sản phẩm dụng cụ cho thú cưng...

            // Đồ chơi cho thú cưng
            [
                'name' => 'Bóng cao su cho chó',
                'description' => 'Đồ chơi bóng cao su cho chó, bền bỉ và an toàn.',
                'type' => 'toy',
                'images' => json_encode(['toy1_1.webp', 'toy1_2.webp']),
                'variants' => [
                    [
                        'price' => 60000,
                        'discount_price' => null,
                        'size' => 'M',
                        'options' => [
                            ['color' => 'Vàng', 'quantity' => 15],
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Đồ chơi chuột cho mèo',
                'description' => 'Đồ chơi chuột bông nhỏ gọn cho mèo.',
                'type' => 'toy',
                'images' => json_encode(['toy2_1.jpg', 'toy2_2.jpg']),
                'variants' => [
                    [
                        'price' => 45000,
                        'discount_price' => 40000,
                        'size' => 'S',
                        'options' => [
                            ['color' => 'Xám', 'quantity' => 12],
                        ]
                    ]
                ]
            ],
            // Tiếp tục thêm 3 sản phẩm đồ chơi cho thú cưng...
        ];

        foreach ($products as $productData) {
            $product = Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'type' => $productData['type'],
                'images' => $productData['images'],
            ]);

            foreach ($productData['variants'] as $variantData) {
                $variant = ProductVariant::create([
                    'product_id' => $product->id,
                    'price' => $variantData['price'],
                    'discount_price' => $variantData['discount_price'],
                    'size' => $variantData['size'],
                ]);

                foreach ($variantData['options'] as $optionData) {
                    ProductOption::create([
                        'variant_id' => $variant->id,
                        'flavor' => $optionData['flavor'] ?? null,
                        'color' => $optionData['color'],
                        'quantity' => $optionData['quantity'],
                    ]);
                }
            }
        }
    }
}