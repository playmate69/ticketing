<?php

$result = $db->query([
    "sql" => "SELECT user_id FROM users",
    "options" => [
        "return" => true,
        "array" => true
    ]
])->queries(1, true)["result"];

echo json_encode($result);

die();

echo json_encode([
    "edges" => [
        [
            "node" => [
                "title" => "Slagharen",
                "images" => [
                    [
                        "src" => "https://cdn.shopify.com/s/files/1/2772/6034/products/front_1.jpg?v=1606385555"
                    ]
                    ],
                    "price" => "30,00"
            ]
        ],
        [
            "node" => [
                "title" => "Duinrel",
                "images" => [
                    [
                        "src" => "https://cdn.shopify.com/s/files/1/2772/6034/products/native_5.jpg?v=1606385385"
                    ]
                ],
                "price" => "30,00"    
            ]
        ],
        [
            "node" => [
                "title" => "Efteling",
                "images" => [
                    [
                        "src" => "https://cdn.shopify.com/s/files/1/2772/6034/products/native_2.jpg?v=1606385162"
                    ]
                ],
                "price" => "30,00"    
            ]
        ],
        [
            "node" => [
                "title" => "Efteling",
                "images" => [
                    [
                        "src" => "https://cdn.shopify.com/s/files/1/2772/6034/products/native_2.jpg?v=1606385162"
                    ]
                ],
                "price" => "30,00"    
            ]
        ],
        [
            "node" => [
                "title" => "Slagharen",
                "images" => [
                    [
                        "src" => "https://cdn.shopify.com/s/files/1/2772/6034/products/front_1.jpg?v=1606385555"
                    ]
                ],
                "price" => "30,00"    
            ]
        ],
        [
            "node" => [
                "title" => "Duinrel",
                "images" => [
                    [
                        "src" => "https://cdn.shopify.com/s/files/1/2772/6034/products/native_5.jpg?v=1606385385"
                    ]
                ],
                "price" => "30,00"    
            ]
        ],
        [
            "node" => [
                "title" => "Efteling",
                "images" => [
                    [
                        "src" => "https://cdn.shopify.com/s/files/1/2772/6034/products/native_2.jpg?v=1606385162"
                    ]
                ],
                "price" => "30,00"    
            ]
        ],
        [
            "node" => [
                "title" => "Efteling",
                "images" => [
                    [
                        "src" => "https://cdn.shopify.com/s/files/1/2772/6034/products/native_2.jpg?v=1606385162"
                    ]
                ],
                "price" => "30,00"    
            ]
        ]
    ]
]);