<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */
?>
<div class="woocommerce-billing-fields">
	<?php if ( WC()->cart->ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3><?php _e( 'Billing Details', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<?php foreach ( $checkout->checkout_fields['billing'] as $key => $field ) : ?>
                <?php 
                if($key == 'billing_city') {
                    $current_r = WC()->customer->get_shipping_state();
                    if ($current_r) {
                        $cities = WC_NovaPoshta_Shipping_Method::getCitiesByAreaCode($current_r);
                        $current_city = WC()->customer->city;
                    }
                    
                ?>
                    
                    <p class="form-row form-row-wide" id="billing_city_field">
                        <label class="" for="billing_state"><?php _e('City', 'woocommerce'); ?><abbr title="required" class="required">*</abbr></label>
                        <span>
                            <select name="billing_city" id="billing_city" placeholder="<?php _e('City', 'woocommerce'); ?>">
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
                    
                    
                    <?php
                    continue;
                }
                ?>
		<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

	<?php endforeach; ?>

	<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>

	<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

		<?php if ( $checkout->enable_guest_checkout ) : ?>

			<p class="form-row form-row-wide create-account">
				<input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'woocommerce' ); ?></label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

			<div class="create-account">

				<p><?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce' ); ?></p>

				<?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

				<?php endforeach; ?>

				<div class="clear"></div>

			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

	<?php endif; ?>
</div>

<script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    
    jQuery(function ($) {
        $(window).load(function () {
            $("#billing_city").autocomplete({            
                source: function(request, response) {                
                    $.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data:{
                            action: 'np_api_search_cities',
                            key: request.term
                        },
                        success: function(data) {
                            response($.map(data, function( item ) {
                                return {
                                    label: item.name,
                                    value: item.ref
                                }
                            }));                        
                        } 
                  })
                },
                focus: function( event, ui ) {
                    $("#billing_city").val(ui.item.label); 
                    return false;
                },
                select: function( event, ui ) {
                    $("#billing_city").val(ui.item.label);
//                    $("#billing_city2").val(ui.item.value);
                    return false;
                }           
            });    
            
            $(document).on('change', '#billing_state', function () {
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'np_api_get_cities_by_area',
	                    typeElem: 'City',
                        area: $(this).val()
                    },
                    success: function (data) {
                        $('#billing_city')
                                .find('option')
                                .remove();

                        $('#billing_city')
                                .append($("<option></option>")
                                        .attr("value", '')
                                        .text('<?php _e('Select a city', 'woocommerce'); ?>')
                                        );

                        var obj = JSON.parse('"' + data + '"');

                        $.each(data, function (key, value) {
                            $('#billing_city')
                                    .append($("<option></option>")
                                            .attr("value", key)
                                            .text(value)
                                            );
                        });
                    }
                });        
                $( 'body' ).trigger( 'update_checkout' );
                return false;
            });
            
            $(document).on('change', '#billing_city', function () {
			/* for warehouse */
	            $.ajax({
		            type: 'POST',
		            url: ajaxurl,
		            data: {
			            action: 'np_api_get_cities_by_area',
			            typeElem:'WareHouse',
			            area:  $('#billing_city option:selected').val()
		            },
		            success: function (data) {
//			            console.log( $('#billing_city option:selected').val());
			            $('#billing_np_number')
				            .find('option')
				            .remove();

			            $('#billing_np_number')
				            .append($("<option></option>")
					            .attr("value", '')
					            .text('<?php _e('Select a warehouse', 'woocommerce'); ?>')
				            );

			            var obj = JSON.parse('"' + data + '"');

			            $.each(data, function (key, value) {
				            $('#billing_np_number')
					            .append($("<option></option>")
						            .attr("value", value)
						            .text(value)
					            );
			            });


			            $.ajax({
				            type: 'POST',
				            url: ajaxurl,
				            data: {
					            action: 'np_api_getPostIndex',
					            ref:  $('#billing_city option:selected').text()
				            },
				            success: function (data) {
                            console.log(data);
					            $.each(data, function (key, value) {
//						            console.log(value);
 						            $('#billing_postcode').val(value['PostCode'] );
					            })

				            }
			            });

		            }
	            });
	            /* // */
                $( 'body' ).trigger( 'update_checkout' );
                return false;
            });

	        $(document).on('change', '#billing_np_number', function () {


	        });


        });
    });    
</script>
