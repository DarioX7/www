<?php

class IndexController extends Zend_Controller_Action {

  public function init() {
    /* Initialize action controller here */
  }

  public function indexAction() {
    // action body
    $this->view->tytul = 'indexAction';
    //$dbRfid = new Application_Model_DbTable_DbRfid();
    //Zend_Debug::dump($dbRfid->fetchAll());exit;
    //Zend_Debug::dump();exit;
  }

  public function preDispatch() {
    $auth = Zend_Auth::getInstance();
    if (!$auth->hasIdentity()) {
      return $this->_helper->redirector(
              'index', 'autoryzacja', 'default'
      );
    }
    $this->view->identity = $auth->getIdentity();
  }

  public function monitoringAction() {
    // action body
  }

  public function temperaturaAction() {
    // action body
  }

  public function kontrolaAction() {
    $zmienna1 = new Application_Model_DbTable_DbRfid();
    $this->view->zmienna2 = $zmienna1->fetchAll();
  }

  public function tempPokojAction() {
    $this->_helper->layout()->disableLayout();
    $dbTemperatura = new Application_Model_DbTable_DbTemp();
    $lastTemp = $dbTemperatura->getLastPokoj();  //tu zmieniasz dla metod
    
    $array = array();
    array_push($array, (Double) $lastTemp->temperatura);
    $json = Zend_Json::encode($array);
    $this->_helper->json->sendJson($array, true, true);
  }
  //TODO
  //tempGarazAction()
  //tempSalonAction()
  //tempLazienkaAction()
  //tempKuchniaAction()
  //wszystko analogicznie jak będzie działać poprawnie to automatycznie 
  //zacznie działać zmiana na dropDown
}
