<?php

class FMControllerUninstall_fmc {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct() {
    global $cfm_options;
    if (!class_exists("DoradoWebConfig")) {
      include_once(WD_FMC_DIR . "/wd/config.php");
    }
    $config = new DoradoWebConfig();
    $config->set_options($cfm_options);
    $deactivate_reasons = new DoradoWebDeactivate($config);
    $deactivate_reasons->submit_and_deactivate();
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function execute() {
    $task = ((isset($_POST['task'])) ? esc_html(stripslashes($_POST['task'])) : '');
    if (method_exists($this, $task)) {
      check_admin_referer('nonce_fm', 'nonce_fm');
      $this->$task();
    }
    else {
      $this->display();
    }
  }

  public function display() {
    require_once WD_FMC_DIR . "/admin/models/FMModelUninstall_fm.php";
    $model = new FMModelUninstall_fmc();

    require_once WD_FMC_DIR . "/admin/views/FMViewUninstall_fm.php";
    $view = new FMViewUninstall_fmc($model);
    $view->display();
  }

  public function uninstall() {
    require_once WD_FMC_DIR . "/admin/models/FMModelUninstall_fm.php";
    $model = new FMModelUninstall_fmc();

    require_once WD_FMC_DIR . "/admin/views/FMViewUninstall_fm.php";
    $view = new FMViewUninstall_fmc($model);
    $view->uninstall();
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Getters & Setters                                                                  //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Private Methods                                                                    //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Listeners                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
}