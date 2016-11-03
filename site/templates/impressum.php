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
          <a class="navigation-link" href="./#projects">Projekte</a>
          <a class="navigation-link" href="./#portfolio">Portfolio</a>
        </div>
      </div>
    </div>
  </div>

  <div class="heading-section">
    <div class="w-container heading-container" id="projects">
      <h1>Impressum</h1>
    </div>
  </div>

  <div class="content-section">
    <div class="w-container responsive-container">
      
      <?php echo kirbytext($page->text()); ?>

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