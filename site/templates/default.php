<!DOCTYPE html>
<html>
  <head profile="http://www.w3.org/2005/10/profile">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>David Reeß</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/styles/normalize.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/webflow.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/style.css">
    <link rel="icon" type="image/x-icon" href="asses/images/favicon.png">
  </head>
  <body>
  <div class="header">
    <div class="w-container header">
      <div class="w-row">
        <div class="w-col w-col-6 w-col-medium-6">
          <h1 class="logo">David Reess</h1>
        </div>
        <div class="w-col w-col-6 w-col-medium-6 w-clearfix navigation">
          <a class="navigation-link" href="#projects">Projekte</a>
          <a class="navigation-link" href="#portfolio">Portfolio</a>
        </div>
      </div>
    </div>
  </div>
  <div class="hero">
    <div class="w-container">
      <div class="w-row">
        <div class="w-col w-col-4 w-col-medium-4 w-clearfix hero-image">
          <img class="showcase-small-image hero-image" src="assets/images/me.png">
          </img>
        </div>
        <div class="w-col w-col-8 w-col-medium-8 hero-text">
          <div class="w-container">
            <p>Hey! Mein Name ist David Reeß. Ich erstelle <b>Websiten</b> und <b>Webanwendungen</b> und liebe es zu <b>Programmieren</b>. Meine Fähigkeiten beinhalten die <b>bedeutendsten Websprachen</b>, <b>vorbildliche Arbeitsweisen</b> und eine gute Portion <b>Webdesign</b>.</p>
            <p>Wenn Sie gern ein Projekt umsetzen wollen, oder Hilfe benötigen, <b>kontaktieren Sie mich</b>:</p>
          </div>
          <div class="w-row hero-icons">
            <div class="w-col w-col-6 w-clearfix contact-wrapper">
              <img class="hero-icon" src="assets/images/email-icon.png" width="32px">
              </img>
              <p class="hero-icon-text">queicherius@gmail.com</p>
            </div>
            <div class="w-col w-col-6 w-clearfix contact-wrapper">
              <img class="hero-icon" src="assets/images/skype-icon.png" width="32px">
              </img>
              <p class="hero-icon-text">queicherius</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="heading-section">
    <div class="w-container heading-container" id="projects">
      <h1>Private Projekte</h1>
    </div>
  </div>
  <div class="content-section">

    <div class="w-container responsive-container">
      <div class="w-row small-projects-2">

      	<?php $projects = $pages->find('projects')
							->children()
							->sortBy('date', 'desc'); 

			  $i = 0;

		?>

		<?php foreach ($projects as $project): ?>

			<?php $i++; ?>

			<?php $image = $project->images()->find('preview.png'); ?>

			<div class="w-col w-col-6 w-col-medium-6 project-column">

	          <img class="showcase-small-image" src="<?php echo $image->url(); ?>" />

	          <div class="responsive-row">

	            <h2><?php echo $project->title(); ?></h2>

	            <p class="date"><?php echo $project->date('d.m.Y'); ?></p>

	            <?php echo kirbytext($project->text()); ?>

	            <a class="button" href="<?php echo $project->project(); ?>">Zum Projekt</a>

	            <p class="used-language"><?php echo $project->technologies(); ?></p>

	          </div>

	        </div>

	        <?php 

	        	if ($i % 2 == 0) {
	        		echo '<div class="project-clear"></div>';
	        	}

          	?>

		<?php endforeach; ?>

      </div>
    </div>
  </div>
    
  <div class="heading-section">
    <div class="w-container heading-container" id="portfolio">
      <h1>Portfolio</h1>
    </div>
  </div>
  <div class="content-section">

    <div class="w-container responsive-container">
      <div class="w-row small-projects-2">

        	<?php $portfolio = $pages->find('portfolio')
						->children()
						->sortBy('date', 'desc'); 

		 		  $i = 0;

			?>

			<?php foreach ($portfolio as $page): ?>

				<?php $i++; ?>

				<?php $image = $page->images()->find('preview.png'); ?>

				<div class="w-col w-col-6 w-col-medium-6 project-column">

		          <img class="showcase-small-image" src="<?php echo $image->url(); ?>" />

		          <div class="responsive-row">

		            <h2><?php echo $page->title(); ?></h2>

		            <p class="date"><?php echo $page->date('d.m.Y'); ?></p>

		            <?php echo kirbytext($page->text()); ?>

		            <a class="button" href="<?php echo $page->project(); ?>">Zum Projekt</a>

		            <p class="used-language"><?php echo $page->technologies(); ?></p>

		          </div>

		        </div>

		        <?php 

		        	if ($i % 2 == 0) {
		        		echo '<div class="project-clear"></div>';
		        	}

	          	?>

			<?php endforeach; ?>

      </div>
    </div>

  </div>

  <div class="footer-section">
    <div class="w-container footer">
      <img class="footer-avatar" src="assets/images/awesome.png" width="20px">
      </img>
      <a class="footer-link" href="/impressum">Impressum<br></a>
    </div>
  </div>

<!-- Piwik --> 
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://piwik.david-reess.de/" : "http://piwik.david-reess.de/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://piwik.david-reess.de/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->

</body>
</html>