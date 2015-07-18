<?php
/**
 * JOOMLADE
 * 
 * @package     Joomla.Site
 * @subpackage  Templates.joomlade
 *
 * @author      Niels Nübel <n.nuebel@nn-medienagentur.de>
 * @copyright   Copyright (c) 2015 NN-Medienagentur.de
 * @license     GNU General Public License version 2 or later
 */

defined( '_JEXEC' ) or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Set JOOMLADE Variables
$menu               = $app->getMenu();
$active             = $app->getMenu()->getActive();
$pageclass          = $app->getParams()->get('pageclass_sfx');
$tpath              = $this->baseurl.'/templates/'.$this->template;
$googlefont         = $params->get('googlefont', 'Open+Sans:400,800');
$showsystemoutput   = $params->get('showsystemoutput', 1);

$isFrontpage        = false;
$active_alias       = '';

if ($active)
{
    $defaultmenuitems = array($menu->getDefault()->id, $menu->getDefault(JFactory::getLanguage()->getTag())->id);
    $isFrontpage = in_array($active->id, $defaultmenuitems);
    $active_alias = $active->alias;
}

// generator tag
$this->setGenerator(null);

if ($googlefont !='') $doc->addStyleSheet("https://fonts.googleapis.com/css?family=".$googlefont);

//Add CSS and Javascript
$doc->addStyleSheet($tpath . '/css/joomlade.css');
$doc->addScript($tpath.'/js/joomlade.js');

?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"> <!--<![endif]-->
<head>
  <meta name="x-ua-compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <jdoc:include type="head" />
  <link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/images/apple-touch-icon-57x57-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/images/apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/images/apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $tpath; ?>/images/apple-touch-icon-144x144-precomposed.png">
  <!--[if lte IE 9]>
  <script src="<?php echo $tpath; ?>/js/html5shiv.min.js"></script>
  <script src="<?php echo $tpath; ?>/js/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <!-- Hidden anchor links for accessibility -->
  <a href="#mainnav" class="skiplink"><?php echo JText::_('TPL_JOOMLADE_ANCHOR_NAV'); ?></a>
  <a href="#maincontent" class="skiplink"><?php echo JText::_('TPL_JOOMLADE_ANCHOR_CONTENT'); ?></a>

  <div id="outerwrapper" class="container">
    <header id="header">
      <img id="logo" src="<?php echo $tpath; ?>" alt="Logo des Joomla Projekts" />
    
      <nav id="#mainnnav">
        <jdoc:include type="modules" name="nav" />
      </nav>

      <jdoc:include type="modules" name="header" />
    </header>

    <?php if($this->countModules('top-stack')):  ?>
      <div id="top-stack" class="row">
        <jdoc:include type="modules" name="top-stack" style="html5" />
      </div>
    <?php endif; ?>

    <?php if($this->countModules('top-a')):  ?>
      <div id="top-a" class="row">
        <jdoc:include type="modules" name="top-a" style="joomlade" width="col-lg-<?php echo round(12 / $this->countModules('top-a')); ?>"  />
      </div>
    <?php endif; ?>
    <?php if($this->countModules('top-b')):  ?>
      <div id="top-b" class="row">
        <jdoc:include type="modules" name="top-b" style="joomlade" width="col-lg-<?php echo round(12 / $this->countModules('top-b')); ?>"  />
      </div>
    <?php endif; ?>
    <?php if($this->countModules('top-c')):  ?>
      <div id="top-c" class="row">
        <jdoc:include type="modules" name="top-c" style="joomlade" width="col-lg-<?php echo round(12 / $this->countModules('top-c')); ?>"  />
      </div>
    <?php endif; ?>

    <div id="mainwrapper" class="row">
      <main id="maincontent" role="main" class="<?php if($this->countModules('aside')) {echo 'col-lg-9';} else {echo 'col-lg-12';} ?>">
        <jdoc:include type="message" />
        <jdoc:include type="component" />
      </main>

      <?php if($this->countModules('aside')): ?>
        <section id="aside" class="col-lg-3">
          <jdoc:include type="modules" name="aside" style="html5" />
        </section>
      <?php endif; ?>
    </div>

    <?php if($this->countModules('bottom-a')):  ?>
      <div id="bottom-a" class="row">
        <jdoc:include type="modules" name="bottom-a" style="joomlade" width="col-lg-<?php echo round(12 / $this->countModules('bottom-a')); ?>"  />
      </div>
    <?php endif; ?>
    <?php if($this->countModules('bottom-b')):  ?>
      <div id="bottom-b" class="row">
        <jdoc:include type="modules" name="bottom-b" style="joomlade" width="col-lg-<?php echo round(12 / $this->countModules('bottom-b')); ?>"  />
      </div>
    <?php endif; ?>
    <?php if($this->countModules('bottom-c')):  ?>
      <div id="bottom-c" class="row">
        <jdoc:include type="modules" name="bottom-c" style="joomlade" width="col-lg-<?php echo round(12 / $this->countModules('bottom-c')); ?>"  />
      </div>
    <?php endif; ?>

    <?php if($this->countModules('bottom-stack')):  ?>
      <div id="bottom-stack" class="row">
        <jdoc:include type="modules" name="bottom-stack" style="html5" />
      </div>
    <?php endif; ?>

    <?php if($this->countModules('footer')):  ?>
      <footer id="footer">
        <jdoc:include type="modules" name="footer" style="html5" />
      </footer>
    <?php endif; ?>
  </div>
</body>
<jdoc:include type="modules" name="debug" />
</html>