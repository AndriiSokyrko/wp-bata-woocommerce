<?php
/**
 * Shipping Calculator
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.8
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (get_option('woocommerce_enable_shipping_calc') === 'no' || !WC()->cart->needs_shipping()) {
    return;
}
?>

<?php do_action('woocommerce_before_shipping_calculator'); ?>

<form class="woocommerce-shipping-calculator" action="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" method="post">

    <p><a href="#" class="shipping-calculator-button"><?php _e('Calculate Shipping', 'woocommerce'); ?></a></p>

    <section class="shipping-calculator-form" style="display:none;">
        <input type="hidden" name="calc_shipping_country" id="calc_shipping_country" value="UA"/>
        <p class="form-row form-row-wide" id="calc_shipping_country_field">

        </p>

        <p class="form-row form-row-wide" id="calc_shipping_state_field">
            <?php
            $current_cc = WC()->customer->get_shipping_country();
            $current_r = WC()->customer->get_shipping_state();
            $states = WC()->countries->get_states($current_cc);

            // Hidden Input
            if (is_array($states) && empty($states)) {
                ?><input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e('State / county', 'woocommerce'); ?>" /><?php
                            // Dropdown Input
                        } elseif (is_array($states)) {
                            ?><span>
                                <select name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e('State / county', 'woocommerce'); ?>">
                                    <option value=""><?php _e('Select a state&hellip;', 'woocommerce'); ?></option>
                            <?php
                            foreach ($states as $ckey => $cvalue)
                                echo '<option value="' . esc_attr($ckey) . '" ' . selected($current_r, $ckey, false) . '>' . __(esc_html($cvalue), 'woocommerce') . '</option>';
                            ?>
                                </select>
                            </span><?php
                                    // Standard Input
                                } else {
                                    ?><input type="text" class="input-text" value="<?php echo esc_attr($current_r); ?>" placeholder="<?php _e('State / county', 'woocommerce'); ?>" name="calc_shipping_state" id="calc_shipping_state" /><?php
                            }
                                ?>
        </p>
        <hr/>		

            <?php
            if (apply_filters('woocommerce_shipping_calculator_enable_city', false)) :
                if ($current_r) {
                    $cities = WC_NovaPoshta_Shipping_Method::getCitiesByAreaCode($current_r);
                    $current_city = WC()->customer->city;
                }
                ?>
            <p class="form-row form-row-wide" id="calc_shipping_city_field">
                <span>
                    <select name="calc_shipping_city" id="calc_shipping_city" placeholder="<?php _e('City', 'woocommerce'); ?>">
                        <option value=""><?php _e('Select a city', 'woocommerce'); ?></option>
            <?php
            if ($cities) {
                foreach ($cities as $ckey => $cvalue)
                    echo '<option value="' . esc_attr($ckey) . '" ' . selected($current_city, $ckey, false) . '>' . __(esc_html($cvalue), 'woocommerce') . '</option>';
            }
            ?>
                    </select>
                </span>
            </p>
    <!--			<p class="form-row form-row-wide" id="calc_shipping_city_field">
                    <input type="text" class="input-text" value="<?php echo esc_attr(WC()->customer->get_shipping_city()); ?>" placeholder="<?php _e('City', 'woocommerce'); ?>" name="calc_shipping_city" id="calc_shipping_city" />
            </p>-->

<?php endif; ?>

<?php if (apply_filters('woocommerce_shipping_calculator_enable_postcode', true)) : ?>

            <p class="form-row form-row-wide" id="calc_shipping_postcode_field">
                <input type="text" class="input-text" value="<?php echo esc_attr(WC()->customer->get_shipping_postcode()); ?>" placeholder="<?php _e('Postcode / Zip', 'woocommerce'); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
            </p>

        <?php endif; ?>

        <p><button type="submit" name="calc_shipping" value="1" class="button"><?php _e('Update Totals', 'woocommerce'); ?></button></p>

<?php wp_nonce_field('woocommerce-cart'); ?>
    </section>
</form>

<script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    jQuery(function ($) {
        $(window).load(function () {
            $(document).on('change', '#calc_shipping_state', function () {
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'np_api_get_cities_by_area',
                        area: $(this).val()
                    },
                    success: function (data) {
                        $('#calc_shipping_city')
                                .find('option')
                                .remove();

                        $('#calc_shipping_city')
                                .append($("<option></option>")
                                        .attr("value", '')
                                        .text('<?php _e('Select a city', 'woocommerce'); ?>')
                                        );

                        var obj = JSON.parse('"' + data + '"');

                        $.each(data, function (key, value) {
                            $('#calc_shipping_city')
                                    .append($("<option></option>")
                                            .attr("value", key)
                                            .text(value)
                                            );
                        });
                    }
                });
                if (!$(this).val() || $(this).val() == '') {
                    $('#calc_shipping_city_field').hide('slow');
                } else {
                    $('#calc_shipping_city_field').show('slow');
                }
                return false;
            });
            if ($('#calc_shipping_state').val() == '') {
                $('#calc_shipping_city_field').hide();
            }
        });
    });
</script>
<?php do_action('woocommerce_after_shipping_calculator'); ?>
