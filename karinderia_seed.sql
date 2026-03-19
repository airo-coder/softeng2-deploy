-- ============================================================
-- University Dining Center — Karinderia Seed Data
-- Run this in: Supabase Dashboard → SQL Editor
-- Safe: Uses INSERT ... WHERE NOT EXISTS (no overrides)
-- ============================================================

-- Fix: ensure image column allows NULL (in case migration didn't apply)
ALTER TABLE products ALTER COLUMN image DROP NOT NULL;

-- ── INGREDIENTS ─────────────────────────────────────────────
INSERT INTO ingredients (name, category, unit, cost_per_unit, stock, threshold, created_at, updated_at)
SELECT v.name, v.category, v.unit, v.cost_per_unit, v.stock, v.threshold, NOW(), NOW()
FROM (VALUES
  ('Pork Belly',              'meat',         'kg',  280.00, 10.00,    2.00),
  ('Ground Pork',             'meat',         'kg',  220.00, 8.00,     2.00),
  ('Chicken Thigh',           'meat',         'kg',  200.00, 10.00,    2.00),
  ('Chicken Liver',           'meat',         'kg',  100.00, 5.00,     1.00),
  ('Beef Short Ribs',         'meat',         'kg',  380.00, 5.00,     1.00),
  ('Pork Intestine',          'meat',         'kg',  150.00, 4.00,     1.00),
  ('Bangus (Milkfish)',       'meat',         'kg',  180.00, 6.00,     1.00),
  ('Tilapia',                 'meat',         'kg',  130.00, 6.00,     1.00),
  ('Shrimp',                  'meat',         'kg',  300.00, 4.00,     1.00),
  ('Hotdog',                  'meat',         'pcs', 12.00,  50.00,    10.00),
  ('Garlic',                  'produce',      'g',   0.08,   1000.00,  100.00),
  ('Onion',                   'produce',      'g',   0.06,   1000.00,  100.00),
  ('Tomato',                  'produce',      'g',   0.05,   1000.00,  100.00),
  ('Potato',                  'produce',      'kg',  80.00,  5.00,     1.00),
  ('Carrot',                  'produce',      'g',   0.05,   1000.00,  100.00),
  ('Pechay (Bok Choy)',       'produce',      'g',   0.04,   1000.00,  100.00),
  ('Kangkong',                'produce',      'g',   0.03,   1000.00,  100.00),
  ('Sitaw (String Beans)',    'produce',      'g',   0.04,   500.00,   100.00),
  ('Eggplant',                'produce',      'g',   0.04,   1000.00,  100.00),
  ('Ampalaya (Bitter Gourd)', 'produce',      'g',   0.05,   500.00,   100.00),
  ('Sayote (Chayote)',        'produce',      'g',   0.03,   1000.00,  100.00),
  ('Banana Blossom',          'produce',      'g',   0.04,   500.00,   100.00),
  ('Spring Onion',            'herbs',        'g',   0.05,   300.00,   50.00),
  ('Calamansi',               'produce',      'pcs', 1.00,   100.00,   20.00),
  ('White Rice',              'grains',       'kg',  52.00,  25.00,    5.00),
  ('Vermicelli (Bihon)',      'grains',       'g',   0.09,   2000.00,  200.00),
  ('Canton Noodles',          'grains',       'g',   0.09,   2000.00,  200.00),
  ('All-Purpose Flour',       'baking',       'g',   0.05,   2000.00,  200.00),
  ('Egg',                     'dairy',        'pcs', 8.00,   100.00,   12.00),
  ('Evaporated Milk',         'dairy',        'ml',  0.07,   1000.00,  200.00),
  ('Tomato Sauce (canned)',   'canned_goods', 'ml',  0.05,   2000.00,  200.00),
  ('Coconut Milk (canned)',   'canned_goods', 'ml',  0.06,   2000.00,  200.00),
  ('Sardines (canned)',       'canned_goods', 'g',   0.06,   2000.00,  200.00),
  ('Cooking Oil',             'oils',         'ml',  0.07,   5000.00,  500.00),
  ('Water',                   'liquids',      'ml',  0.00,   10000.00, 1000.00),
  ('Soy Sauce',               'condiments',   'ml',  0.04,   2000.00,  200.00),
  ('Fish Sauce (Patis)',      'condiments',   'ml',  0.04,   1000.00,  100.00),
  ('Vinegar',                 'acids',        'ml',  0.02,   2000.00,  200.00),
  ('Black Pepper (ground)',   'spices',       'g',   0.30,   300.00,   50.00),
  ('Bay Leaves',              'herbs',        'pcs', 1.50,   50.00,    5.00),
  ('Salt',                    'spices',       'g',   0.01,   2000.00,  200.00),
  ('Sugar',                   'sweeteners',   'g',   0.05,   2000.00,  200.00),
  ('Oyster Sauce',            'condiments',   'ml',  0.09,   500.00,   100.00),
  ('Banana Ketchup',          'condiments',   'ml',  0.05,   500.00,   100.00),
  ('Annatto (Atsuete)',       'spices',       'g',   0.15,   200.00,   30.00),
  ('Instant Coffee (3-in-1)','others',        'g',   0.30,   1000.00,  100.00),
  ('Powdered Juice (Pineapple)','sweeteners', 'g',   0.25,   500.00,   100.00),
  ('Chocolate Powder (Milo)', 'sweeteners',   'g',   0.40,   500.00,   100.00)
) AS v(name, category, unit, cost_per_unit, stock, threshold)
WHERE NOT EXISTS (
  SELECT 1 FROM ingredients WHERE ingredients.name = v.name
);

-- ── PRODUCTS ────────────────────────────────────────────────
INSERT INTO products (name, category, price, stock, image, created_at, updated_at)
SELECT v.name, v.category, v.price, 0, NULL, NOW(), NOW()
FROM (VALUES
  ('Adobong Manok',     'meals',      55.00),
  ('Sinigang na Baboy', 'meals',      65.00),
  ('Pinakbet',          'meals',      45.00),
  ('Tinolang Manok',    'meals',      55.00),
  ('Pork Menudo',       'meals',      60.00),
  ('Bicol Express',     'meals',      60.00),
  ('Dinuguan',          'meals',      50.00),
  ('Paksiw na Bangus',  'meals',      50.00),
  ('Beef Kaldereta',    'meals',      75.00),
  ('Tortang Talong',    'meals',      35.00),
  ('Pork Adobo',        'meals',      55.00),
  ('Laing',             'meals',      45.00),
  ('Pansit Bihon',      'snacks',     40.00),
  ('Pansit Canton',     'snacks',     40.00),
  ('Lumpia Shanghai',   'snacks',     35.00),
  ('Tokwa at Baboy',    'snacks',     40.00),
  ('Hotdog and Egg',    'snacks',     35.00),
  ('Fried Tilapia',     'snacks',     45.00),
  ('Kapeng Barako',     'drinks',     20.00),
  ('Pineapple Juice',   'drinks',     15.00),
  ('Milo Hot',          'drinks',     20.00),
  ('Calamansi Juice',   'drinks',     15.00),
  ('Puto',              'ready_made', 10.00),
  ('Kutsinta',          'ready_made', 10.00)
) AS v(name, category, price)
WHERE NOT EXISTS (
  SELECT 1 FROM products WHERE products.name = v.name
);

-- ── BATCH SIZES ──────────────────────────────────────────────
-- One batch per product (only if not already created)
INSERT INTO batch_sizes (product_id, servings, created_at, updated_at)
SELECT p.id, v.servings, NOW(), NOW()
FROM (VALUES
  ('Adobong Manok',     5),
  ('Sinigang na Baboy', 6),
  ('Pinakbet',          5),
  ('Tinolang Manok',    5),
  ('Pork Menudo',       5),
  ('Bicol Express',     5),
  ('Dinuguan',          5),
  ('Paksiw na Bangus',  4),
  ('Beef Kaldereta',    5),
  ('Tortang Talong',    4),
  ('Pork Adobo',        5),
  ('Laing',             5),
  ('Pansit Bihon',      8),
  ('Pansit Canton',     8),
  ('Lumpia Shanghai',   10),
  ('Tokwa at Baboy',    4),
  ('Hotdog and Egg',    2),
  ('Fried Tilapia',     3),
  ('Kapeng Barako',     4),
  ('Pineapple Juice',   6),
  ('Milo Hot',          4),
  ('Calamansi Juice',   4)
) AS v(product_name, servings)
JOIN products p ON p.name = v.product_name
WHERE NOT EXISTS (
  SELECT 1 FROM batch_sizes WHERE batch_sizes.product_id = p.id
);

-- ── RECIPES ──────────────────────────────────────────────────
-- Insert recipe rows (only if batch_size + ingredient combo doesn't exist)
INSERT INTO recipes (product_id, batch_sizes_id, ingredient_id, quantity, created_at, updated_at)
SELECT p.id, b.id, i.id, v.quantity, NOW(), NOW()
FROM (VALUES
  -- Adobong Manok
  ('Adobong Manok','Chicken Thigh',1.00),('Adobong Manok','Garlic',30.00),('Adobong Manok','Onion',50.00),
  ('Adobong Manok','Soy Sauce',60.00),('Adobong Manok','Vinegar',60.00),('Adobong Manok','Bay Leaves',3.00),
  ('Adobong Manok','Black Pepper (ground)',3.00),('Adobong Manok','Cooking Oil',30.00),('Adobong Manok','Salt',5.00),
  -- Pork Adobo
  ('Pork Adobo','Pork Belly',1.00),('Pork Adobo','Garlic',30.00),('Pork Adobo','Soy Sauce',60.00),
  ('Pork Adobo','Vinegar',60.00),('Pork Adobo','Bay Leaves',3.00),('Pork Adobo','Black Pepper (ground)',3.00),
  ('Pork Adobo','Cooking Oil',30.00),('Pork Adobo','Sugar',10.00),
  -- Sinigang na Baboy
  ('Sinigang na Baboy','Pork Belly',1.00),('Sinigang na Baboy','Tomato',150.00),('Sinigang na Baboy','Onion',80.00),
  ('Sinigang na Baboy','Kangkong',200.00),('Sinigang na Baboy','Sitaw (String Beans)',100.00),
  ('Sinigang na Baboy','Eggplant',150.00),('Sinigang na Baboy','Fish Sauce (Patis)',30.00),
  ('Sinigang na Baboy','Water',2000.00),('Sinigang na Baboy','Salt',5.00),
  -- Pinakbet
  ('Pinakbet','Pork Belly',0.30),('Pinakbet','Tomato',100.00),('Pinakbet','Onion',50.00),
  ('Pinakbet','Garlic',20.00),('Pinakbet','Ampalaya (Bitter Gourd)',150.00),('Pinakbet','Eggplant',150.00),
  ('Pinakbet','Sitaw (String Beans)',100.00),('Pinakbet','Sayote (Chayote)',100.00),
  ('Pinakbet','Fish Sauce (Patis)',30.00),('Pinakbet','Cooking Oil',30.00),
  -- Tinolang Manok
  ('Tinolang Manok','Chicken Thigh',1.00),('Tinolang Manok','Garlic',20.00),('Tinolang Manok','Onion',50.00),
  ('Tinolang Manok','Sayote (Chayote)',200.00),('Tinolang Manok','Pechay (Bok Choy)',100.00),
  ('Tinolang Manok','Fish Sauce (Patis)',30.00),('Tinolang Manok','Water',1500.00),('Tinolang Manok','Cooking Oil',20.00),
  -- Pork Menudo
  ('Pork Menudo','Pork Belly',0.50),('Pork Menudo','Chicken Liver',0.20),('Pork Menudo','Potato',0.30),
  ('Pork Menudo','Tomato Sauce (canned)',200.00),('Pork Menudo','Garlic',20.00),('Pork Menudo','Onion',50.00),
  ('Pork Menudo','Soy Sauce',30.00),('Pork Menudo','Salt',5.00),('Pork Menudo','Black Pepper (ground)',2.00),
  ('Pork Menudo','Cooking Oil',30.00),
  -- Bicol Express
  ('Bicol Express','Pork Belly',0.50),('Bicol Express','Coconut Milk (canned)',400.00),
  ('Bicol Express','Garlic',20.00),('Bicol Express','Onion',50.00),
  ('Bicol Express','Fish Sauce (Patis)',20.00),('Bicol Express','Salt',5.00),('Bicol Express','Cooking Oil',30.00),
  -- Dinuguan
  ('Dinuguan','Pork Intestine',0.50),('Dinuguan','Pork Belly',0.30),('Dinuguan','Garlic',20.00),
  ('Dinuguan','Onion',50.00),('Dinuguan','Vinegar',60.00),('Dinuguan','Fish Sauce (Patis)',20.00),
  ('Dinuguan','Black Pepper (ground)',3.00),('Dinuguan','Cooking Oil',30.00),
  -- Paksiw na Bangus
  ('Paksiw na Bangus','Bangus (Milkfish)',1.00),('Paksiw na Bangus','Garlic',15.00),
  ('Paksiw na Bangus','Onion',50.00),('Paksiw na Bangus','Vinegar',80.00),('Paksiw na Bangus','Water',200.00),
  ('Paksiw na Bangus','Fish Sauce (Patis)',20.00),('Paksiw na Bangus','Black Pepper (ground)',2.00),
  ('Paksiw na Bangus','Salt',5.00),
  -- Beef Kaldereta
  ('Beef Kaldereta','Beef Short Ribs',1.00),('Beef Kaldereta','Tomato Sauce (canned)',200.00),
  ('Beef Kaldereta','Potato',0.30),('Beef Kaldereta','Garlic',20.00),('Beef Kaldereta','Onion',80.00),
  ('Beef Kaldereta','Soy Sauce',30.00),('Beef Kaldereta','Annatto (Atsuete)',5.00),('Beef Kaldereta','Salt',5.00),
  ('Beef Kaldereta','Black Pepper (ground)',3.00),('Beef Kaldereta','Cooking Oil',30.00),('Beef Kaldereta','Water',500.00),
  -- Tortang Talong
  ('Tortang Talong','Eggplant',400.00),('Tortang Talong','Egg',4.00),('Tortang Talong','Ground Pork',0.20),
  ('Tortang Talong','Garlic',10.00),('Tortang Talong','Onion',30.00),('Tortang Talong','Fish Sauce (Patis)',15.00),
  ('Tortang Talong','Salt',3.00),('Tortang Talong','Cooking Oil',50.00),
  -- Laing
  ('Laing','Banana Blossom',300.00),('Laing','Pork Belly',0.20),('Laing','Coconut Milk (canned)',400.00),
  ('Laing','Garlic',15.00),('Laing','Onion',50.00),('Laing','Shrimp',0.10),
  ('Laing','Fish Sauce (Patis)',20.00),('Laing','Salt',5.00),
  -- Pansit Bihon
  ('Pansit Bihon','Vermicelli (Bihon)',250.00),('Pansit Bihon','Chicken Thigh',0.30),
  ('Pansit Bihon','Garlic',15.00),('Pansit Bihon','Onion',50.00),
  ('Pansit Bihon','Pechay (Bok Choy)',100.00),('Pansit Bihon','Sitaw (String Beans)',80.00),
  ('Pansit Bihon','Carrot',100.00),('Pansit Bihon','Soy Sauce',30.00),
  ('Pansit Bihon','Oyster Sauce',30.00),('Pansit Bihon','Cooking Oil',30.00),('Pansit Bihon','Water',500.00),
  -- Pansit Canton
  ('Pansit Canton','Canton Noodles',250.00),('Pansit Canton','Chicken Thigh',0.30),
  ('Pansit Canton','Garlic',15.00),('Pansit Canton','Onion',50.00),
  ('Pansit Canton','Pechay (Bok Choy)',100.00),('Pansit Canton','Sitaw (String Beans)',80.00),
  ('Pansit Canton','Carrot',80.00),('Pansit Canton','Soy Sauce',30.00),
  ('Pansit Canton','Oyster Sauce',30.00),('Pansit Canton','Cooking Oil',30.00),('Pansit Canton','Water',300.00),
  -- Lumpia Shanghai
  ('Lumpia Shanghai','Ground Pork',0.50),('Lumpia Shanghai','Garlic',10.00),('Lumpia Shanghai','Onion',50.00),
  ('Lumpia Shanghai','Egg',2.00),('Lumpia Shanghai','All-Purpose Flour',20.00),('Lumpia Shanghai','Salt',3.00),
  ('Lumpia Shanghai','Black Pepper (ground)',2.00),('Lumpia Shanghai','Cooking Oil',100.00),
  ('Lumpia Shanghai','Soy Sauce',15.00),
  -- Tokwa at Baboy
  ('Tokwa at Baboy','Pork Belly',0.50),('Tokwa at Baboy','Vinegar',60.00),('Tokwa at Baboy','Soy Sauce',60.00),
  ('Tokwa at Baboy','Garlic',15.00),('Tokwa at Baboy','Onion',50.00),('Tokwa at Baboy','Spring Onion',20.00),
  ('Tokwa at Baboy','Salt',3.00),('Tokwa at Baboy','Black Pepper (ground)',2.00),
  -- Hotdog and Egg
  ('Hotdog and Egg','Hotdog',2.00),('Hotdog and Egg','Egg',2.00),('Hotdog and Egg','Cooking Oil',30.00),
  ('Hotdog and Egg','Salt',2.00),('Hotdog and Egg','Banana Ketchup',20.00),
  -- Fried Tilapia
  ('Fried Tilapia','Tilapia',1.00),('Fried Tilapia','Cooking Oil',100.00),('Fried Tilapia','Salt',10.00),
  ('Fried Tilapia','Vinegar',30.00),('Fried Tilapia','Garlic',10.00),
  -- Drinks
  ('Kapeng Barako','Instant Coffee (3-in-1)',80.00),('Kapeng Barako','Water',1000.00),
  ('Pineapple Juice','Powdered Juice (Pineapple)',50.00),('Pineapple Juice','Sugar',20.00),('Pineapple Juice','Water',1500.00),
  ('Milo Hot','Chocolate Powder (Milo)',120.00),('Milo Hot','Evaporated Milk',200.00),('Milo Hot','Water',800.00),
  ('Calamansi Juice','Calamansi',10.00),('Calamansi Juice','Sugar',30.00),('Calamansi Juice','Water',1000.00)
) AS v(product_name, ingredient_name, quantity)
JOIN products p ON p.name = v.product_name
JOIN ingredients i ON i.name = v.ingredient_name
JOIN batch_sizes b ON b.product_id = p.id
WHERE NOT EXISTS (
  SELECT 1 FROM recipes r
  WHERE r.product_id = p.id
    AND r.ingredient_id = i.id
    AND r.batch_sizes_id = b.id
);
