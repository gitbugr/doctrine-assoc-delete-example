# Doctrine Discriminator/Collection Deletion Bug

## Reproduction
Requires:

* MySQL Database open on 127.0.0.1:3306
* PHP 8.x
* Composer
* Git

Clone this repo.

Database setup:
* Run commands in `database_setup.sql`

(Optional) Set up general log to see queries:

```sql
 SET GLOBAL general_log = 'ON';
 SHOW VARIABLES LIKE '%general_log%'
```

Installing:
* Run `composer install`

Running script:
* Run `php index.php`

Output of the script will show a before and after of the 'things' table.
There _should_ be one record left, however there are none, due to a dangerous
delete statement that does not use the discriminator column.


Example MySQL general log output:

```
 2024-06-14T16:46:29.180548Z      1129 Connect   testuser@192.168.65.1 on testdb using TCP/IP
 2024-06-14T16:46:29.180790Z      1129 Query     SET NAMES utf8mb4
 2024-06-14T16:46:29.181521Z      1129 Query     START TRANSACTION
 2024-06-14T16:46:29.190471Z      1129 Query     INSERT INTO useras (id) VALUES (null)
 2024-06-14T16:46:29.192460Z      1129 Query     INSERT INTO userbs (id) VALUES (null)
 2024-06-14T16:46:29.193806Z      1129 Query     INSERT INTO things (owner_id, type) VALUES (1, 'a')
 2024-06-14T16:46:29.195259Z      1129 Query     INSERT INTO things (owner_id, type) VALUES (1, 'b')
 2024-06-14T16:46:29.197671Z      1129 Query     SELECT * FROM `things`
 2024-06-14T16:46:29.201817Z      1129 Query     DELETE FROM things WHERE owner_id = 1
 2024-06-14T16:46:29.204184Z      1129 Query     SELECT * FROM `things`
 2024-06-14T16:46:29.205522Z      1129 Query     ROLLBACK
 2024-06-14T16:46:29.209591Z      1129 Quit
```

