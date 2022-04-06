<?php if ( 'true' === get_option( 'theme_display_social_share', 'true' ) ) : ?>
    <div class="share-networks clearfix">
        <span class="share-label"><?php esc_html_e( 'Share this', 'framework' ); ?></span>
        <span><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fab fa-facebook fa-lg"></i><?php esc_html_e( 'Facebook', 'framework' ); ?></a></span>
        <span><a target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>"><i class="fab fa-twitter fa-lg"></i><?php esc_html_e( 'Twitter', 'framework' ); ?></a></span>
        <span><a target="_blank" href="https://api.whatsapp.com/send?text=<?php echo get_the_title() . '&nbsp;' . get_the_permalink(); ?>"><i class="fab fa-whatsapp"></i><?php esc_html_e( 'WhatsApp', 'framework' ); ?></a></span>
		<?php if ( 'true' === get_option( 'realhomes_line_social_share', 'false' ) ) : ?>
            <span><a target="_blank" href="https://social-plugins.line.me/lineit/share?url=<?php the_permalink(); ?>"><i class="fab fa-line fa-lg"></i><?php esc_html_e( 'Line', 'framework' ); ?></a></span>
		<?php endif; ?>
    </div>
<?php endif; ?>