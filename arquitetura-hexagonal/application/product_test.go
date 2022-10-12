package application_test

import (
	"testing"

	"github.com/luiz-eduardo-gs/go-hexagonal/application"
	uuid "github.com/satori/go.uuid"
	"github.com/stretchr/testify/require"
)

func TestProduct_Enable(t *testing.T) {
	product := application.Product{}
	product.Name = "Hello"
	product.Status = application.DISABLED
	product.Price = 10

	err := product.Enable()
	require.Nil(t, err)

	product.Price = 0

	err = product.Enable()
	require.Equal(t, "Product price should be greater than zero to be enabled", err.Error())
}

func TestProduct_Disable(t *testing.T) {
	product := application.Product{}
	product.Name = "Hello"
	product.Status = application.ENABLED
	product.Price = 0

	err := product.Disable()
	require.Nil(t, err)

	product.Price = 10
	err = product.Disable()

	require.Equal(t, "Product price should be zero to be disabled", err.Error())
}

func TestProduct_IsValid(t *testing.T) {
	product := application.Product{}
	product.ID = uuid.NewV4().String()
	product.Name = "Hello"
	product.Status = application.ENABLED
	product.Price = 10

	_, err := product.IsValid()
	require.Nil(t, err)

	// Invalid Status
	product.Status = "INVALID"
	_, err = product.IsValid()
	require.Equal(t, "Product status should be one of the following: ENABLED, DISABLED", err.Error())

	// Valid Status
	product.Status = application.ENABLED
	_, err = product.IsValid()
	require.Nil(t, err)

	// Invalid Price
	product.Price = -1
	_, err = product.IsValid()
	require.Equal(t, "Price should be positive", err.Error())

	// Valid Price
	product.Price = 10
	_, err = product.IsValid()
	require.Nil(t, err)
}
