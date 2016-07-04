<?php 
$resume = &$this->parent;
$template = &$resume->templating;
$options = $resume->options->get_options();

?>
<article <?php post_class(); ?>>
		<div class="hresume width-container" itemscope itemtype="http://schema.org/Person">
			<div id="bar"> </div>
			<div class="row">
			<!-- //Add image here if you prefer
			<div class="col-md-3 col-xs-6">
          		<img src="images/resumepic.jpg" width="200" height="200">
          	</div>
          	-->
          	<div class="col-md-12 col-xs-12 text-center">
			<header class="vcard">
				<h2 class="fn n url" id="name" itemprop="name">
					<?php echo $template->get_name(); ?>
				</h2>
				<div class="row">
				<ul>
					<?php //loop through contact info fields
					$contact_info = $template->get_contact_info();
					if ( !empty( $contact_info ) ) {
						$addr = isset($contact_info['adr']) & !empty( $contact_info['adr'] ) ? $contact_info['adr'] : array();
						if ( !empty($addr) )  $contact_info['adr'] = $template->contact_info_sort_adr($contact_info);
						$addr = $contact_info['adr'];
						if( $addr ) : 
							?><li <?php $template->contact_info_itemprop( 'adr' ); ?> style="display:block;"><?php
							foreach ($addr as $field => $adr) {
						?>
								<span <?php $template->contact_info_itemprop( $field ); ?>><?php echo $adr; ?></span>
						<?php
							} ?>
							</li>
						<?php 
						endif;
						?>
				
						<?php 
						foreach ( $contact_info as $field => $value) { ?>
						<?php 
							//per hCard specs (http://microformats.org/profile/hcard) adr needs to be an array
							if ( is_array( $value ) ) { 
							if( $field != 'adr' ) { ?>
							<li id="<?php echo $field; ?>" <?php $template->contact_info_itemprop( $field ); ?>>
								<?php foreach ($value as $subfield => $subvalue) { ?>
									<span class="<?php echo $subfield; ?>" <?php $template->contact_info_itemprop( $subfield ); ?>><?php echo $subvalue; ?></span>
								<?php } ?>
							</li>
						<?php } } elseif ($field == 'email') { ?>
							<li><span><a href="mailto:<?php echo $value; ?>" class="<?php echo $field; ?>" <?php $template->contact_info_itemprop( $field ); ?>><?php echo $value; ?></a></span></li>
						<?php } else { ?>
							<li><span class="<?php echo $field; ?>" <?php $template->contact_info_itemprop( $field ); ?>><?php echo $value; ?></span></li>
						<?php } ?>
					<?php } ?>
						
				<?php } ?>
				</ul>
				</div>
			</header>

			</div>
			</div>
			<div class="gap-top resume-objectives">
			<?php
				$summary = $template->get_summary();
				if ( !empty( $summary ) ) { ?>

			<summary class="summary">
				<?php echo $summary; ?>
			</summary>
			<?php } ?>
			</div>
<?php 		
			//Loop through each resume section
			foreach ( $resume->get_sections(null, $template->author) as $section) { 

?>
<div class="resume-objectives">
			<section class="vcalendar" id="<?php echo $section->slug; ?>">
<?php			
				//Initialize our org. variable 
				$current_org=''; 
				
				//retrieve all posts in the current section using our custom loop query
				$positions = $resume->query( $section->slug, $template->author );
				
				//loop through all posts in the current section using the standard WP loop
				if ( $positions->have_posts() ) : ?>
				<header><?php echo $template->get_section_name( $section ); ?></header>
				<?php while ( $positions->have_posts() ) : $positions->the_post();
				
					//Retrieve details on the current position's organization
					$org = $resume->get_org( get_the_ID() );

					$hidetitle = get_post_meta( get_the_ID(), 'wp_resume_hidetitle', 'false'); 

					// If this is the first organization, 
					// or if this org. is different from the previous, begin new org
					if ( $org && $resume->get_previous_org() != $org) { ?>
				<article itemprop="affiliation"<?php if ( $section->slug == 'education' ) echo ' itemprop="alumniOf"'; ?> itemscope itemtype="http://schema.org/<?php if ( $section->slug == 'education' ) echo 'Educational'; ?>Organization" class="organization text-light <?php echo $section->slug; ?> vevent" id="<?php echo $org->slug; ?>">
					<header>
					<div class="row">
						<div class="col-md-6 text-left">
						<div class="orgName summary" itemprop="name" id="<?php echo $org->slug; ?>-name"><span class="company <?= $hidetitle; ?>"><?php echo $template->get_organization_name( $org ); ?></span></div>
						<div class="location" itemprop="location" itemprop="workLocation"><span class="companyrole"><?php echo $org->description; ?></span></div>
						</div>
						<div class="col-md-6 text-right">
						<div class="date"><?php echo $template->get_date( get_the_ID() ); ?></div>
						</div>
					</div>
					</header>
<?php 			} 	//End if new org ?>
					<<?php echo ( $org ) ? 'section' : 'article'; ?> class="vcard">
						<div class="text-left">
						<a href="#name" class="include" title="<?php echo $template->get_name(); ?>"></a>
						<?php if( $hidetitle !== 'true' ) { ?>
						<?php if ( $org ) { ?>
							<a href="#<?php echo $org->slug; ?>-name" class="include" title="<?php echo $template->get_organization_name( $org, false ); ?>"></a>
						<?php } else { ?>
							<header>
						<?php } ?>
						<div class="title" itemprop="jobTitle"><span class="companyrole"><?php echo $template->get_title( get_the_ID() ); ?></span></div>
						</div>
						
						<?php if ( !$org ) { ?>
							</header>
						<?php } ?>
						<?php } ?>
						<div class="row">
						<div class="details col-md-12" itemprop="description">
						<?php the_content(); ?>
<?php 			//If the current user can edit posts, output the link
				if ( current_user_can( 'edit_posts' ) ) 
					edit_post_link( 'Edit' ); 	
?>
						</div><!-- .details -->
						</div>
					</<?php echo ( $org ) ? 'section' : 'article'; ?>> <!-- .vcard -->
<?php  
				if ( $org && $resume->get_next_org() != $org ) { ?>
					</article><!-- .organization -->
				<?php }

				//End loop
				endwhile; endif;	
?>
			</section><!-- .section -->
			</div>
<?php } ?> 
		</div><!-- #resume -->
		</article>
<?php
	//Reset query so the page displays comments, etc. properly
	wp_reset_query();
?>