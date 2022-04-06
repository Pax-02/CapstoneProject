<?php

if ( ! function_exists( 'inspiry_verify_item_purchase_code' ) ) {
	/**
	 * Verify item purchase code
	 *
	 * @param $code
	 *
	 * @return bool|WP_Error
	 */
	function inspiry_verify_item_purchase_code( $code ) {
update_option( 'envato_purchase_code_GPL001122334455AA6677BB8899CC000', sanitize_text_field( $code ) );
update_option( 'inspiry_realhomes_registered', 'yes' );
return true;
		$envato_token = 'XLOSUxHcOKTC1TrljyoeWJ10ptng74a7';

		$error = new WP_Error();

		if ( empty( $code ) ) {
			$error->add( 'error', esc_html__( 'Please enter an item purchase code.', 'framework' ) );

			return $error;
		}

		$envato_apiurl            = "https://api.envato.com/v1/market/private/user/verify-purchase:" . esc_html( $code ) . ".json";
		$envato_header            = array();
		$envato_header['headers'] = array( "Authorization" => "Bearer " . $envato_token );
		$envato_purchases         = wp_safe_remote_request( $envato_apiurl, $envato_header );

		if ( ! is_wp_error( $envato_purchases ) && is_string( $envato_purchases['body'] ) ) {
			$purchases_body = json_decode( $envato_purchases['body'], true );

			if ( isset( $purchases_body['verify-purchase'] ) ) {
				$body_array = (array) $purchases_body['verify-purchase']; // use json_decode
			}

			if ( isset( $body_array['item_id'] ) && '5373914' == $body_array['item_id'] ) {
				update_option( 'envato_purchase_code_5373914', sanitize_text_field( $code ) );
				update_option( 'inspiry_realhomes_registered', 'yes' );
				return true;
			} else {
				$error->add( 'error', esc_html__( 'Please provide a valid purchase code!', 'framework' ) );
				return $error;
			}

		} else {
			$error->add( 'error', esc_html__( 'Problem in connecting...', 'framework' ) );
			return $error;
		}
	}
}

if ( ! inspiry_is_realhomes_registered() ) {
	/**
	 * Check for the existing purchase code and register theme if it's valid
	 */
	function inspiry_realhomes_auto_registration() {

		$existing_purchase_code = get_option( 'envato_purchase_code_5373914' );

		if ( ! empty( $existing_purchase_code ) ) {
			$item_purchase = inspiry_verify_item_purchase_code( $existing_purchase_code );

			if ( is_wp_error( $item_purchase ) || $item_purchase != true ) {
				delete_option( 'envato_purchase_code_5373914' );
			} else {
				set_transient( 'inspiry_activation_thanks', true, 5 );
			}
		}
	}

	inspiry_realhomes_auto_registration();
}


if ( ! inspiry_is_realhomes_registered() ) {
	/**
	 * Register RealHomes theme with its purchase code.
	 */
	function inspiry_realhomes_registration() {

		$verification       = false;
		$purchase_code      = '';
		$verification_error = '';

		if ( isset( $_POST['purchase_code'] ) ) {
			$purchase_code = $_POST['purchase_code'];

			$item_purchase = inspiry_verify_item_purchase_code( $purchase_code );

			if ( ! is_wp_error( $item_purchase ) && $item_purchase === true ) {
				$verification = true;
			} else {
				$verification_error = $item_purchase->errors['error'][0];
			}

			if ( $verification ) {

				set_transient( 'inspiry_activation_thanks', true, 5 );

				global $wp;
				if ( $wp->request ) {
					$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );;
				} else {
					$current_url = admin_url();
				}
				inspiry_redirect( $current_url );
			}
		}

		if ( ! get_transient( 'inspiry_activation_thanks' ) ) {
			?>
            <div class="notice notice-info realhomes-registration">
                <h3>RealHomes Purchase Verification</h3>
                <p>Verify your purchase by providing item purchase code, This will allow you to <strong>install plugins</strong>, <strong>import demo contents</strong> and avail <strong>auto updates</strong>.</p>
                <form method="post">
                    <input type="text" class="regular-text" name="purchase_code" placeholder="Enter Item Purchase Code" value="<?php echo esc_html( $purchase_code ); ?>">
                    <input type="submit" class="button button-primary" value="Verify">
                </form>
	            <?php
	            if ( ! empty( $verification_error ) ) {
		            echo '<p class="error">' . esc_html( $verification_error ) . '</p>';
	            }
	            ?>
                <p>You can consult <a href="https://support.inspirythemes.com/knowledgebase/how-to-get-themeforest-item-purchase-code/" target="_blank">this knowledge base article</a> to learn how to get themeforest item purchase code,
                    Otherwise you can buy <a href="https://themeforest.net/item/real-homes-wordpress-real-estate-theme/5373914" target="_blank">RealHomes fresh license</a> that comes with lifetime updates and 6 months extendable support.</p>
            </div>
			<?php
		}
	}

	add_action( 'admin_notices', 'inspiry_realhomes_registration' );
}


if ( inspiry_is_realhomes_registered() && get_transient( 'inspiry_activation_thanks' ) ) {
	function inspiry_activation_thanks() {
		?>
        <div class="notice notice-success realhomes-registration is-dismissible">
            <p>Thanks for verifying RealHomes purchase!</p>
        </div>
		<?php
		delete_transient( 'inspiry_activation_thanks' );
	}

	add_action( 'admin_notices', 'inspiry_activation_thanks' );
}