# Bank application

Evaluation on back-end. 
This application allow you to :
* create 4 differents type of account; "PEL", "Compte Courant", "Livret A", "Compte joint".
* add or dept founds on your accounts.
* transfer money from an account to another one.
* deleting one of your account.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

1. Fork it!
2. Create your feature branch: git checkout -b my-new-feature
3. Commit your changes: git commit -am 'added some feature'
4. Push to the branch: git push origin my-new-feature
5. Submit a pull request :)

Then you need to import the db and create a "conf" folder with a "database.conf.php" file in it.
The following patern is to use in "database.conf.php" :

  <?php 
  /**
  * MySQL auth info
  */
  $host = 'localhost';
  $base = 'Eval4';
  $user = 'root';
  $pass = 'Your password';

  try
  {
    $database = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }
  catch(PDOException $e)
  {
   die($e);
  }

  return $database;


### Prerequisites

No prerequisites listed.

## Running the tests


## Contributing

No specific details on our code of conduct, and process for submitting pull requests to us.

## Authors

* **Nicolas Hallaert**

## License

No license available.

## Acknowledgments
