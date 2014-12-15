<?php

/**
 Template Name: Contact Page  
 *
 * The Template for the contact  form page.
 *
 * @package bigvideo
 */

?>

 
<?php

if(isset($_POST['submitted'])) {

        if(trim($_POST['contactName']) === '') {
               $nameError = 'Please enter your name.';
               $hasError = true;
        } else {  

               $name = trim($_POST['contactName']);
        }

        if(trim($_POST['email']) === '')  {
               $emailError = 'Please enter your email address.';
               $hasError = true;
        } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
               $emailError = 'You entered an invalid email address.';
               $hasError = true;
        } else {
               $email = trim($_POST['email']);
        }

        if(trim($_POST['comments']) === '') {
               $commentError = 'Please enter a message.';
               $hasError = true;
        } else {
               if(function_exists('stripslashes')) {
                      $comments = stripslashes(trim($_POST['comments']));
               } else {
                       $comments = trim($_POST['comments']);
               }
        }

        if(!isset($hasError)) {
               $emailTo = get_option('tz_email');
               if (!isset($emailTo) || ($emailTo == '') ){
                       $emailTo = get_option('admin_email');
               }
               $subject = 'New Contact Submission From '.$name;
               $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
               $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

               wp_mail($emailTo, $subject, $body, $headers);
               $emailSent = true;
        }
} ?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<?php if (has_post_thumbnail( $post->ID ) ): 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
$image = $image[0]; 
elseif ( (empty($image) ) && get_theme_mod( 'bigvideo_headerbg' )  ) : 
  $image = get_theme_mod( 'bigvideo_headerbg' ); 
else : 
   $image = get_stylesheet_directory_uri() . '/images/default-bg.jpg';   ?> 
<?php endif; ?>
	
<header class="page-header" style="background-image: url('<?php echo $image; ?>'); background-size: cover; background-position: top center;"> 
		<h1 class="entry-title"><?php the_title(); ?></h1>
</header><!-- .entry-header -->
    
<div class="page-wrap">
<div class="grid grid-pad">
		<div id="primary" class="content-area single-collection-wrap">
			<main role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content"> 

             <?php if(isset($emailSent) && $emailSent == true) { ?>
             <div><p>Thanks, your email was sent successfully.</p></div>
				<?php } else { ?>
					<?php the_content(); ?>
						<?php if(isset($hasError) || isset($captchaError)) { ?>
						<p>Sorry, an error occured.<p>
						<?php } ?>

						<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
  						<ul class="contact-form">
						<li class="contact-name">
						 <input type="text" name="contactName" id="contactName" placeholder="Your Name" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" />
							<?php if($nameError != '') { ?>
							<span><?php echo $nameError;?></span>
							<?php } ?>
					 	</li>

						<li class="contact-email">
						<input type="text" name="email" id="email" placeholder="Your Email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" />
							<?php if($emailError != '') { ?>
							<span><?php echo $emailError;?></span>
							<?php } ?>
						</li>

 						<li class="contact-comments">
						<textarea name="comments" id="commentsText" placeholder="Your Message" rows="12" cols="30"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if($commentError != '') { ?>
							<span><?php echo $commentError;?></span>
							<?php } ?>
						</li>

						<li>
						<input type="submit" class="contact-submit" value="Send Message"></input>
						</li>
						</ul>
						<input type="hidden" name="submitted" id="submitted" value="true" />
						</form>
                        

                        <?php } ?> 
                        

            		</div><!-- .entry-content -->
				</div><!-- .post -->
			<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->

	</div><!-- #primary --> 
 </div><!-- grid --> 
</div><!-- page-wrap -->  


<?php get_footer(); ?> 