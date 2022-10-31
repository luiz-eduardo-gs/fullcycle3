import { Category } from "./category";

describe("Category Unit Tests", () => {
  test("category constructor", () => {
    // Triple AAA - Arrange Act Assert

    // Arrange
    const props = {
      name: "Movie",
      description: "Movie description",
      isActive: true,
      createdAt: new Date(),
    };

    // Act
    const category = new Category(props);

    // Assert
    expect(category.props).toStrictEqual(props);
    // expect(category.name).toBe("Movie");
    // expect(category.description).toBe("Movie description");
    // expect(category.isActive).toBeTruthy();
    // expect(category.createdAt).toBe(createdAt);
  });
});
