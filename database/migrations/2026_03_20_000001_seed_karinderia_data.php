<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Ingredient;

/**
 * Seeds realistic Filipino karinderia menu data:
 * - Ingredients (raw materials with cost per unit)
 * - Products (meals, snacks, drinks with student-friendly pricing)
 * - Batch sizes (1 batch = typical serving count)
 * - Recipes (which ingredients and how much per batch)
 *
 * Idempotent: only inserts if table is empty.
 */
return new class extends Migration
{
    public function up(): void
    {
        // ---------------------------------------------------------
        // 1. INGREDIENTS
        // ---------------------------------------------------------
        if (Ingredient::count() === 0) {
            $ingredients = [
                // MEATS
                ['name' => 'Pork Belly',        'category' => 'meat',        'unit' => 'kg',  'cost_per_unit' => 280.00, 'stock' => 10.00, 'threshold' => 2.00],
                ['name' => 'Ground Pork',        'category' => 'meat',        'unit' => 'kg',  'cost_per_unit' => 220.00, 'stock' => 8.00,  'threshold' => 2.00],
                ['name' => 'Chicken Thigh',      'category' => 'meat',        'unit' => 'kg',  'cost_per_unit' => 200.00, 'stock' => 10.00, 'threshold' => 2.00],
                ['name' => 'Chicken Liver',      'category' => 'meat',        'unit' => 'kg',  'cost_per_unit' => 100.00, 'stock' => 5.00,  'threshold' => 1.00],
                ['name' => 'Beef Short Ribs',    'category' => 'meat',        'unit' => 'kg',  'cost_per_unit' => 380.00, 'stock' => 5.00,  'threshold' => 1.00],
                ['name' => 'Pork Intestine',     'category' => 'meat',        'unit' => 'kg',  'cost_per_unit' => 150.00, 'stock' => 4.00,  'threshold' => 1.00],
                ['name' => 'Bangus (Milkfish)',  'category' => 'meat',        'unit' => 'kg',  'cost_per_unit' => 180.00, 'stock' => 6.00,  'threshold' => 1.00],
                ['name' => 'Tilapia',            'category' => 'meat',        'unit' => 'kg',  'cost_per_unit' => 130.00, 'stock' => 6.00,  'threshold' => 1.00],
                ['name' => 'Shrimp',             'category' => 'meat',        'unit' => 'kg',  'cost_per_unit' => 300.00, 'stock' => 4.00,  'threshold' => 1.00],
                ['name' => 'Hotdog',             'category' => 'meat',        'unit' => 'pcs', 'cost_per_unit' => 12.00,  'stock' => 50.00, 'threshold' => 10.00],
                ['name' => 'Spam / Luncheon Meat', 'category' => 'canned_goods', 'unit' => 'g', 'cost_per_unit' => 0.08, 'stock' => 2000.00, 'threshold' => 200.00],

                // PRODUCE
                ['name' => 'Garlic',             'category' => 'produce',     'unit' => 'g',   'cost_per_unit' => 0.08,  'stock' => 1000.00, 'threshold' => 100.00],
                ['name' => 'Onion',              'category' => 'produce',     'unit' => 'g',   'cost_per_unit' => 0.06,  'stock' => 1000.00, 'threshold' => 100.00],
                ['name' => 'Tomato',             'category' => 'produce',     'unit' => 'g',   'cost_per_unit' => 0.05,  'stock' => 1000.00, 'threshold' => 100.00],
                ['name' => 'Potato',             'category' => 'produce',     'unit' => 'kg',  'cost_per_unit' => 80.00, 'stock' => 5.00,   'threshold' => 1.00],
                ['name' => 'Pechay (Bok Choy)',  'category' => 'produce',     'unit' => 'g',   'cost_per_unit' => 0.04,  'stock' => 1000.00, 'threshold' => 100.00],
                ['name' => 'Kangkong',           'category' => 'produce',     'unit' => 'g',   'cost_per_unit' => 0.03,  'stock' => 1000.00, 'threshold' => 100.00],
                ['name' => 'Sitaw (String Beans)', 'category' => 'produce',   'unit' => 'g',   'cost_per_unit' => 0.04,  'stock' => 500.00, 'threshold' => 100.00],
                ['name' => 'Eggplant',           'category' => 'produce',     'unit' => 'g',   'cost_per_unit' => 0.04,  'stock' => 1000.00, 'threshold' => 100.00],
                ['name' => 'Ampalaya (Bitter Gourd)', 'category' => 'produce', 'unit' => 'g',  'cost_per_unit' => 0.05,  'stock' => 500.00, 'threshold' => 100.00],
                ['name' => 'Sayote (Chayote)',   'category' => 'produce',     'unit' => 'g',   'cost_per_unit' => 0.03,  'stock' => 1000.00, 'threshold' => 100.00],
                ['name' => 'Banana Blossom',     'category' => 'produce',     'unit' => 'g',   'cost_per_unit' => 0.04,  'stock' => 500.00, 'threshold' => 100.00],
                ['name' => 'Spring Onion',       'category' => 'herbs',       'unit' => 'g',   'cost_per_unit' => 0.05,  'stock' => 300.00, 'threshold' => 50.00],

                // GRAINS
                ['name' => 'White Rice',         'category' => 'grains',      'unit' => 'kg',  'cost_per_unit' => 52.00, 'stock' => 25.00,  'threshold' => 5.00],
                ['name' => 'Vermicelli (Bihon)', 'category' => 'grains',      'unit' => 'g',   'cost_per_unit' => 0.09,  'stock' => 2000.00, 'threshold' => 200.00],
                ['name' => 'Canton Noodles',     'category' => 'grains',      'unit' => 'g',   'cost_per_unit' => 0.09,  'stock' => 2000.00, 'threshold' => 200.00],
                ['name' => 'Bread Crumbs',       'category' => 'grains',      'unit' => 'g',   'cost_per_unit' => 0.07,  'stock' => 500.00, 'threshold' => 100.00],
                ['name' => 'All-Purpose Flour',  'category' => 'baking',      'unit' => 'g',   'cost_per_unit' => 0.05,  'stock' => 2000.00, 'threshold' => 200.00],

                // DAIRY & EGGS
                ['name' => 'Egg',                'category' => 'dairy',       'unit' => 'pcs', 'cost_per_unit' => 8.00,  'stock' => 100.00, 'threshold' => 12.00],
                ['name' => 'Evaporated Milk',    'category' => 'dairy',       'unit' => 'ml',  'cost_per_unit' => 0.07,  'stock' => 1000.00, 'threshold' => 200.00],

                // CANNED GOODS
                ['name' => 'Tomato Sauce (canned)', 'category' => 'canned_goods', 'unit' => 'ml', 'cost_per_unit' => 0.05, 'stock' => 2000.00, 'threshold' => 200.00],
                ['name' => 'Coconut Milk (canned)', 'category' => 'canned_goods', 'unit' => 'ml', 'cost_per_unit' => 0.06, 'stock' => 2000.00, 'threshold' => 200.00],
                ['name' => 'Sardines (canned)',  'category' => 'canned_goods', 'unit' => 'g',  'cost_per_unit' => 0.06,  'stock' => 2000.00, 'threshold' => 200.00],

                // OILS & LIQUIDS
                ['name' => 'Cooking Oil',        'category' => 'oils',        'unit' => 'ml',  'cost_per_unit' => 0.07,  'stock' => 5000.00, 'threshold' => 500.00],
                ['name' => 'Water',              'category' => 'liquids',     'unit' => 'ml',  'cost_per_unit' => 0.00,  'stock' => 10000.00, 'threshold' => 1000.00],

                // CONDIMENTS & SPICES
                ['name' => 'Soy Sauce',          'category' => 'condiments',  'unit' => 'ml',  'cost_per_unit' => 0.04,  'stock' => 2000.00, 'threshold' => 200.00],
                ['name' => 'Fish Sauce (Patis)', 'category' => 'condiments',  'unit' => 'ml',  'cost_per_unit' => 0.04,  'stock' => 1000.00, 'threshold' => 100.00],
                ['name' => 'Vinegar',            'category' => 'acids',       'unit' => 'ml',  'cost_per_unit' => 0.02,  'stock' => 2000.00, 'threshold' => 200.00],
                ['name' => 'Black Pepper (ground)', 'category' => 'spices',   'unit' => 'g',   'cost_per_unit' => 0.30,  'stock' => 300.00, 'threshold' => 50.00],
                ['name' => 'Bay Leaves',         'category' => 'herbs',       'unit' => 'pcs', 'cost_per_unit' => 1.50,  'stock' => 50.00,  'threshold' => 5.00],
                ['name' => 'Salt',               'category' => 'spices',      'unit' => 'g',   'cost_per_unit' => 0.01,  'stock' => 2000.00, 'threshold' => 200.00],
                ['name' => 'Sugar',              'category' => 'sweeteners',  'unit' => 'g',   'cost_per_unit' => 0.05,  'stock' => 2000.00, 'threshold' => 200.00],
                ['name' => 'Oyster Sauce',       'category' => 'condiments',  'unit' => 'ml',  'cost_per_unit' => 0.09,  'stock' => 500.00, 'threshold' => 100.00],
                ['name' => 'Banana Ketchup',     'category' => 'condiments',  'unit' => 'ml',  'cost_per_unit' => 0.05,  'stock' => 500.00, 'threshold' => 100.00],
                ['name' => 'Annatto (Atsuete)',  'category' => 'spices',      'unit' => 'g',   'cost_per_unit' => 0.15,  'stock' => 200.00, 'threshold' => 30.00],
                ['name' => 'Paprika',            'category' => 'spices',      'unit' => 'g',   'cost_per_unit' => 0.20,  'stock' => 200.00, 'threshold' => 30.00],

                // DRINKS
                ['name' => 'Instant Coffee (3-in-1)', 'category' => 'others', 'unit' => 'g',  'cost_per_unit' => 0.30,  'stock' => 1000.00, 'threshold' => 100.00],
                ['name' => 'Powdered Juice (Pineapple)', 'category' => 'sweeteners', 'unit' => 'g', 'cost_per_unit' => 0.25, 'stock' => 500.00, 'threshold' => 100.00],
                ['name' => 'Chocolate Powder (Milo)', 'category' => 'sweeteners', 'unit' => 'g', 'cost_per_unit' => 0.40, 'stock' => 500.00, 'threshold' => 100.00],
                ['name' => 'Calamansi',          'category' => 'produce',     'unit' => 'pcs', 'cost_per_unit' => 1.00,  'stock' => 100.00, 'threshold' => 20.00],
            ];

            foreach ($ingredients as $data) {
                if (!\App\Models\Ingredient::where('name', $data['name'])->exists()) {
                    \App\Models\Ingredient::create($data);
                }
            }
        }

        // ---------------------------------------------------------
        // 2. PRODUCTS (meals, snacks, drinks)
        // ---------------------------------------------------------
        if (Product::count() === 0) {
            $products = [
                // MEALS
                ['name' => 'Adobong Manok',         'category' => 'meals',     'price' => 55.00,  'image' => null, 'stock' => 0],
                ['name' => 'Sinigang na Baboy',     'category' => 'meals',     'price' => 65.00,  'image' => null, 'stock' => 0],
                ['name' => 'Pinakbet',               'category' => 'meals',     'price' => 45.00,  'image' => null, 'stock' => 0],
                ['name' => 'Tinolang Manok',         'category' => 'meals',     'price' => 55.00,  'image' => null, 'stock' => 0],
                ['name' => 'Pork Menudo',            'category' => 'meals',     'price' => 60.00,  'image' => null, 'stock' => 0],
                ['name' => 'Bicol Express',          'category' => 'meals',     'price' => 60.00,  'image' => null, 'stock' => 0],
                ['name' => 'Dinuguan',               'category' => 'meals',     'price' => 50.00,  'image' => null, 'stock' => 0],
                ['name' => 'Paksiw na Bangus',       'category' => 'meals',     'price' => 50.00,  'image' => null, 'stock' => 0],
                ['name' => 'Beef Kaldereta',         'category' => 'meals',     'price' => 75.00,  'image' => null, 'stock' => 0],
                ['name' => 'Tortang Talong',         'category' => 'meals',     'price' => 35.00,  'image' => null, 'stock' => 0],
                ['name' => 'Pork Adobo',             'category' => 'meals',     'price' => 55.00,  'image' => null, 'stock' => 0],
                ['name' => 'Laing',                  'category' => 'meals',     'price' => 45.00,  'image' => null, 'stock' => 0],

                // SNACKS
                ['name' => 'Pansit Bihon',           'category' => 'snacks',    'price' => 40.00,  'image' => null, 'stock' => 0],
                ['name' => 'Pansit Canton',          'category' => 'snacks',    'price' => 40.00,  'image' => null, 'stock' => 0],
                ['name' => 'Lumpia Shanghai',        'category' => 'snacks',    'price' => 35.00,  'image' => null, 'stock' => 0],
                ['name' => 'Tokwa\'t Baboy',         'category' => 'snacks',    'price' => 40.00,  'image' => null, 'stock' => 0],
                ['name' => 'Hotdog & Egg',           'category' => 'snacks',    'price' => 35.00,  'image' => null, 'stock' => 0],
                ['name' => 'Fried Tilapia',          'category' => 'snacks',    'price' => 45.00,  'image' => null, 'stock' => 0],

                // DRINKS
                ['name' => 'Kapeng Barako (Hot)',    'category' => 'drinks',    'price' => 20.00,  'image' => null, 'stock' => 0],
                ['name' => 'Nestea / Pineapple Juice', 'category' => 'drinks', 'price' => 15.00,  'image' => null, 'stock' => 0],
                ['name' => 'Milo (Hot)',             'category' => 'drinks',    'price' => 20.00,  'image' => null, 'stock' => 0],
                ['name' => 'Calamansi Juice',        'category' => 'drinks',    'price' => 15.00,  'image' => null, 'stock' => 0],

                // READY MADE
                ['name' => 'Puto',                   'category' => 'ready_made', 'price' => 10.00, 'image' => null, 'stock' => 0],
                ['name' => 'Kutsinta',               'category' => 'ready_made', 'price' => 10.00, 'image' => null, 'stock' => 0],
            ];

            foreach ($products as $data) {
                if (!Product::where('name', $data['name'])->exists()) {
                    Product::create($data);
                }
            }
        }

        // ---------------------------------------------------------
        // 3. BATCH SIZES & RECIPES
        // Only seed if completely empty
        // ---------------------------------------------------------
        if (DB::table('batch_sizes')->count() === 0) {

            // Helper to get IDs by name
            $getProduct = fn($name) => Product::where('name', $name)->value('id');
            $getIngredient = fn($name) => \App\Models\Ingredient::where('name', $name)->value('id');

            /**
             * Each entry:
             *   product    => name of the product
             *   servings   => how many servings this batch makes
             *   ingredients => [ [name, quantity_in_unit] ... ]
             *                  Quantities are per batch (e.g., 1kg chicken for 5 servings)
             */
            $menu = [
                [
                    'product'  => 'Adobong Manok',
                    'servings' => 5,
                    'ingredients' => [
                        ['Chicken Thigh', 1.00],    // 1 kg
                        ['Garlic', 30.00],           // 30g
                        ['Onion', 50.00],            // 50g
                        ['Soy Sauce', 60.00],        // 60ml
                        ['Vinegar', 60.00],          // 60ml
                        ['Bay Leaves', 3.00],        // 3 pcs
                        ['Black Pepper (ground)', 3.00],
                        ['Cooking Oil', 30.00],
                        ['Salt', 5.00],
                    ],
                ],
                [
                    'product'  => 'Pork Adobo',
                    'servings' => 5,
                    'ingredients' => [
                        ['Pork Belly', 1.00],
                        ['Garlic', 30.00],
                        ['Soy Sauce', 60.00],
                        ['Vinegar', 60.00],
                        ['Bay Leaves', 3.00],
                        ['Black Pepper (ground)', 3.00],
                        ['Cooking Oil', 30.00],
                        ['Sugar', 10.00],
                    ],
                ],
                [
                    'product'  => 'Sinigang na Baboy',
                    'servings' => 6,
                    'ingredients' => [
                        ['Pork Belly', 1.00],
                        ['Tomato', 150.00],
                        ['Onion', 80.00],
                        ['Kangkong', 200.00],
                        ['Sitaw (String Beans)', 100.00],
                        ['Eggplant', 150.00],
                        ['Fish Sauce (Patis)', 30.00],
                        ['Water', 2000.00],
                        ['Salt', 5.00],
                    ],
                ],
                [
                    'product'  => 'Pinakbet',
                    'servings' => 5,
                    'ingredients' => [
                        ['Pork Belly', 0.30],
                        ['Tomato', 100.00],
                        ['Onion', 50.00],
                        ['Garlic', 20.00],
                        ['Ampalaya (Bitter Gourd)', 150.00],
                        ['Eggplant', 150.00],
                        ['Sitaw (String Beans)', 100.00],
                        ['Sayote (Chayote)', 100.00],
                        ['Fish Sauce (Patis)', 30.00],
                        ['Cooking Oil', 30.00],
                    ],
                ],
                [
                    'product'  => 'Tinolang Manok',
                    'servings' => 5,
                    'ingredients' => [
                        ['Chicken Thigh', 1.00],
                        ['Garlic', 20.00],
                        ['Onion', 50.00],
                        ['Sayote (Chayote)', 200.00],
                        ['Pechay (Bok Choy)', 100.00],
                        ['Fish Sauce (Patis)', 30.00],
                        ['Water', 1500.00],
                        ['Cooking Oil', 20.00],
                    ],
                ],
                [
                    'product'  => 'Pork Menudo',
                    'servings' => 5,
                    'ingredients' => [
                        ['Pork Belly', 0.50],
                        ['Chicken Liver', 0.20],
                        ['Potato', 0.30],
                        ['Tomato Sauce (canned)', 200.00],
                        ['Garlic', 20.00],
                        ['Onion', 50.00],
                        ['Soy Sauce', 30.00],
                        ['Salt', 5.00],
                        ['Black Pepper (ground)', 2.00],
                        ['Cooking Oil', 30.00],
                    ],
                ],
                [
                    'product'  => 'Bicol Express',
                    'servings' => 5,
                    'ingredients' => [
                        ['Pork Belly', 0.50],
                        ['Coconut Milk (canned)', 400.00],
                        ['Garlic', 20.00],
                        ['Onion', 50.00],
                        ['Fish Sauce (Patis)', 20.00],
                        ['Salt', 5.00],
                        ['Cooking Oil', 30.00],
                    ],
                ],
                [
                    'product'  => 'Dinuguan',
                    'servings' => 5,
                    'ingredients' => [
                        ['Pork Intestine', 0.50],
                        ['Pork Belly', 0.30],
                        ['Garlic', 20.00],
                        ['Onion', 50.00],
                        ['Vinegar', 60.00],
                        ['Fish Sauce (Patis)', 20.00],
                        ['Black Pepper (ground)', 3.00],
                        ['Cooking Oil', 30.00],
                    ],
                ],
                [
                    'product'  => 'Paksiw na Bangus',
                    'servings' => 4,
                    'ingredients' => [
                        ['Bangus (Milkfish)', 1.00],
                        ['Garlic', 15.00],
                        ['Onion', 50.00],
                        ['Vinegar', 80.00],
                        ['Water', 200.00],
                        ['Fish Sauce (Patis)', 20.00],
                        ['Black Pepper (ground)', 2.00],
                        ['Salt', 5.00],
                    ],
                ],
                [
                    'product'  => 'Beef Kaldereta',
                    'servings' => 5,
                    'ingredients' => [
                        ['Beef Short Ribs', 1.00],
                        ['Tomato Sauce (canned)', 200.00],
                        ['Potato', 0.30],
                        ['Garlic', 20.00],
                        ['Onion', 80.00],
                        ['Soy Sauce', 30.00],
                        ['Annatto (Atsuete)', 5.00],
                        ['Salt', 5.00],
                        ['Black Pepper (ground)', 3.00],
                        ['Cooking Oil', 30.00],
                        ['Water', 500.00],
                    ],
                ],
                [
                    'product'  => 'Tortang Talong',
                    'servings' => 4,
                    'ingredients' => [
                        ['Eggplant', 400.00],
                        ['Egg', 4.00],
                        ['Ground Pork', 0.20],
                        ['Garlic', 10.00],
                        ['Onion', 30.00],
                        ['Fish Sauce (Patis)', 15.00],
                        ['Salt', 3.00],
                        ['Cooking Oil', 50.00],
                    ],
                ],
                [
                    'product'  => 'Laing',
                    'servings' => 5,
                    'ingredients' => [
                        ['Banana Blossom', 300.00],
                        ['Pork Belly', 0.20],
                        ['Coconut Milk (canned)', 400.00],
                        ['Garlic', 15.00],
                        ['Onion', 50.00],
                        ['Shrimp', 0.10],
                        ['Fish Sauce (Patis)', 20.00],
                        ['Salt', 5.00],
                    ],
                ],
                [
                    'product'  => 'Pansit Bihon',
                    'servings' => 8,
                    'ingredients' => [
                        ['Vermicelli (Bihon)', 250.00],
                        ['Chicken Thigh', 0.30],
                        ['Garlic', 15.00],
                        ['Onion', 50.00],
                        ['Pechay (Bok Choy)', 100.00],
                        ['Sitaw (String Beans)', 80.00],
                        ['Carrot', 100.00],
                        ['Soy Sauce', 30.00],
                        ['Oyster Sauce', 30.00],
                        ['Cooking Oil', 30.00],
                        ['Water', 500.00],
                    ],
                ],
                [
                    'product'  => 'Pansit Canton',
                    'servings' => 8,
                    'ingredients' => [
                        ['Canton Noodles', 250.00],
                        ['Chicken Thigh', 0.30],
                        ['Garlic', 15.00],
                        ['Onion', 50.00],
                        ['Pechay (Bok Choy)', 100.00],
                        ['Sitaw (String Beans)', 80.00],
                        ['Soy Sauce', 30.00],
                        ['Oyster Sauce', 30.00],
                        ['Cooking Oil', 30.00],
                        ['Water', 300.00],
                    ],
                ],
                [
                    'product'  => 'Lumpia Shanghai',
                    'servings' => 10,
                    'ingredients' => [
                        ['Ground Pork', 0.50],
                        ['Garlic', 10.00],
                        ['Onion', 50.00],
                        ['Egg', 2.00],
                        ['All-Purpose Flour', 20.00],
                        ['Salt', 3.00],
                        ['Black Pepper (ground)', 2.00],
                        ['Cooking Oil', 100.00],
                        ['Soy Sauce', 15.00],
                    ],
                ],
                [
                    'product'  => 'Tokwa\'t Baboy',
                    'servings' => 4,
                    'ingredients' => [
                        ['Pork Belly', 0.50],
                        ['Vinegar', 60.00],
                        ['Soy Sauce', 60.00],
                        ['Garlic', 15.00],
                        ['Onion', 50.00],
                        ['Spring Onion', 20.00],
                        ['Salt', 3.00],
                        ['Black Pepper (ground)', 2.00],
                    ],
                ],
                [
                    'product'  => 'Hotdog & Egg',
                    'servings' => 2,
                    'ingredients' => [
                        ['Hotdog', 2.00],
                        ['Egg', 2.00],
                        ['Cooking Oil', 30.00],
                        ['Salt', 2.00],
                        ['Banana Ketchup', 20.00],
                    ],
                ],
                [
                    'product'  => 'Fried Tilapia',
                    'servings' => 3,
                    'ingredients' => [
                        ['Tilapia', 1.00],
                        ['Cooking Oil', 100.00],
                        ['Salt', 10.00],
                        ['Vinegar', 30.00],
                        ['Garlic', 10.00],
                    ],
                ],
                [
                    'product'  => 'Kapeng Barako (Hot)',
                    'servings' => 4,
                    'ingredients' => [
                        ['Instant Coffee (3-in-1)', 80.00],
                        ['Water', 1000.00],
                    ],
                ],
                [
                    'product'  => 'Nestea / Pineapple Juice',
                    'servings' => 6,
                    'ingredients' => [
                        ['Powdered Juice (Pineapple)', 50.00],
                        ['Sugar', 20.00],
                        ['Water', 1500.00],
                    ],
                ],
                [
                    'product'  => 'Milo (Hot)',
                    'servings' => 4,
                    'ingredients' => [
                        ['Chocolate Powder (Milo)', 120.00],
                        ['Evaporated Milk', 200.00],
                        ['Water', 800.00],
                    ],
                ],
                [
                    'product'  => 'Calamansi Juice',
                    'servings' => 4,
                    'ingredients' => [
                        ['Calamansi', 10.00],
                        ['Sugar', 30.00],
                        ['Water', 1000.00],
                    ],
                ],
            ];

            foreach ($menu as $item) {
                $productId = $getProduct($item['product']);
                if (!$productId) continue;

                // Create one batch size per product
                $batchSizeId = DB::table('batch_sizes')->insertGetId([
                    'product_id' => $productId,
                    'servings'   => $item['servings'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Create recipe entries
                foreach ($item['ingredients'] as [$ingredientName, $quantity]) {
                    $ingredientId = $getIngredient($ingredientName);
                    if (!$ingredientId) continue;

                    DB::table('recipes')->insert([
                        'product_id'     => $productId,
                        'batch_sizes_id' => $batchSizeId,
                        'ingredient_id'  => $ingredientId,
                        'quantity'       => $quantity,
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        // Clean up in reverse order
        DB::table('recipes')->delete();
        DB::table('batch_sizes')->delete();
        Product::truncate();
        \App\Models\Ingredient::truncate();
    }
};
