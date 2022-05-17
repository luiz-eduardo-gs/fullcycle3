import Order from "./order";
import OrderItem from "./order_item";

describe("Order Item unit tests", () => {

    it("should check if items quantity greater than zero", () => {
        expect(() => {
            const item1 = new OrderItem('i1', 'Item 1', 100, 'p1', -1);
        }).toThrowError('Quantity must be greater than zero');
    });
});