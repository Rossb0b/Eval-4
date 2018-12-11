<?php

// On enregistre notre autoload.
spl_autoload_register(function($class)
{
  if (file_exists('../models/' . $class . '.php'))
    require_once '../models/' . $class . '.php';
  elseif (file_exists('../entities/' . $class . '.php'))
    require_once '../entities/' . $class . '.php';
  else die('Class ' . $class . ' not found.');
});

$accountManager = new AccountManager();

/**
 * Create a new Account, we first check the submit.
 */
if(isset($_POST['new']))
{
    $data_account = array(
        'name' => htmlspecialchars($_POST['name'])
    );

    $errors = "";

    $account = new Account($data_account);
    $accountManager->count($account);
    /**
     * Verificaiton if there is no other Account with this name in database.
     * If, we push the new Account in database.
     * If not, we set an error message. 
     */
    if($accountManager->count($account) < 1)
    {
      $accountManager->addAccount($account);
    }
    else
    {
      $errors = "Vous avez déjà un compte de ce type.";
    }
}

/**
 * Add founds to this account in database.
 */
if(isset($_POST['payment']) AND isset($_POST['balance']))
{
  $account = $accountManager->getAccount($_POST['id']);
  $accountManager->addFounds($account, $_POST['balance']);
}

/**
 * Dept founds to this account in database.
 */
if(isset($_POST['debit']) AND isset($_POST['balance']))
{
  $account = $accountManager->getAccount($_POST['id']);
  $accountManager->deptFounds($account, $_POST['balance']);
}

/**
 * Dept founds to $account, and add the same value to $account2
 */
if (isset($_POST['transfer']) AND isset($_POST['balance']) AND isset($_POST['idPayment']))
{
  $account = $accountManager->getAccount($_POST['idDebit']);
  $account2 = $accountManager->getAccount($_POST['idPayment']);
  $accountManager->deptFounds($account, $_POST['balance']);
  $accountManager->addFounds($account2, $_POST['balance']);
}

/**
 * Delete this account in database.
 */
if (isset($_POST['delete']))
{
  $account = $accountManager->getAccount($_POST['id']);
  $accountManager->deleteAccount($account);
}

$accounts = $accountManager->getAccounts();

// $accountManager->getAccounts();

include "../views/indexView.php";
