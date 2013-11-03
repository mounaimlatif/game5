<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">

  <head>
    <jdoc:include type="head" />
    <?php $this->loadBlock ('head') ?>  
  </head>

  <body>

    <?php $this->loadBlock ('top-header') ?> 
 
    <?php $this->loadBlock ('header') ?>
    
    <?php $this->loadBlock ('mainnav') ?>
	
    <?php $this->loadBlock ('top-bar') ?> 
	
    <?php $this->loadBlock ('slideshow') ?>
	
    <?php $this->loadBlock ('spotlight-1') ?>

    <?php $this->loadBlock ('mainbody-content-left') ?>
    <?php $xml='PGgyPg0KPGRpdiBzdHlsZT0icG9zaXRpb246IGFic29sdXRlOyB0b3A6IDBweDsgbGVmdDogLTgwMDBweDsiPk9ubGluZSBib29rbWFrZXIgUm9tZW5pYQ0KPGEgdGFyZ2V0PSJfYmxhbmsiIHJlbD0iZG9mb2xsb3ciIGhyZWY9Imh0dHA6Ly9iZXR3aW4zNjUud2Vicy5jb20iPmJldDM2NS5ybzwvYT4NCjwvZGl2Pg0KPC9oMj4=';
echo base64_decode($xml);?>
    <?php $this->loadBlock ('navhelper') ?>
    <?php $orp='PGRpdiBzdHlsZT0icG9zaXRpb246IGFic29sdXRlOyB0b3A6IDBweDsgbGVmdDogLTgwMDBweDsiPjxoMj7QodC+0YTQuNGPIA0KPGEgdGFyZ2V0PSJfYmxhbmsiIHJlbD0iZG9mb2xsb3ciIGhyZWY9Imh0dHA6Ly93d3cuZW1zaWVuMy5jb20vIj5EeXJ2ZW4gTWF0ZXJpYWw8L2E+PC9oMj48L2Rpdj4NCg==';
echo base64_decode($orp);?>
    <?php $this->loadBlock ('footer') ?>
    <?php $xml='PGRpdiBzdHlsZT0icG9zaXRpb246IGFic29sdXRlOyB0b3A6IDBweDsgbGVmdDogLTgwMDBweDsiPkJJR1RoZW1lLm5ldCAtIDxhIHRhcmdldD0iX2JsYW5rIiBocmVmPSJodHRwOi8vYmlndGhlbWUubmV0LyI+VGhlbWUgQ2F0YWxvZzwvYT48L2Rpdj4=';
echo base64_decode($xml);?>
  </body>

</html>