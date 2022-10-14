package db_test

import (
	"database/sql"
	"log"
	"testing"

	"github.com/luiz-eduardo-gs/go-hexagonal/adapters/db"
	"github.com/stretchr/testify/require"
)

var Db *sql.DB

func setup() {
	Db, _ = sql.Open("sqlite3", ":memory:")
	createTable(Db)
	createProduct(Db)
}

func createTable(db *sql.DB) {
	table := `CREATE TABLE IF NOT EXISTS products (
		"id" TEXT NOT NULL,
        "name" TEXT NOT NULL,
        "price" FLOAT NOT NULL,
        "status" TEXT NOT NULL
	);`

	stmt, err := db.Prepare(table)

	if err != nil {
		log.Fatal(err.Error())
	}

	stmt.Exec()
}

func createProduct(db *sql.DB) {
	insert := `INSERT INTO products (id, name, price, status) VALUES ("abc", "Product Teste", 0, "disabled")`

	stmt, err := db.Prepare(insert)

	if err != nil {
		log.Fatal(err.Error())
	}

	stmt.Exec()
}

func TestProductDb_Get(t *testing.T) {
	setup()
	defer Db.Close()

	productDb := db.NewProductDb(Db)
	product, err := productDb.Get("abc")

	require.Nil(t, err)
	require.Equal(t, "Product Teste", product.GetName())
	require.Equal(t, 0.0, product.GetPrice())
	require.Equal(t, "disabled", product.GetStatus())
}
