<?php if( sandbox_comments() ) : ?>
			<section id="comments">
<?php
	if ( post_password_required() ) :
?>
				<div class="nopassword"><?php _e( 'This post is protected. Enter the password to view any comments.', 'sandbox' ) ?></div>
			</section><!-- .comments -->
<?php
		return;
	endif;
?>
<?php if ( have_comments() ) : ?>
				<h3><?php comments_number(__('No Responses', 'sandbox'), __('One Respond', 'sandbox'), __('% Responses' , 'sandbox'));?></h3>
				<section id="comments-list" class="comments">
					<?php 
						if( sandbox_trackbacks() ):
							wp_list_comments( 'style=div' );
						else:
							wp_list_comments( 'type=comment&style=div' );
						endif;
					?>
					<nav id="nav-comments" class="navigation">
						<div class="nav-previous"><?php previous_comments_link() ?></div>
						<div class="nav-next"><?php next_comments_link() ?></div>
					</nav>
				</section><!-- #comments-list .comments -->
<?php endif // REFERENCE: if ( have_comments() ) ?>
<?php if ( comments_open() ) : ?>
				<section id="respond">
					<?php comment_form(); ?>
				</section><!-- #respond -->
<?php endif // REFERENCE: if ( comments_open() ) ?>
			</section><!-- #comments -->
<?php endif // REFERENCE: if ( sandbox_comments() ) ?>
