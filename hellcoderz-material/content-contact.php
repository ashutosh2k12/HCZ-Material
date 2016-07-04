<h2 class="blog-title-pro"><?php the_title(); ?></h2>
<div class="well">
    <div>
    <?php if( false != get_theme_mod( 'material_contact_mob') || false != get_theme_mod( 'material_contact_address') || false != get_theme_mod( 'material_contact_mails') ): ?>
    	<div class="content-container-pro">

                <div class="width-container text-center">
                	<?php if( false != get_theme_mod( 'material_contact_mob')): ?>
                    <div class="col-md-4 col-xs-12 contact-info">

                        <span class="contact-icon"><i class="fa fa-phone"></i></span>
                        <div class="contact-detail">Phone</div>
                        <?php foreach (array_filter(explode("|",get_theme_mod( 'material_contact_mob')),'trim') as $phone) : ?>
                        <div class="contact-byline"><?php echo $phone; ?></div>
                    	<?php endforeach; ?>
                    </div>
                	<?php endif; ?>
                	<?php if( false != get_theme_mod( 'material_contact_address')): ?>
                    <div class="col-md-4 col-xs-12 contact-info">

                        <span class="contact-icon"><i class="fa fa-map-marker"></i></span>
                        <div class="contact-detail">Location</div>
                        <div class="contact-byline"><?php echo get_theme_mod( 'material_contact_address'); ?></div>

                    </div>
                    <?php endif; ?>
                	<?php if( false != get_theme_mod( 'material_contact_mails')): ?>
                    <div class="col-md-4 col-xs-12 contact-info">

                        <span class="contact-icon"><i class="fa fa-envelope-o"></i></span>
                        <div class="contact-detail">Email</div>
                        <?php foreach (array_filter(explode("|",get_theme_mod( 'material_contact_mails')),'trim') as $email) : ?>
                        <div class="contact-byline"><?php echo $email; ?></div>
                    	<?php endforeach; ?>

                    </div>
                	<?php endif; ?>
                    <div class="clearfix"></div>
                    <hr>
                </div>          

        </div>
    <?php endif; ?>
    <?php the_content(); ?>
    </div>
</div>