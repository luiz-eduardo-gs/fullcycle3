import Address from "./address";
import Customer from "./customer";

describe("Customer unit tests", () => {
    
    it("should throw error when id is empty", () => {
        expect(() => {
            let customer = new Customer('', 'John');
        }).toThrowError('Id is required');
        
    });

    it("should throw error when name is empty", () => {
        expect(() => {
            let customer = new Customer('123', '');
        }).toThrowError('Name is required');
        
    });

    it("should throw error when name changed is empty", () => {
        expect(() => {
            let customer = new Customer('123', 'John');
            customer.changeName('');
        }).toThrowError('Name is required');
        
    });

    it("should change name", () => {
        // Arrange
        const customer = new Customer('123', 'John');
        
        // Act
        customer.changeName('Jane');
        
        // Assert
        expect(customer.name).toBe('Jane');
    });

    it("should activate customer", () => {
        const customer = new Customer('1', 'John');
        const address = new Address('Street 1', 123, '12345-123', 'Catalao');
        customer.Address = address;
        customer.activate();
        expect(customer.isActive()).toBe(true);
    });

    it("should throw error when address is undefined on customer activation", () => {
        expect(() => {
            const customer = new Customer('1', 'John');
            customer.activate();
        }).toThrowError('Address is mandatory to activate a customer');
    });

    it("should deactivate customer", () => {
        const customer = new Customer('1', 'John');
        customer.deactivate();
        expect(customer.isActive()).toBe(false);
    });
});