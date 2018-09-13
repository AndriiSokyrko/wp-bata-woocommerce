<?php

/**
 * Plugin Name: Woo NovaPoshta Shipping Method
 * Plugin URI: 
 * Description: Woo NovaPoshta Shipping Method.
 * Version: 1.0.2
 * Author: Sergey.Kovalchuk
 * Author URI: http://onix-systems.com 
 * 
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
header("Access-Control-Allow-Origin: *");
/**
 * Check if WooCommerce is active
 * */
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {    
    
    
    function nova_poshta_shipping_method_init() {
        
        if (!class_exists('WC_NovaPoshta_Shipping_Method')) {            
            
            class WC_NovaPoshta_Shipping_Method extends WC_Shipping_Method {

                public $api_host = 'https://api.novaposhta.ua/v2.0/json/';

                /**
                 * Constructor for your shipping class
                 *
                 * @access public
                 * @return void
                 */
                public function __construct() {            
                    $this->id = 'nova_poshta_shipping_method'; // Id for your shipping method. Should be uunique.
                    $this->method_title = __('Nova Poshta Shipping Method');  // Title shown in admin
                    $this->method_description = __('Description of your shipping method'); // Description shown in admin

                    $this->init();

                    // Get setting values
                    $this->title = $this->settings['title'];
                    $this->enabled = $this->settings['enabled'];

                    add_action('admin_enqueue_scripts', array($this, 'shipping_scripts'));
                    add_action('wp_enqueue_scripts', array($this, 'shipping_scripts'));
                    $this->updateAreas();
                }

                /**
                 * payment_scripts function.
                 *
                 * @access public
                 */
                function shipping_scripts() {
                    wp_enqueue_script('shipping_scripts', plugins_url('assets/js/novaposhta.js', __FILE__), 'jquery', '1.0.0', true);
                }

                /**
                 * Init your settings
                 *
                 * @access public
                 * @return void
                 */
                function init() {
                    // Load the settings API
                    $this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
                    $this->init_settings(); // This is part of the settings API. Loads settings you previously init.
                    // Save settings in admin if you have any defined
                    add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
                }

                /**
                 * Initialise Gateway Settings Form Fields
                 */
                function init_form_fields() {

                    $this->form_fields = [
                        'enabled' => [
                            'title' => __('Enable/Disable', 'nova_poshta_shipping_method'),
                            'label' => __('Enable NovaPoshta', 'nova_poshta_shipping_method'),
                            'type' => 'checkbox',
                            'description' => '',
                            'default' => 'no'
                        ],
                        'title' => [
                            'title' => __('Title', 'nova_poshta_shipping_method'),
                            'type' => 'text',
                            'description' => __('This controls the title which the user sees during checkout.', 'nova_poshta_shipping_method'),
                            'default' => __('Nova Poshta', 'nova_poshta_shipping_method')
                        ],
                        'api_key' => [
                            'title' => __('API Key', 'nova_poshta_shipping_method'),
                            'type' => 'text',
                            'description' => __('Get your API Key. <a href="https://my.novaposhta.ua/settings/index#apikeys">My Account (Nova Poshta)</a>', 'nova_poshta_shipping_method'),
                            'default' => ''
                        ],
                        'city' => [
                            'title' => __('City', 'nova_poshta_shipping_method'),
                            'type' => 'text',
                            'description' => __('Specify the City sending of goods. (After save API key)', 'nova_poshta_shipping_method'),
                            'default' => __('', 'nova_poshta_shipping_method')
                        ],
                        'city2' => [
                            'type' => 'hidden'
                        ],
                        'enabled_cash_on_delivery' => [
                            'title' => __('Cash on delivery or Fixed price.', 'nova_poshta_shipping_method'),
                            'label' => __('Enable Cash on delivery or Fixed price.', 'nova_poshta_shipping_method'),
                            'type' => 'select',
                            'description' => '',
                            'default' => 'on_delivery',
                            'options' => [
                                'on_delivery' => 'Cash on delivery',
                                'fixed_price' => 'Fixed Price',
                            ]
                        ],
                        'fixed_price' => [
                            'title' => __('Fixed price', 'nova_poshta_shipping_method'),
                            'type' => 'text',
                            'description' => __('Delivery Fixed price.', 'nova_poshta_shipping_method'),
                            'default' => __('0.00', 'nova_poshta_shipping_method')
                        ],
                    ];
                }

                /**
                 * calculate_shipping function.
                 *
                 * @access public
                 * @param mixed $package
                 * @return void
                 */
                public function calculate_shipping($package) {
                    $this->init_form_fields();
                    $this->init_settings();

                    $on_delivery = ($this->settings['enabled_cash_on_delivery'] == 'on_delivery') ? 1 : 0;

                    if ($on_delivery == 0) {
                        $rate = array(
                            'id' => $this->id,
                            'label' => $this->title,
                            'cost' => $this->settings['fixed_price'],
                            'calc_tax' => 'per_item'
                        );
                        $this->add_rate($rate);
                        return;
                    }

                    $weight = WC()->cart->cart_contents_weight;

                    $cost = $this->calculate($weight, $this->settings['city2']);

                    $rate = array(
                        'id' => $this->id,
                        'label' => $this->title,
                        'cost' => $cost,
                        'calc_tax' => 'per_item'
                    );

                    // Register the rate
                    $this->add_rate($rate);
                }

                private function calculate($weight, $city_sender) {
                    if ($weight == 0) {
                        $weight = 1;
                    }

                    $request = [
                        "apiKey" => $this->settings['api_key'],
                        "modelName" => "InternetDocument",
                        "calledMethod" => "getDocumentPrice",
                        "methodProperties" => [
                            "CitySender" => $city_sender,
                            "CityRecipient" => WC()->customer->city,
                            "SeatsAmount" => 1,
                            "Weight" => $weight,
                            "Cost" => WC()->cart->subtotal,
                            "ServiceType" => "WarehouseWarehouse",
                            "PaymentMethod" => "Cash",
                            "CargoType" => "Cargo"
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
                    $result = file_get_contents($this->api_host, 0, $context);
                    $res = json_decode($result);

                    if ($res->success == 1) {
                        return $res->data[0]->Cost;
                    }
                    return 0;
                }

                public static function getCitiesByAreaCode($area) {

                    global $wpdb;
                    global $nova_poshta_db_name;

                    $res = $wpdb->get_results("Select * from " . $nova_poshta_db_name . " where type = 'City' and Area = '" . $area . "'");

                    foreach ($res as $val) {
                        $cities[$val->Ref] = $val->Description;
                    }

                    return $cities;
                }

                public function updateAreas() {
                    if(!is_admin()) {
                        return;
                    }
                    
                    if($this->settings['api_key'] == '' || empty($this->settings['api_key']) || !$this->settings['api_key']){
                        return;
                    }
                    
                    global $wpdb;
                    global $nova_poshta_db_name;
                    global $nova_poshta_upd_time_db_name;                    
                    
                    $res = $wpdb->get_row("SELECT * FROM " . $nova_poshta_upd_time_db_name . " WHERE type = 'Areas'");
                    
                    if(isset($res)) {
                        if((time() - $res->time) <= 2592000){
                            return;
                        }
                    }
                    
                    $request = [
                        "apiKey" => $this->settings['api_key'],
                        "modelName" => "Address",
                        "calledMethod" => "getAreas",
                        "methodProperties" => [
                            "" => ""
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
                    $result = file_get_contents($this->api_host, 0, $context);
                    $data = json_decode($result);

                    $wpdb->delete($nova_poshta_db_name, ['type' => 'Area'], ['%s']);
                    foreach ($data->data as $val) {
                        $wpdb->insert(
                                $nova_poshta_db_name, [
                            'type' => 'Area',
                            'Ref' => $val->Ref,
                            'Description' => $val->Description
                                ], [
                            '%s',
                            '%s',
                            '%s'
                                ]
                        );
                    }
                    $wpdb->insert(
                            $nova_poshta_upd_time_db_name, [
                        'type' => 'Areas',
                        'time' => time()
                            ], [
                        '%s',
                        '%d'
                            ]
                    );

                    $wpdb->delete($nova_poshta_db_name, ['type' => 'City'], ['%s']);
                    $request = [
                        "apiKey" => $this->settings['api_key'],
                        "modelName" => "Address",
                        "calledMethod" => "getCities",
                        "methodProperties" => [
                            "" => ""
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
                    $result = file_get_contents($this->api_host, 0, $context);
                    $data = json_decode($result);
                    foreach ($data->data as $val) {
                        $wpdb->insert(
                                $nova_poshta_db_name, [
                            'type' => 'City',
                            'Ref' => $val->Ref,
                            'Area' => $val->Area,
                            'Description' => $val->Description
                                ], [
                            '%s',
                            '%s',
                            '%s',
                            '%s'
                                ]
                        );
                    }
                    $wpdb->insert(
                        $nova_poshta_upd_time_db_name, [
                        'type' => 'Cities',
                        'time' => time()
                    ], [
                            '%s',
                            '%d'
                        ]
                    );
                    /* WareHouse */
                    $wpdb->delete($nova_poshta_db_name, ['type' => 'WareHouse'], ['%s']);
                    $request = [
                        "apiKey" => $this->settings['api_key'],
                        "modelName" => "Address",
                        "calledMethod" => "getWarehouses",
                        "methodProperties" => [
                            "" => ""
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
                    $result = file_get_contents($this->api_host, 0, $context);
                    $data = json_decode($result);
                    foreach ($data->data as $val) {
                        $wpdb->insert(
                            $nova_poshta_db_name, [
                            'type' => 'WareHouse',
                            'Ref' => $val->Ref,
                            'Area' => $val->CityRef,
                            'Description' => $val->Description
                        ], [
                                '%s',
                                '%s',
                                '%s',
                                '%s'
                            ]
                        );
                    }
                    /* // */

                    $wpdb->insert(
                            $nova_poshta_upd_time_db_name, [
                        'type' => 'WareHouses',
                        'time' => time()
                            ], [
                        '%s',
                        '%d'
                            ]
                    );
                    return;
                }    
            }               
        }
    }    
    
    global $wpdb;
    global $nova_poshta_db_name;
    global $nova_poshta_upd_time_db_name;
    $nova_poshta_db_name = $wpdb->prefix . 'nova_poshta_locations';
    $nova_poshta_upd_time_db_name = $wpdb->prefix . 'nova_poshta_update_locations';

    // function to create the DB / Options / Defaults					
    function nova_poshta_plugin_options_install() {
        global $wpdb;
        global $nova_poshta_db_name;
        global $nova_poshta_upd_time_db_name;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $wpdb->query("DROP TABLE IF EXISTS $nova_poshta_db_name"); 
        // create database table
        if ($wpdb->get_var("show tables like '$nova_poshta_db_name'") != $nova_poshta_db_name) {
            $sql = "CREATE TABLE " . $nova_poshta_db_name . " (id mediumint(9) NOT NULL AUTO_INCREMENT, type VARCHAR(10) NOT NULL COLLATE utf8_general_ci, Ref tinytext NOT NULL COLLATE utf8_general_ci, Area tinytext NOT NULL COLLATE utf8_general_ci, Description tinytext NOT NULL COLLATE utf8_general_ci, UNIQUE KEY id (id));";

            dbDelta($sql);
        }
        
        $wpdb->query("DROP TABLE IF EXISTS $nova_poshta_upd_time_db_name"); 
        // create database table
        if ($wpdb->get_var("show tables like '$nova_poshta_upd_time_db_name'") != $nova_poshta_upd_time_db_name) {
            $sql2 = "CREATE TABLE " . $nova_poshta_upd_time_db_name . " (id mediumint(9) NOT NULL AUTO_INCREMENT, type VARCHAR(10) NOT NULL COLLATE utf8_general_ci, time int(11) NOT NULL, UNIQUE KEY id (id));";

            dbDelta($sql2);
        }                
        return;            
    }

    // run the install scripts upon plugin activation
    register_activation_hook(__FILE__, 'nova_poshta_plugin_options_install');
    
    require plugin_dir_path(__FILE__) . 'hooks.php';
}


