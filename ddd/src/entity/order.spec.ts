import Order from "./order";
import OrderItem from "./order_item";

describe("Order unit tests", () => {
    
    it("should throw error when id is empty", () => {
        expect(() => {
            let order = new Order('', '123', []);
        }).toThrowError('Id is required');
    });

    it("should throw error when customerId is empty", () => {
        expect(() => {
            let order = new Order('123', '', []);
        }).toThrowError('CustomerID is required');
    });

    it("should throw error when items are empty", () => {
        expect(() => {
            let order = new Order('123', '123', []);
        }).toThrowError('Item quantity must be greater than zero');
    });

    it("should calculate total", () => {
        const item1 = new OrderItem('i1', 'Item 1', 100);
        const item2 = new OrderItem('i2', 'Item 2', 200);
    
        const order1 = new Order('o1', 'c1', [item1]);
        
        let total = order1.total();
        
        expect(total).toBe(100);
        
        const order2 = new Order('o2', 'c2', [item1, item2]);
        
        total = order2.total();

        expect(total).toBe(300);
    });
});