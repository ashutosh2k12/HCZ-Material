
    <nav class="menu list-group">
    <div class="list-group">
    <div class="list-group-item">
    <?php if ( false != get_theme_mod( 'material_logo')) : ?>
      <div class="row-picture">
        <a class="blog-logo" href='<?php echo esc_url( home_url( '/' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'material_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
        
      </div>
    <?php endif; ?>
      <div class="row-content">
        <div class="navbar-header pull-right">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <i class="fa fa-2x fa-bars"></i>
          </button>
        </div>
        <h4 class="list-group-item-heading"><?php echo apply_filters('material_theme_mods','material_name'); ?></h4>
        <p class="list-group-item-text"><?php echo apply_filters('material_theme_mods','material_designation'); ?></p>
       </div>
        <div class="social-icons">
            <?php if ( false != get_theme_mod( 'material_social_youtube')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_youtube') ); ?>">
                    <i class="fa fa-youtube"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_tumblr')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_tumblr') ); ?>">
                    <i class="fa fa-tumblr"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_instagram')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_instagram') ); ?>">
                    <i class="fa fa-instagram"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_google')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_google') ); ?>">
                    <i class="fa fa-google-plus"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_facebook')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_facebook') ); ?>">
                    <i class="fa fa-facebook"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_twitter')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_twitter' ) ); ?>">
                    <i class="fa fa-twitter"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_website')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_website') ); ?>">
                    <i class="fa fa-home"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_mail')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( 'mailto:' . get_theme_mod( 'material_social_mail') ); ?>">
                    <i class="fa fa-envelope"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_linkedin')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_linkedin') ); ?>">
                    <i class="fa fa-linkedin"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_github')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_github') ); ?>">
                    <i class="fa fa-github-alt"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_bitbucket')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_bitbucket') ); ?>">
                    <i class="fa fa-bitbucket"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_stack_overflow')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_stack_overflow') ); ?>">
                    <i class="fa fa-stack-overflow"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_dribbble')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_dribbble') ); ?>">
                    <i class="fa fa-dribbble"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_behance')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_behance') ); ?>">
                    <i class="fa fa-behance"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_rss')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_rss') ); ?>">
                    <i class="fa fa-feed"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_codepen')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_codepen') ); ?>">
                    <i class="fa fa-codepen"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_deviantart')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_deviantart') ); ?>">
                    <i class="fa fa-deviantart"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_flickr')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_flickr') ); ?>">
                    <i class="fa fa-flickr"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_lastfm')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_lastfm') ); ?>">
                    <i class="fa fa-lastfm"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_soundcloud')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_soundcloud') ); ?>">
                    <i class="fa fa-soundcloud"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_spotify')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_spotify') ); ?>">
                    <i class="fa fa-spotify"></i>
                </a>
            <?php } ?>
            <?php if ( false != get_theme_mod( 'material_social_skype')) { ?>
                <a class="icon" target="_blank" href="<?php echo esc_url( get_theme_mod( 'material_social_skype') ); ?>">
                    <i class="fa fa-skype"></i>
                </a>
            <?php } ?>
        </div>
    </div>
    
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <?php
         
        wp_nav_menu( array( 
            'theme_location' => 'primary',
            'items_wrap' => '<ul id="%1$s" class="nav navbar-nav list-separator well well-primary default %2$s">%3$s</ul>',
            'menu_class' => 'nav-menu',
            'walker' => new Walker_Material_Menu()
             ) ); 
        

        /*
        wp_nav_menu( array(
                        'menu_class'     => 'nav-menu',
                        'theme_location' => 'primary',
                    ) );
        */
    ?>
    
    </div>
    </nav>

