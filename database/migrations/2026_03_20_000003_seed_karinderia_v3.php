<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * V3: Direct karinderia data seed.
 * Uses name-based inserts (safe even with existing data).
 * Raw DB::table() only — no Eloquent models.
 */
return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        // ── 1. INGREDIENTS ─────────────────────────────────────────
        $ingredients = [
            ['name' => 'Pork Belly',               'category' => 'meat',         'unit' => 'kg',  'cost_per_unit' => 280.00, 'stock' => 10.00,    'threshold' => 2.00],
            ['name' => 'Ground Pork',              'category' => 'meat',         'unit' => 'kg',  'cost_per_unit' => 220.00, 'stock' => 8.00,     'threshold' => 2.00],
            ['name' => 'Chicken Thigh',            'category' => 'meat',         'unit' => 'kg',  'cost_per_unit' => 200.00, 'stock' => 10.00,    'threshold' => 2.00],
            ['name' => 'Chicken Liver',            'category' => 'meat',         'unit' => 'kg',  'cost_per_unit' => 100.00, 'stock' => 5.00,     'threshold' => 1.00],
            ['name' => 'Beef Short Ribs',          'category' => 'meat',         'unit' => 'kg',  'cost_per_unit' => 380.00, 'stock' => 5.00,     'threshold' => 1.00],
            ['name' => 'Pork Intestine',           'category' => 'meat',         'unit' => 'kg',  'cost_per_unit' => 150.00, 'stock' => 4.00,     'threshold' => 1.00],
            ['name' => 'Bangus (Milkfish)',        'category' => 'meat',         'unit' => 'kg',  'cost_per_unit' => 180.00, 'stock' => 6.00,     'threshold' => 1.00],
            ['name' => 'Tilapia',                  'category' => 'meat',         'unit' => 'kg',  'cost_per_unit' => 130.00, 'stock' => 6.00,     'threshold' => 1.00],
            ['name' => 'Shrimp',                   'category' => 'meat',         'unit' => 'kg',  'cost_per_unit' => 300.00, 'stock' => 4.00,     'threshold' => 1.00],
            ['name' => 'Hotdog',                   'category' => 'meat',         'unit' => 'pcs', 'cost_per_unit' => 12.00,  'stock' => 50.00,    'threshold' => 10.00],
            ['name' => 'Garlic',                   'category' => 'produce',      'unit' => 'g',   'cost_per_unit' => 0.08,   'stock' => 1000.00,  'threshold' => 100.00],
            ['name' => 'Onion',                    'category' => 'produce',      'unit' => 'g',   'cost_per_unit' => 0.06,   'stock' => 1000.00,  'threshold' => 100.00],
            ['name' => 'Tomato',                   'category' => 'produce',      'unit' => 'g',   'cost_per_unit' => 0.05,   'stock' => 1000.00,  'threshold' => 100.00],
            ['name' => 'Potato',                   'category' => 'produce',      'unit' => 'kg',  'cost_per_unit' => 80.00,  'stock' => 5.00,     'threshold' => 1.00],
            ['name' => 'Carrot',                   'category' => 'produce',      'unit' => 'g',   'cost_per_unit' => 0.05,   'stock' => 1000.00,  'threshold' => 100.00],
            ['name' => 'Pechay (Bok Choy)',        'category' => 'produce',      'unit' => 'g',   'cost_per_unit' => 0.04,   'stock' => 1000.00,  'threshold' => 100.00],
            ['name' => 'Kangkong',                 'category' => 'produce',      'unit' => 'g',   'cost_per_unit' => 0.03,   'stock' => 1000.00,  'threshold' => 100.00],
            ['name' => 'Sitaw (String Beans)',     'category' => 'produce',      'unit' => 'g',   'cost_per_unit' => 0.04,   'stock' => 500.00,   'threshold' => 100.00],
            ['name' => 'Eggplant',                 'category' => 'produce',      'unit' => 'g',   'cost_per_unit' => 0.04,   'stock' => 1000.00,  'threshold' => 100.00],
            ['name' => 'Ampalaya (Bitter Gourd)',  'category' => 'produce',      'unit' => 'g',   'cost_per_unit' => 0.05,   'stock' => 500.00,   'threshold' => 100.00],
            ['name' => 'Sayote (Chayote)',         'category' => 'produce',      'unit' => 'g',   'cost_per_unit' => 0.03,   'stock' => 1000.00,  'threshold' => 100.00],
            ['name' => 'Banana Blossom',           'category' => 'produce',      'unit' => 'g',   'cost_per_unit' => 0.04,   'stock' => 500.00,   'threshold' => 100.00],
            ['name' => 'Spring Onion',             'category' => 'herbs',        'unit' => 'g',   'cost_per_unit' => 0.05,   'stock' => 300.00,   'threshold' => 50.00],
            ['name' => 'Calamansi',                'category' => 'produce',      'unit' => 'pcs', 'cost_per_unit' => 1.00,   'stock' => 100.00,   'threshold' => 20.00],
            ['name' => 'White Rice',               'category' => 'grains',       'unit' => 'kg',  'cost_per_unit' => 52.00,  'stock' => 25.00,    'threshold' => 5.00],
            ['name' => 'Vermicelli (Bihon)',       'category' => 'grains',       'unit' => 'g',   'cost_per_unit' => 0.09,   'stock' => 2000.00,  'threshold' => 200.00],
            ['name' => 'Canton Noodles',           'category' => 'grains',       'unit' => 'g',   'cost_per_unit' => 0.09,   'stock' => 2000.00,  'threshold' => 200.00],
            ['name' => 'All-Purpose Flour',        'category' => 'baking',       'unit' => 'g',   'cost_per_unit' => 0.05,   'stock' => 2000.00,  'threshold' => 200.00],
            ['name' => 'Egg',                      'category' => 'dairy',        'unit' => 'pcs', 'cost_per_unit' => 8.00,   'stock' => 100.00,   'threshold' => 12.00],
            ['name' => 'Evaporated Milk',          'category' => 'dairy',        'unit' => 'ml',  'cost_per_unit' => 0.07,   'stock' => 1000.00,  'threshold' => 200.00],
            ['name' => 'Tomato Sauce (canned)',    'category' => 'canned_goods', 'unit' => 'ml',  'cost_per_unit' => 0.05,   'stock' => 2000.00,  'threshold' => 200.00],
            ['name' => 'Coconut Milk (canned)',    'category' => 'canned_goods', 'unit' => 'ml',  'cost_per_unit' => 0.06,   'stock' => 2000.00,  'threshold' => 200.00],
            ['name' => 'Sardines (canned)',        'category' => 'canned_goods', 'unit' => 'g',   'cost_per_unit' => 0.06,   'stock' => 2000.00,  'threshold' => 200.00],
            ['name' => 'Cooking Oil',              'category' => 'oils',         'unit' => 'ml',  'cost_per_unit' => 0.07,   'stock' => 5000.00,  'threshold' => 500.00],
            ['name' => 'Water',                    'category' => 'liquids',      'unit' => 'ml',  'cost_per_unit' => 0.00,   'stock' => 10000.00, 'threshold' => 1000.00],
            ['name' => 'Soy Sauce',                'category' => 'condiments',   'unit' => 'ml',  'cost_per_unit' => 0.04,   'stock' => 2000.00,  'threshold' => 200.00],
            ['name' => 'Fish Sauce (Patis)',       'category' => 'condiments',   'unit' => 'ml',  'cost_per_unit' => 0.04,   'stock' => 1000.00,  'threshold' => 100.00],
            ['name' => 'Vinegar',                  'category' => 'acids',        'unit' => 'ml',  'cost_per_unit' => 0.02,   'stock' => 2000.00,  'threshold' => 200.00],
            ['name' => 'Black Pepper (ground)',    'category' => 'spices',       'unit' => 'g',   'cost_per_unit' => 0.30,   'stock' => 300.00,   'threshold' => 50.00],
            ['name' => 'Bay Leaves',               'category' => 'herbs',        'unit' => 'pcs', 'cost_per_unit' => 1.50,   'stock' => 50.00,    'threshold' => 5.00],
            ['name' => 'Salt',                     'category' => 'spices',       'unit' => 'g',   'cost_per_unit' => 0.01,   'stock' => 2000.00,  'threshold' => 200.00],
            ['name' => 'Sugar',                    'category' => 'sweeteners',   'unit' => 'g',   'cost_per_unit' => 0.05,   'stock' => 2000.00,  'threshold' => 200.00],
            ['name' => 'Oyster Sauce',             'category' => 'condiments',   'unit' => 'ml',  'cost_per_unit' => 0.09,   'stock' => 500.00,   'threshold' => 100.00],
            ['name' => 'Banana Ketchup',           'category' => 'condiments',   'unit' => 'ml',  'cost_per_unit' => 0.05,   'stock' => 500.00,   'threshold' => 100.00],
            ['name' => 'Annatto (Atsuete)',        'category' => 'spices',       'unit' => 'g',   'cost_per_unit' => 0.15,   'stock' => 200.00,   'threshold' => 30.00],
            ['name' => 'Instant Coffee (3-in-1)', 'category' => 'others',       'unit' => 'g',   'cost_per_unit' => 0.30,   'stock' => 1000.00,  'threshold' => 100.00],
            ['name' => 'Powdered Juice (Pineapple)','category' => 'sweeteners', 'unit' => 'g',   'cost_per_unit' => 0.25,   'stock' => 500.00,   'threshold' => 100.00],
            ['name' => 'Chocolate Powder (Milo)', 'category' => 'sweeteners',   'unit' => 'g',   'cost_per_unit' => 0.40,   'stock' => 500.00,   'threshold' => 100.00],
        ];

        $ingIds = [];
        foreach ($ingredients as $data) {
            $row = DB::table('ingredients')->where('name', $data['name'])->first();
            if (!$row) {
                $id = DB::table('ingredients')->insertGetId(array_merge($data, ['created_at' => $now, 'updated_at' => $now]));
            } else {
                $id = $row->id;
            }
            $ingIds[$data['name']] = $id;
        }

        // ── 2. PRODUCTS ─────────────────────────────────────────────
        $products = [
            ['name' => 'Adobong Manok',       'category' => 'meals',      'price' => 55.00],
            ['name' => 'Sinigang na Baboy',   'category' => 'meals',      'price' => 65.00],
            ['name' => 'Pinakbet',            'category' => 'meals',      'price' => 45.00],
            ['name' => 'Tinolang Manok',      'category' => 'meals',      'price' => 55.00],
            ['name' => 'Pork Menudo',         'category' => 'meals',      'price' => 60.00],
            ['name' => 'Bicol Express',       'category' => 'meals',      'price' => 60.00],
            ['name' => 'Dinuguan',            'category' => 'meals',      'price' => 50.00],
            ['name' => 'Paksiw na Bangus',    'category' => 'meals',      'price' => 50.00],
            ['name' => 'Beef Kaldereta',      'category' => 'meals',      'price' => 75.00],
            ['name' => 'Tortang Talong',      'category' => 'meals',      'price' => 35.00],
            ['name' => 'Pork Adobo',          'category' => 'meals',      'price' => 55.00],
            ['name' => 'Laing',               'category' => 'meals',      'price' => 45.00],
            ['name' => 'Pansit Bihon',        'category' => 'snacks',     'price' => 40.00],
            ['name' => 'Pansit Canton',       'category' => 'snacks',     'price' => 40.00],
            ['name' => 'Lumpia Shanghai',     'category' => 'snacks',     'price' => 35.00],
            ['name' => 'Tokwa at Baboy',      'category' => 'snacks',     'price' => 40.00],
            ['name' => 'Hotdog and Egg',      'category' => 'snacks',     'price' => 35.00],
            ['name' => 'Fried Tilapia',       'category' => 'snacks',     'price' => 45.00],
            ['name' => 'Kapeng Barako',       'category' => 'drinks',     'price' => 20.00],
            ['name' => 'Pineapple Juice',     'category' => 'drinks',     'price' => 15.00],
            ['name' => 'Milo Hot',            'category' => 'drinks',     'price' => 20.00],
            ['name' => 'Calamansi Juice',     'category' => 'drinks',     'price' => 15.00],
            ['name' => 'Puto',                'category' => 'ready_made', 'price' => 10.00],
            ['name' => 'Kutsinta',            'category' => 'ready_made', 'price' => 10.00],
        ];

        $prodIds = [];
        foreach ($products as $data) {
            $row = DB::table('products')->where('name', $data['name'])->first();
            if (!$row) {
                $id = DB::table('products')->insertGetId(array_merge($data, [
                    'stock' => 0, 'image' => null, 'created_at' => $now, 'updated_at' => $now,
                ]));
            } else {
                $id = $row->id;
            }
            $prodIds[$data['name']] = $id;
        }

        // ── 3. BATCH SIZES & RECIPES ─────────────────────────────────
        $menu = [
            ['product' => 'Adobong Manok',    'servings' => 5, 'ings' => [
                ['Chicken Thigh',1.00],['Garlic',30.00],['Onion',50.00],
                ['Soy Sauce',60.00],['Vinegar',60.00],['Bay Leaves',3.00],
                ['Black Pepper (ground)',3.00],['Cooking Oil',30.00],['Salt',5.00],
            ]],
            ['product' => 'Pork Adobo',       'servings' => 5, 'ings' => [
                ['Pork Belly',1.00],['Garlic',30.00],['Soy Sauce',60.00],
                ['Vinegar',60.00],['Bay Leaves',3.00],['Black Pepper (ground)',3.00],
                ['Cooking Oil',30.00],['Sugar',10.00],
            ]],
            ['product' => 'Sinigang na Baboy','servings' => 6, 'ings' => [
                ['Pork Belly',1.00],['Tomato',150.00],['Onion',80.00],
                ['Kangkong',200.00],['Sitaw (String Beans)',100.00],['Eggplant',150.00],
                ['Fish Sauce (Patis)',30.00],['Water',2000.00],['Salt',5.00],
            ]],
            ['product' => 'Pinakbet',         'servings' => 5, 'ings' => [
                ['Pork Belly',0.30],['Tomato',100.00],['Onion',50.00],['Garlic',20.00],
                ['Ampalaya (Bitter Gourd)',150.00],['Eggplant',150.00],
                ['Sitaw (String Beans)',100.00],['Sayote (Chayote)',100.00],
                ['Fish Sauce (Patis)',30.00],['Cooking Oil',30.00],
            ]],
            ['product' => 'Tinolang Manok',   'servings' => 5, 'ings' => [
                ['Chicken Thigh',1.00],['Garlic',20.00],['Onion',50.00],
                ['Sayote (Chayote)',200.00],['Pechay (Bok Choy)',100.00],
                ['Fish Sauce (Patis)',30.00],['Water',1500.00],['Cooking Oil',20.00],
            ]],
            ['product' => 'Pork Menudo',      'servings' => 5, 'ings' => [
                ['Pork Belly',0.50],['Chicken Liver',0.20],['Potato',0.30],
                ['Tomato Sauce (canned)',200.00],['Garlic',20.00],['Onion',50.00],
                ['Soy Sauce',30.00],['Salt',5.00],['Black Pepper (ground)',2.00],['Cooking Oil',30.00],
            ]],
            ['product' => 'Bicol Express',    'servings' => 5, 'ings' => [
                ['Pork Belly',0.50],['Coconut Milk (canned)',400.00],
                ['Garlic',20.00],['Onion',50.00],
                ['Fish Sauce (Patis)',20.00],['Salt',5.00],['Cooking Oil',30.00],
            ]],
            ['product' => 'Dinuguan',         'servings' => 5, 'ings' => [
                ['Pork Intestine',0.50],['Pork Belly',0.30],['Garlic',20.00],
                ['Onion',50.00],['Vinegar',60.00],['Fish Sauce (Patis)',20.00],
                ['Black Pepper (ground)',3.00],['Cooking Oil',30.00],
            ]],
            ['product' => 'Paksiw na Bangus', 'servings' => 4, 'ings' => [
                ['Bangus (Milkfish)',1.00],['Garlic',15.00],['Onion',50.00],
                ['Vinegar',80.00],['Water',200.00],['Fish Sauce (Patis)',20.00],
                ['Black Pepper (ground)',2.00],['Salt',5.00],
            ]],
            ['product' => 'Beef Kaldereta',   'servings' => 5, 'ings' => [
                ['Beef Short Ribs',1.00],['Tomato Sauce (canned)',200.00],
                ['Potato',0.30],['Garlic',20.00],['Onion',80.00],
                ['Soy Sauce',30.00],['Annatto (Atsuete)',5.00],['Salt',5.00],
                ['Black Pepper (ground)',3.00],['Cooking Oil',30.00],['Water',500.00],
            ]],
            ['product' => 'Tortang Talong',   'servings' => 4, 'ings' => [
                ['Eggplant',400.00],['Egg',4.00],['Ground Pork',0.20],
                ['Garlic',10.00],['Onion',30.00],['Fish Sauce (Patis)',15.00],
                ['Salt',3.00],['Cooking Oil',50.00],
            ]],
            ['product' => 'Laing',            'servings' => 5, 'ings' => [
                ['Banana Blossom',300.00],['Pork Belly',0.20],
                ['Coconut Milk (canned)',400.00],['Garlic',15.00],['Onion',50.00],
                ['Shrimp',0.10],['Fish Sauce (Patis)',20.00],['Salt',5.00],
            ]],
            ['product' => 'Pansit Bihon',     'servings' => 8, 'ings' => [
                ['Vermicelli (Bihon)',250.00],['Chicken Thigh',0.30],
                ['Garlic',15.00],['Onion',50.00],['Pechay (Bok Choy)',100.00],
                ['Sitaw (String Beans)',80.00],['Carrot',100.00],
                ['Soy Sauce',30.00],['Oyster Sauce',30.00],
                ['Cooking Oil',30.00],['Water',500.00],
            ]],
            ['product' => 'Pansit Canton',    'servings' => 8, 'ings' => [
                ['Canton Noodles',250.00],['Chicken Thigh',0.30],
                ['Garlic',15.00],['Onion',50.00],['Pechay (Bok Choy)',100.00],
                ['Sitaw (String Beans)',80.00],['Carrot',80.00],
                ['Soy Sauce',30.00],['Oyster Sauce',30.00],
                ['Cooking Oil',30.00],['Water',300.00],
            ]],
            ['product' => 'Lumpia Shanghai',  'servings' => 10, 'ings' => [
                ['Ground Pork',0.50],['Garlic',10.00],['Onion',50.00],
                ['Egg',2.00],['All-Purpose Flour',20.00],['Salt',3.00],
                ['Black Pepper (ground)',2.00],['Cooking Oil',100.00],['Soy Sauce',15.00],
            ]],
            ['product' => 'Tokwa at Baboy',   'servings' => 4, 'ings' => [
                ['Pork Belly',0.50],['Vinegar',60.00],['Soy Sauce',60.00],
                ['Garlic',15.00],['Onion',50.00],['Spring Onion',20.00],
                ['Salt',3.00],['Black Pepper (ground)',2.00],
            ]],
            ['product' => 'Hotdog and Egg',   'servings' => 2, 'ings' => [
                ['Hotdog',2.00],['Egg',2.00],['Cooking Oil',30.00],
                ['Salt',2.00],['Banana Ketchup',20.00],
            ]],
            ['product' => 'Fried Tilapia',    'servings' => 3, 'ings' => [
                ['Tilapia',1.00],['Cooking Oil',100.00],['Salt',10.00],
                ['Vinegar',30.00],['Garlic',10.00],
            ]],
            ['product' => 'Kapeng Barako',    'servings' => 4, 'ings' => [
                ['Instant Coffee (3-in-1)',80.00],['Water',1000.00],
            ]],
            ['product' => 'Pineapple Juice',  'servings' => 6, 'ings' => [
                ['Powdered Juice (Pineapple)',50.00],['Sugar',20.00],['Water',1500.00],
            ]],
            ['product' => 'Milo Hot',         'servings' => 4, 'ings' => [
                ['Chocolate Powder (Milo)',120.00],['Evaporated Milk',200.00],['Water',800.00],
            ]],
            ['product' => 'Calamansi Juice',  'servings' => 4, 'ings' => [
                ['Calamansi',10.00],['Sugar',30.00],['Water',1000.00],
            ]],
        ];

        foreach ($menu as $item) {
            $productId = $prodIds[$item['product']] ?? null;
            if (!$productId) continue;

            // Skip if this product already has a batch size
            if (DB::table('batch_sizes')->where('product_id', $productId)->exists()) continue;

            $batchId = DB::table('batch_sizes')->insertGetId([
                'product_id' => $productId,
                'servings'   => $item['servings'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($item['ings'] as [$ingName, $qty]) {
                $ingId = $ingIds[$ingName] ?? null;
                if (!$ingId) continue;
                DB::table('recipes')->insert([
                    'product_id'     => $productId,
                    'batch_sizes_id' => $batchId,
                    'ingredient_id'  => $ingId,
                    'quantity'       => $qty,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        $seededNames = [
            'Adobong Manok','Sinigang na Baboy','Pinakbet','Tinolang Manok',
            'Pork Menudo','Bicol Express','Dinuguan','Paksiw na Bangus',
            'Beef Kaldereta','Tortang Talong','Pork Adobo','Laing',
            'Pansit Bihon','Pansit Canton','Lumpia Shanghai','Tokwa at Baboy',
            'Hotdog and Egg','Fried Tilapia','Kapeng Barako',
            'Pineapple Juice','Milo Hot','Calamansi Juice','Puto','Kutsinta',
        ];
        $ids = DB::table('products')->whereIn('name', $seededNames)->pluck('id');
        DB::table('recipes')->whereIn('product_id', $ids)->delete();
        DB::table('batch_sizes')->whereIn('product_id', $ids)->delete();
        DB::table('products')->whereIn('name', $seededNames)->delete();
        DB::table('ingredients')->whereIn('name', [
            'Pork Belly','Ground Pork','Chicken Thigh','Chicken Liver','Beef Short Ribs',
            'Pork Intestine','Bangus (Milkfish)','Tilapia','Shrimp','Hotdog',
            'Garlic','Onion','Tomato','Potato','Carrot','Pechay (Bok Choy)','Kangkong',
            'Sitaw (String Beans)','Eggplant','Ampalaya (Bitter Gourd)','Sayote (Chayote)',
            'Banana Blossom','Spring Onion','Calamansi','White Rice','Vermicelli (Bihon)',
            'Canton Noodles','All-Purpose Flour','Egg','Evaporated Milk',
            'Tomato Sauce (canned)','Coconut Milk (canned)','Sardines (canned)',
            'Cooking Oil','Water','Soy Sauce','Fish Sauce (Patis)','Vinegar',
            'Black Pepper (ground)','Bay Leaves','Salt','Sugar','Oyster Sauce',
            'Banana Ketchup','Annatto (Atsuete)','Instant Coffee (3-in-1)',
            'Powdered Juice (Pineapple)','Chocolate Powder (Milo)',
        ])->delete();
    }
};
