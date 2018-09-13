<?php

add_action('woocommerce_shipping_init', 'nova_poshta_shipping_method_init');

function add_nova_poshta_shipping_method($methods) {
    $methods[] = 'WC_NovaPoshta_Shipping_Method';
    return $methods;
}

add_filter('woocommerce_shipping_methods', 'add_nova_poshta_shipping_method');

add_action( 'wp_ajax_nopriv_np_api_search_cities', 'searchCities' );
add_action( 'wp_ajax_np_api_search_cities', 'searchCities' );

function searchCities() {
    
    $key = $_POST['key'];                    

    $api_host = 'https://api.novaposhta.ua/v2.0/json/';    

    $options = get_site_option('woo_nova_poshta_shipping_method_settings');

    $api_key = $options['api_key'];    

    $request = [
        "apiKey" => $api_key,
        "modelName" => "Address",
        "calledMethod" => "getCities",
        "methodProperties" => [
            "FindByString" => $key
        ]
    ];

    # преобразование в JSON-формат
    $request = json_encode($request);

    # параметры запроса
    $opts = [
        'http' => [
            'method' => "POST",
            'header' => "Content-type: application/x-www-form-urlencoded;\r\n",
            'content' => $request,
        ]
    ];

    # создание контекста потока
    $context = stream_context_create($opts);

    # отправляем запрос и получаем ответ от сервера
    $result = file_get_contents($api_host, 0, $context);
    $data = json_decode($result);


    $response = [];

    if (isset($data) && $data->success == 1) {
        foreach ($data->data as $item) {
            $response[] = [
                'name' => $item->DescriptionRu,
                'ref' => $item->Ref
            ];
        }
    }

    header('Content-type: application/json');
    echo json_encode($response);
    die();
}


    add_action( 'wp_ajax_nopriv_np_api_getPostIndex', 'getPostIndex' );
    add_action( 'wp_ajax_np_api_getPostIndex', 'getPostIndex' );

function getPostIndex(){
    if (isset($_POST['ref'])) :
        $ref=$_POST['ref'];
    else :
        die();
    endif;

//    $key = $_POST['key'];

    $api_host = 'https://api.novaposhta.ua/v2.0/json/';

    $options = get_site_option('woo_nova_poshta_shipping_method_settings');

    $api_key = $options['api_key'];
    $request = [
        "apiKey" => $api_key,
        "modelName" => "AddressGeneral",
        "calledMethod" => "getSettlements",
        "methodProperties" => [
        "FindByString" => $ref,

        ]
    ];


    # преобразование в JSON-формат
    $request = json_encode($request);

    # параметры запроса
    $opts = [
        'http' => [
            'method' => "GET",
            'header' => "Content-type: application/x-www-form-urlencoded;\r\n",
            'content' => $request,
        ]
    ];

    # создание контекста потока
    $context = stream_context_create($opts);

    # отправляем запрос и получаем ответ от сервера
    $result = file_get_contents($api_host, 0, $context);
    $data = json_decode($result);
    $response = [];

    if (isset($data) && $data->success == 1) {
        foreach ($data->data as $item) {

            $response[] = [
                'PostCode' => $item->Index1
                              //.' '.$item->Index2,
            ];
        }
    }

    header('Content-type: application/json');
    echo json_encode($response);
    die();
}

function getCitiesByAreaCodeAjax($city = 'City') {
    $area = $_POST['area'];
    if (isset($_POST['typeElem'])) $city=$_POST['typeElem'];

    global $wpdb;
    global $nova_poshta_db_name;

    $res = $wpdb->get_results("Select * from " . $nova_poshta_db_name . " where type = '".$city ."' and Area = '" . $area . "'");

    foreach ($res as $val) {
        $states[$val->Ref] = $val->Description;
    }

    if (empty($states) || count($states) == 0) {
        $states = [];
    }
    header('Content-type: application/json');
    echo json_encode($states);
    die();
}

add_action('wp_ajax_np_api_get_cities_by_area', 'getCitiesByAreaCodeAjax'); // wp_ajax_{значение параметра action}

add_filter('woocommerce_states', 'custom_woocommerce_states');

function custom_woocommerce_states($states) {

    global $wpdb;
    global $nova_poshta_db_name;

    $res = $wpdb->get_results("Select * from " . $nova_poshta_db_name . " where type = 'Area' and Area = ''");

    foreach ($res as $val) {
        $states['UA'][$val->Ref] = $val->Description;
    }

    return $states;
}

add_filter('woocommerce_shipping_calculator_enable_city', '__return_true');

add_filter('woocommerce_locate_template', 'woo_adon_plugin_template', 1, 3);

function woo_adon_plugin_template($template, $template_name, $template_path) {
    global $woocommerce;
    $_template = $template;
    if (!$template_path)
        $template_path = $woocommerce->template_url;

    $plugin_path = untrailingslashit(plugin_dir_path(__FILE__)) . '/template/woocommerce/';

    // Look within passed path within the theme - this is priority
    $template = locate_template(
            array(
                $template_path . $template_name,
                $template_name
            )
    );

    if (!$template && file_exists($plugin_path . $template_name))
        $template = $plugin_path . $template_name;

    if (!$template)
        $template = $_template;

    return $template;
}

add_filter("woocommerce_checkout_fields", "order_fields");

function order_fields($fields) {

    $order = array(
        "billing_email",
        "billing_phone",
        "billing_first_name",
        "billing_last_name",
        "billing_company",
        "billing_address_1",
        "billing_address_2",
        "billing_state",
        "billing_city",
        "billing_np_number",
        "billing_postcode"
    );
    foreach ($order as $field) {
        $ordered_fields[$field] = $fields["billing"][$field];
    }

    $fields["billing"] = $ordered_fields;
    return $fields;
}

// Add a new checkout field
function add_new_billing_fields($fields) {
    
    $fields['billing_np_number'] = [
        'type' =>'select',
        'required'=>true,
        'label' => 'Отделение новой почты (№)',
//        'placeholder' => 'Отделение новой почты (№)'
        'options'=> array(
            'name'=>''
         )
    ];

    return $fields;
}

add_filter('woocommerce_billing_fields', 'add_new_billing_fields');

    /**
     * Обновляем метаданные заказа со значением поля
     */
    add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

    function my_custom_checkout_field_update_order_meta( $order_id ) {
        if ( ! empty( $_POST['billing_np_number'] ) ) {
            update_post_meta( $order_id, 'WareHouse', sanitize_text_field( $_POST['billing_np_number'] ) );
        }
    }

    /**
     * Выводим значение поля на странице редактирования заказа
     */
    add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

    function my_custom_checkout_field_display_admin_order_meta($order){
        echo '<p><strong>'.__('Sklad').':</strong> ' . get_post_meta( $order->id, 'WareHouse', true ) . '</p>';
    }

    /**
     * Добавляем поле в письма заказа
     **/
    add_filter('woocommerce_email_order_meta_keys', 'my_custom_checkout_field_order_meta_keys');

    function my_custom_checkout_field_order_meta_keys( $keys ) {
        $keys['billing_np_number'] = 'billing_np_number';
        return $keys;
    }

function add_scripts() {
    wp_enqueue_script('jquery-ui-autocomplete');
}

add_action('wp_enqueue_scripts', 'add_scripts');

// define the woocommerce_order_formatted_billing_address callback
function filter_woocommerce_order_formatted_billing_address($instance) {

    global $wpdb;
    global $nova_poshta_db_name;

    $res = $wpdb->get_row("Select * from " . $nova_poshta_db_name . " where type = 'Area' and Ref = '" . $instance['state'] . "'");
    $instance['state'] = $res->Description;

    $res = $wpdb->get_row("Select * from " . $nova_poshta_db_name . " where type = 'City' and Ref = '" . $instance['city'] . "'");
    $instance['city'] = $res->Description;


    // make filter magic happen here...
    return $instance;
}

;

// add the filter
add_filter('woocommerce_order_formatted_billing_address', 'filter_woocommerce_order_formatted_billing_address', 10, 3);
add_filter('woocommerce_order_formatted_shipping_address', 'filter_woocommerce_order_formatted_billing_address', 10, 3);

