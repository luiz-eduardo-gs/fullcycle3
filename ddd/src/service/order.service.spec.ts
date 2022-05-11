import Order from "../entity/order";
import OrderItem from "../entity/order_item";
import OrderService from "./order.service";

describe("Order service unit tests", () => {
    it("should return all orders total", () => {

        const orderItem1 = new OrderItem('i1', 'Item 1', 100, 'p1', 1);
        const orderItem2 = new OrderItem('i2', 'Item 2', 200, 'p2', 2);

        const order1 = new Order('123', 'c1', [orderItem1]);
        const order2 = new Order('124', 'c1', [orderItem2]);
    
        const total = OrderService.total([order1, order2]);

        expect(total).toBe(500);
    });
})