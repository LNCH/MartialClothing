<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationStockView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW product_variation_stock_view AS 
            
                SELECT 
                    product_variations.id AS product_variation_id,
                    product_variations.product_id AS product_id,
                    COALESCE(SUM(stocks.quantity) - COALESCE(SUM(ordered_items.quantity), 0), 0) AS stock,
                    CASE WHEN COALESCE(SUM(stocks.quantity) - COALESCE(SUM(ordered_items.quantity), 0), 0) > 0
                        THEN TRUE
                        ELSE FALSE
                    END in_stock
                    
                FROM product_variations
                
                LEFT JOIN (
                    SELECT 
                        stock_blocks.product_variation_id AS id,
                        SUM(stock_blocks.quantity) AS quantity
                    FROM stock_blocks
                    GROUP BY stock_blocks.product_variation_id
                ) AS stocks USING (id)
                
                LEFT JOIN (
                    SELECT 
                        order_items.product_variation_id AS id,
                        SUM(order_items.quantity) AS quantity
                    FROM order_items
                    GROUP BY order_items.product_variation_id
                ) AS ordered_items USING (id)
                
                GROUP BY product_variations.id 
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS product_variation_stock_view;");
    }
}
