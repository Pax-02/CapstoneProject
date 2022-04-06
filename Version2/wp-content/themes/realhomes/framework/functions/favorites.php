<?php
/**
 *  This file contains functions related to add to favorites feature
 */


if ( ! function_exists( 'add_to_favorite' ) ) {
	/**
	 * Add a property to favorites
	 */
	function add_to_favorite() {

		/* if user is logged in then store in meta data */
		if ( isset( $_POST['property_id'] ) && is_user_logged_in() ) {
			$property_id = intval( $_POST['property_id'] );
			$user_id     = get_current_user_id();
			if ( ( $property_id > 0 ) && ( $user_id > 0 ) ) {
				if ( add_user_meta( $user_id, 'favorite_properties', $property_id ) ) {
					_e( 'Added to Favorites', 'framework' );
				} else {
					_e( 'Failed!', 'framework' );
				}
			}
			/* otherwise store in cookies */
		} elseif ( isset( $_POST['property_id'] ) ) {
			$property_id = intval( $_POST['property_id'] );
			if ( $property_id > 0 ) {
				$inspiry_favorites = array();
				if ( isset( $_COOKIE['inspiry_favorites'] ) ) {
					$inspiry_favorites = unserialize( $_COOKIE['inspiry_favorites'] );
				}
				$inspiry_favorites[] = $property_id;
				if ( setcookie( 'inspiry_favorites', serialize( $inspiry_favorites ), time() + ( 60 * 60 * 24 * 30 ), '/' ) ) {
					_e( 'Added to Favorites', 'framework' );
				} else {
					_e( 'Failed!', 'framework' );
				}
			}

		} else {
			_e( 'Invalid Parameters!', 'framework' );
		}

		die;
	}

	add_action( 'wp_ajax_add_to_favorite', 'add_to_favorite' );
	add_action( 'wp_ajax_nopriv_add_to_favorite', 'add_to_favorite' );
}


if ( ! function_exists( 'is_added_to_favorite' ) ) {
	/**
	 * Check if a property is already added to favorites
	 *
	 * @param $property_id
	 * @param $user_id
	 *
	 * @return bool
	 */
	function is_added_to_favorite( $property_id, $user_id = 0 ) {

		if ( $property_id > 0 ) {

			/* if user id is not provided then try to get current user id */
			if ( ! $user_id ) {
				$user_id = get_current_user_id();
			}

			if ( $user_id > 0 ) {
				/* if logged in check in database */
				global $wpdb;
				$results = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->usermeta} WHERE meta_key= %s AND meta_value= %s AND user_id= %s", 'favorite_properties', $property_id, $user_id ) );
				if ( isset( $results[0]->meta_value ) && ( $results[0]->meta_value == $property_id ) ) {
					return true;
				}
			} else {
				/* if not logged in check in cookies */
				if ( isset( $_COOKIE['inspiry_favorites'] ) ) {
					$inspiry_favorites = unserialize( $_COOKIE['inspiry_favorites'] );
					if ( in_array( $property_id, $inspiry_favorites ) ) {
						return true;
					}
				}
			}
		}

		return false;
	}
}


if ( ! function_exists( 'remove_from_favorites' ) ) {
	/**
	 * Remove from favorites
	 */
	function remove_from_favorites() {
		if ( isset( $_POST['property_id'] ) ) {
			$property_id = intval( $_POST['property_id'] );
			if ( $property_id > 0 ) {

				if ( is_user_logged_in() ) {
					$user_id = get_current_user_id();

					if ( delete_user_meta( $user_id, 'favorite_properties', $property_id ) ) {
						echo json_encode( array(
								'success' => true,
								'message' => esc_html__( "Removed Successfully!", 'framework' )
							)
						);
						die;
					} else {
						echo json_encode( array(
								'success' => false,
								'message' => esc_html__( "Failed to remove!", 'framework' )
							)
						);
						die;
					}
				} else {
					if ( isset( $_COOKIE['inspiry_favorites'] ) ) {
						$inspiry_favorites = unserialize( $_COOKIE['inspiry_favorites'] );
						$target_index      = array_search( $property_id, $inspiry_favorites );
						if ( $target_index >= 0 && $target_index !== false ) {
							unset( $inspiry_favorites[ $target_index ] );
							setcookie( 'inspiry_favorites', serialize( $inspiry_favorites ), time() + ( 60 * 60 * 24 * 30 ), '/' );
							echo json_encode( array(
									'success' => true,
									'message' => esc_html__( "Removed Successfully!", 'framework' )
								)
							);
							die;
						} else {
							echo json_encode( array(
									'success' => false,
									'message' => esc_html__( "Failed to remove!", 'framework' )
								)
							);
							die;
						}
					}
				}
			}
		}

		echo json_encode( array(
				'success' => false,
				'message' => esc_html__( "Invalid Parameters!", 'framework' )
			)
		);

		die;
	}

	add_action( 'wp_ajax_remove_from_favorites', 'remove_from_favorites' );
	add_action( 'wp_ajax_nopriv_remove_from_favorites', 'remove_from_favorites' );
}


if ( ! function_exists( 'inspiry_import_favorites' ) ) :
	function inspiry_import_favorites( $user_login, $user ) {

		if ( isset( $_COOKIE['inspiry_favorites'] ) ) {
			$favorites_in_cookies = unserialize( $_COOKIE['inspiry_favorites'] );
			if ( 0 < count( $favorites_in_cookies ) ) {
				foreach ( $favorites_in_cookies as $favorited_id ) {
					if ( ! is_added_to_favorite( $favorited_id, $user->ID ) ) {
						add_user_meta( $user->ID, 'favorite_properties', $favorited_id );
					}
				}
				// clear cookies
				setcookie( 'inspiry_favorites', serialize( array( 0 ) ), time() - ( 60 * 60 ), '/' );
			}
		}
	}

	add_action( 'wp_login', 'inspiry_import_favorites', 10, 2 );
endif;

if ( ! function_exists( 'inspiry_favorite_button' ) ) {
	/**
	 * Display 'Add to Favorite' button
	 *
	 * @param null $property_id
	 * @param bool $single
     * @param string $ele_add_label Elementor Label Option Add To Favourite
     * @param string $ele_added_label Elementor Label Option Added To Favourite
	 */
	function inspiry_favorite_button( $property_id = null, $single = false, $ele_add_label = '' , $ele_added_label = '') {

		$fav_button = get_option( 'theme_enable_fav_button' );

		if ( 'true' === $fav_button ) {

			$require_login                       = get_option( 'inspiry_login_on_fav', 'no' );
			$inspiry_add_to_fav_property_label   = get_option( 'inspiry_add_to_fav_property_label' );
			$inspiry_added_to_fav_property_label = get_option( 'inspiry_added_to_fav_property_label' );

			if(!empty($ele_add_label)){
			    $add_label = $ele_add_label;
            }elseif($inspiry_add_to_fav_property_label){
				$add_label = $inspiry_add_to_fav_property_label;
            }else{
				$add_label = __( 'Add to favorites', 'framework' );
            }

			if(!empty($ele_added_label)){
			    $added_label = $ele_added_label;
            }elseif($inspiry_added_to_fav_property_label){
				$added_label = $inspiry_added_to_fav_property_label;
            }else{
				$added_label = __( 'Added to favorites', 'framework' );
            }

			if ( ( is_user_logged_in() && 'yes' == $require_login ) || ( 'yes' != $require_login ) ) {

				if ( $property_id === null ) {
					$property_id = get_the_ID();
				}

				if ( is_added_to_favorite( $property_id ) ) {

					if ( $single ) {
						?>
                        <span class="favorite-placeholder highlight__red">
                            <?php inspiry_safe_include_svg( '/images/icons/icon-favorite.svg' ); ?>
                            <span class="rh_tooltip">
                                <p class="label">
                                     <?php
                                     echo esc_html($added_label);
                                     ?>
                                </p>
                            </span>
                        </span>
						<?php
					} else {
						?>
                        <span class="favorite-placeholder highlight__red" data-tooltip="<?php echo esc_attr($added_label);?>">
                            <?php inspiry_safe_include_svg( '/images/icons/icon-favorite.svg' ); ?>
                        </span>
						<?php
					}

				} else {
					if ( $single ) {
						?>
                        <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
                              method="post" class="add-to-favorite-form">
                            <input type="hidden" name="property_id"
                                   value="<?php echo esc_attr( $property_id ); ?>"/>
                            <input type="hidden" name="action" value="add_to_favorite"/>
                        </form>
                        <span class="favorite-placeholder highlight__red hide">
                            <?php inspiry_safe_include_svg( '/images/icons/icon-favorite.svg' ); ?>
                            <span class="rh_tooltip">
                                <p class="label">
                                    <?php
                            echo esc_html($added_label);
                                    ?>
                                </p>
                            </span>
                        </span>
                        <a href="#" class="favorite add-to-favorite">
							<?php inspiry_safe_include_svg( '/images/icons/icon-favorite.svg' ); ?>
                            <span class="rh_tooltip">
                                <p class="label">
                                    <?php
                                    echo esc_html($add_label);
                                    ?>
                                </p>
                            </span>
                        </a>
						<?php
					} else {
						?>
                        <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post"
                              class="add-to-favorite-form">
                            <input type="hidden" name="property_id" value="<?php echo esc_attr( $property_id ); ?>"/>
                            <input type="hidden" name="action" value="add_to_favorite"/>
                        </form>
                        <span class="favorite-placeholder highlight__red hide"
                              data-tooltip="<?php echo esc_html($added_label);?>">
                            <?php inspiry_safe_include_svg( '/images/icons/icon-favorite.svg' ); ?>
                        </span>
                        <a href="#" class="favorite add-to-favorite"
                           data-tooltip="<?php echo esc_html($add_label);?>">
							<?php inspiry_safe_include_svg( '/images/icons/icon-favorite.svg' ); ?>
                        </a>
						<?php
					}
				}
			} else {

				$theme_login_url    = inspiry_get_login_register_url(); // login and register page URL

                if ( $single ) {
                    ?>
                    <a href="#" class="favorite add-to-favorite require-login" data-login="<?php echo esc_url( $theme_login_url ); ?>">
                        <?php inspiry_safe_include_svg( '/images/icons/icon-favorite.svg' ); ?>
                        <span class="rh_tooltip">
                        <p class="label">
                            <?php
                            echo esc_html($add_label);
                            ?>
                        </p>
                    </span>
                    </a>
                    <?php
                } else {
                    ?>
                    <a href="#" class="favorite add-to-favorite require-login"
                       data-tooltip="<?php echo esc_attr($add_label); ?>"
                       data-login="<?php echo esc_url( $theme_login_url ); ?>">
                        <?php inspiry_safe_include_svg( '/images/icons/icon-favorite.svg' ); ?>
                    </a>
                    <?php
                }

			}
		}
	}
}