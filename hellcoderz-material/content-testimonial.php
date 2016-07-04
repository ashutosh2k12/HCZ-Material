<?php $testimonials = apply_filters('get_testimonials',null,'none',null); ?>
<h2 class="blog-title-pro"><?php the_title(); ?></h2>
<div class="testimonials well">
<?php if($testimonials): ?>
<?php foreach ($testimonials as $testimonial) : ?>
    <div id="testimonial">
        <blockquote class="testimonial-text"><p><?= $testimonial['content']; ?></p></blockquote>
        <?php if( !empty($testimonial['site']) ): ?>
        <p class="testimonial-from">&mdash; <small><cite><?= $testimonial['site']; ?></cite></small></p>
    	<?php endif; ?>
        <hr>
    </div>
<?php endforeach; ?>
<?php endif; ?>
</div>
