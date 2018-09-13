jQuery(window).load(function(){  
    var el_cash_on_delivery = jQuery("#woocommerce_nova_poshta_shipping_method_enabled_cash_on_delivery");
    var type_shipping = el_cash_on_delivery.val();
    if(type_shipping == 'on_delivery'){
        jQuery("#woocommerce_nova_poshta_shipping_method_fixed_price").parent().parent().parent().hide();
    }
    
    el_cash_on_delivery.change(function (){        
        var el_fixed_price = jQuery("#woocommerce_nova_poshta_shipping_method_fixed_price")
        var change_value = jQuery(this).val();
        if(change_value == 'on_delivery'){
            el_fixed_price.parent().parent().parent().hide();
        } else {
            el_fixed_price.parent().parent().parent().show();
        }
    });

    jQuery("#woocommerce_nova_poshta_shipping_method_city").autocomplete({            
        source: function(request, response) {                
            jQuery.ajax({
                type: 'POST',
                url: ajaxurl,
                data:{
                    action: 'np_api_search_cities',
                    key: request.term
                },
                success: function(data) {
                    response(jQuery.map(data, function( item ) {
                        return {
                            label: item.name,
                            value: item.ref
                        }
                    }));                        
                } 
          })
        },
        focus: function( event, ui ) {
            jQuery("#woocommerce_nova_poshta_shipping_method_city").val(ui.item.label); 
            return false;
        },
        select: function( event, ui ) {
            jQuery("#woocommerce_nova_poshta_shipping_method_city").val(ui.item.label);
            jQuery("#woocommerce_nova_poshta_shipping_method_city2").val(ui.item.value);
            return false;
        }           
    });        
});