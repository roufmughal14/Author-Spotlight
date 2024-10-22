function author_spotlight_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'id' => 0,
    ), $atts, 'author_spotlight' );

    $author_id = intval( $atts['id'] );
    if ( ! $author_id ) {
        return 'Author ID is required.';
    }

    $author = get_userdata( $author_id );
    if ( ! $author ) {
        return 'Invalid author ID.';
    }

    $first_name = $author->first_name;
    $last_name = $author->last_name;
    $author_avatar = get_avatar( $author_id, 96 );
    $author_bio = get_user_meta( $author_id, 'description', true );

    $recent_posts = new WP_Query( array(
        'author' => $author_id,
        'posts_per_page' => 3,
    ) );

    $total_posts = count_user_posts( $author_id );

    $total_comments = get_comments( array(
        'user_id' => $author_id,
        'count' => true,
    ) );

    $twitter = get_user_meta( $author_id, 'twitter', true );
    $facebook = get_user_meta( $author_id, 'facebook', true );
    $linkedin = get_user_meta( $author_id, 'linkedin', true );

    ob_start();
    ?>
	<style>
		.author-spotlight {
			border: 1px solid #ddd;
			padding: 20px;
			margin-bottom: 20px;
			background-color: #f9f9f9;
		}

		.author-info {
			text-align: center;
			margin-bottom: 20px;
		}

		.author-avatar img {
			border-radius: 50%;
		}

		.author-name {
			font-size: 24px;
			margin-top: 10px;
		}

		.author-bio {
			font-size: 16px;
			color: #666;
		}

		.author-recent-posts h3 {
			padding-bottom: 20px;
		}

		.author-recent-posts ul {
			list-style-type: none;
			padding: 0;
			display: flex;
			justify-content: space-between;
		}

		.author-recent-posts li {
			width: 32%;
			background: #f9f9f9;
			border-radius: 10px;
			border: 1px solid #666666;
			padding: 20px;
		}

		.author-recent-posts .author-post-title {
			font-weight: bold;
			color: #000000;
			font-size: 20px;
			line-height: 1.3;
		}
		
		.author-recent-posts .author-post-title:hover {
			color: #0000FF;
		}

		.author-recent-posts p {
			line-height: 1.5;
			margin-top: 15px;
			margin-bottom: 15px;
		}

		.author-recent-posts .author-post-read-more {
			color: #000000;
		}
		
		.author-recent-posts .author-post-read-more:hover {
			color: #0000FF;
		}

		.author-stats {
			padding-top: 20px;
		}

		.author-social-links {
			text-align: center;
			padding-bottom: 20px;
		}

		.author-social-links a {
			padding: 2px;
		}

		.author-social-links a i {
			background: #0000FF;
			color: #ffffff;
			padding: 10px;
			font-size: 18px;
			border-radius: 50%;
		}
	</style>
    <div class="author-spotlight">
        <div class="author-info">
            <div class="author-avatar"><?php echo $author_avatar; ?></div>
            <h2 class="author-name"><?php echo esc_html( $first_name ) . ' ' . esc_html( $last_name ); ?></h2>
            <p class="author-bio"><?php echo esc_html( $author_bio ); ?></p>
        </div>
		
		<?php if ( $twitter || $facebook || $linkedin ) : ?>
			<div class="author-social-links">
				<?php if ( $twitter ) : ?>
					<a href="<?php echo esc_url( $twitter ); ?>" target="_blank">
						<i class="fa fa-twitter"></i>
					</a>
				<?php endif; ?>
				<?php if ( $facebook ) : ?>
					<a href="<?php echo esc_url( $facebook ); ?>" target="_blank">
						<i class="fa fa-facebook"></i>
					</a>
				<?php endif; ?>
				<?php if ( $linkedin ) : ?>
					<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank">
						<i class="fa fa-linkedin"></i>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>

        <div class="author-recent-posts">
            <h3>Recent 3 Posts</h3>
            <ul>
                <?php if ( $recent_posts->have_posts() ) : ?>
                    <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" class="author-post-title"><?php the_title(); ?></a>
                            <p><?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="author-post-read-more">Read More</a>
                        </li>
                    <?php endwhile; ?>
                <?php else : ?>
                    <li>No recent posts.</li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="author-stats">
            <p>Total Posts: <?php echo esc_html( $total_posts ); ?></p>
            <p>Total Comments: <?php echo esc_html( $total_comments ); ?></p>
        </div>
    </div>
    <?php
    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode( 'author_spotlight', 'author_spotlight_shortcode' );
