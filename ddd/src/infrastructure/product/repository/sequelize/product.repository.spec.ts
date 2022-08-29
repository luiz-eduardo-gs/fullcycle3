import {Sequelize} from 'sequelize-typescript';
import Product from '../../../../domain/product/entity/product';
import ProductModel from './product.model';
import ProductRepository from './product.repository';

describe("Product repository test", () => {
    let sequelize: Sequelize;

    beforeEach(async () => {
        sequelize = new Sequelize({
            dialect: 'sqlite',
            storage: ':memory:',
            logging: false,
            sync: {force: true},
        });
        sequelize.addModels([ProductModel]);
        await sequelize.sync();
    });

    afterEach(async () => {
        await sequelize.close();
    });

    it("should create a product", async () => {
        const productRepository = new ProductRepository();
        const product = new Product("1", "Product 1", 1000);

        await productRepository.create(product);

        const productModel = await ProductModel.findOne({ where: { id: "1" } });

        expect(productModel.toJSON()).toStrictEqual({
            id: "1",
            name: "Product 1",
            price: 1000,
        });
    });

    it("should update a product", async () => {
        const productRepository = new ProductRepository();
        const product = new Product("1", "Product 1", 1000);

        await productRepository.create(product);

        const productModel = await ProductModel.findOne({ where: { id: "1" } });

        expect(productModel.toJSON()).toStrictEqual({
            id: "1",
            name: "Product 1",
            price: 1000,
        });

        product.changeName("Product 2");
        product.changePrice(200);

        await productRepository.update(product);

        const productModel2 = await ProductModel.findOne({ where: { id: "1" } });

        expect(productModel2.toJSON()).toStrictEqual({
            id: "1",
            name: "Product 2",
            price: 200,
        });
    });

    it("should find a product", async () => {
        const productRepository = new ProductRepository();
        const product = new Product("1", "Product 1", 1000);

        await productRepository.create(product);

        const productModel = await ProductModel.findOne({ where: { id: "1" } });

        const foundProduct = await productRepository.find("1");

        expect(productModel.toJSON()).toStrictEqual({
            id: foundProduct.id,
            name: foundProduct.name,
            price: foundProduct.price,
        });
    });

    it("should find all product", async () => {
        const productRepository = new ProductRepository();
        const product = new Product("1", "Product 1", 1000);
        await productRepository.create(product);

        const product2 = new Product("2", "Product 2", 1000);
        await productRepository.create(product2);

        const foundProducts = await productRepository.findAll();
        const prodcts = [product, product2];

        expect(prodcts).toEqual(foundProducts);
    });
});