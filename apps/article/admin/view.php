<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "events".
 *
 * @package apps/events/admin
 * @author Thibault Vlacich <thibault.vlacich@isep.fr>
 * @version 0.1.0-dev-13-12-2015
 */

  class ArticleAdminView extends View {
  public function index() {
    $this->setTemplate('/apps/article/admin/views/index.php');
    $this->assign('css', Config::get('config.base').'/apps/article/admin/styles/home.css');
  }
  public function modif() {
    $this->setTemplate('/apps/article/admin/views/modifarticle.php');
    $this->assign('css', Config::get('config.base').'/apps/article/styles/creatarticle.css');


    $this->assign('js', Config::get('config.base').'/librairies/ckeditor/ckeditor.js');
    $this->assign('js', Config::get('config.base').'/apps/events/scripts/create.js');
  }
  public function modif_confirm(){
    $this->setTemplate('/apps/article/admin/views/modifarticleconf.php');
  }
}

?>
