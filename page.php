/* 
*added code to make default variation auto select 
*/
add_filter('woocommerce_dropdown_variation_attribute_options_args','select_default_option',10,1);
function select_default_option( $args)
{
    global $product; // current product details
    $id = $product->get_id();
    $variations = $product->get_available_variations(); // get product variation
    $variations_stock = array();

    $variationName='';
    foreach ( $variations as $variation ) { //check in stock condition
        $variation_o = new WC_Product_Variation( $variation['variation_id'] );
        $variationName = implode(" / ", $variation_o->get_variation_attributes()); //
    }
    $variationName;
    if(count($args['options']) > 0){ //Check the count of available options in dropdown
        if($variationName!=''){ // if variation name not blank selected variation name
            $args['selected'] = $variationName;
        }else{  // else make default value selected 
            $args['selected'] = $args['options'][0];
        }
    }
    return $args;
}
