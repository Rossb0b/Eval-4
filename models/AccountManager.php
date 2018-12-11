<?php

declare(strict_types = 1);

/**
 * Class representing an account manager
 */
class AccountManager extends Manager
{

    /**
     * Count number of account with this name in database
     * @param Account $account
     * @return int
     */
    public function count(Account $account)
    {
        return (int) $req = $this->database->query('SELECT COUNT(id) as count FROM Account WHERE name = "'.$account->getName().'"')->fetch()['count'];
    }

    /**
     * Add Account to database
     * @param Account $account
     * @return void
     */
    public function addAccount(Account $account)
    {
        $req = $this->database->prepare('INSERT INTO Account (name, balance) VALUES (:name, :balance)');
        $req->bindValue(':name', $account->getName(), PDO::PARAM_STR);
        $req->bindValue(':balance', 80, PDO::PARAM_INT);
        
        $req->execute();
    }

    /**
     * Delete Account to database
     * @param Account $accound
     * @return void
     */
    public function deleteAccount(Account $account)
    {
        $req = $this->database->query('DELETE FROM Account WHERE id = ' . $account->getId());
    }

    /**
     * Add founds to this account in database
     * @param Account $account
     * @param int $balancePost
     * @return void
     */
    public function addFounds(Account $account, int $balancePost)
    {
        $req = $this->database->prepare('UPDATE Account SET balance = balance + :balance WHERE id = ' . $account->getId());
        $req->bindValue(':balance', $balancePost, PDO::PARAM_INT);
        
        $req->execute();
    }

    /**
     * Dept frounds to this account in database
     * @param Account $account
     * @param int $balancePost
     * @return void
     */
    public function deptFounds(Account $account, int $balancePost)
    {
        $req = $this->database->prepare('UPDATE Account SET balance = balance - :balance WHERE id = "' . $account->getId() . '"');
        $req->bindvalue(':balance', $balancePost, PDO::PARAM_INT);

        $req->execute();
    }

    /**
     * Get this account
     * @param int $id
     * @return Account
     */
    public function getAccount(int $id)
    {
      $req = $this->database->query('SELECT * FROM Account WHERE id = "'. $id .'"');
      $rep = $req->fetch(PDO::FETCH_ASSOC);
      
      return new Account($rep);
    }
  
    /**
     * Get each account
     * @return array
     */
    public function getAccounts()
    {
      $accounts = [];
      $req = $this->database->query('SELECT * FROM Account');
      
      while ($data = $req->fetch(PDO::FETCH_ASSOC))
      {
        $accounts[] = new Account($data);
      }
  
      return $accounts;
    }
}