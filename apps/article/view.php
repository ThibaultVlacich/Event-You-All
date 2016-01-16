<?php
defined('EUA_VERSION') or die('Access denied');
/**
 * This is the View for the app "article".
 *
 * @package apps/article
 * @author Louis Arbaretier <louis.arbaretier@isep.fr>
 * @version 0.1.0-dev-12-12-2015
 */

class ArticleView extends View {
  public function detail() {
    $this->setTemplate('/apps/article/views/article.php');
    $this->assign('css', Config::get('config.base').'/apps/article/styles/Article.css');
    $this->assign('js', Config::get('config.base').'/apps/article/script/art.js');
  }

  public function create() {
    $this->setTemplate('/apps/article/views/creatarticle.php');
    $this->assign('css', Config::get('config.base').'/apps/article/styles/creatarticle.css');
  }
    public function modif() {
    $this->setTemplate('/apps/article/views/modifarticle.php');
    $this->assign('css', Config::get('config.base').'/apps/article/styles/creatarticle.css');
  }

  //page de confirmation à faire
  public function create_confirm(){
    $this->setTemplate('/apps/article/views/creatart.php');
 }
   public function modif_confirm(){
    $this->setTemplate('/apps/article/views/modifarticleconf.php');
 }
   public function deleted(){
    $this->setTemplate('/apps/article/views/delete.php');
 }
}

?>
