* `docker compose up -d`

#### Create people table

1. With docker compose running, `docker compose exec -it db bash`
2. `mysql -uroot -p`
3. 
    ```sql
        use nodedb; 
        CREATE TABLE IF NOT EXISTS people(
            id INT NOT NULL AUTO_INCREMENT,
            name VARCHAR(255),
            PRIMARY KEY (id)
        );
    ```

#### Insert into people table

1. With docker compose running, `docker compose exec -it app bash`
2. `node index.js`
3. Cancel app and check the mysql