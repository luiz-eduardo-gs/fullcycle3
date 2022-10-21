package com.luizeduardo.admin.catalogo.application.category.create;

import java.util.Objects;

import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;
import org.mockito.Mockito;
import static org.mockito.AdditionalAnswers.returnsFirstArg;

import com.luizeduardo.admin.catalogo.domain.category.CategoryGateway;

public class CreateCategoryUseCaseTest {

    @Test
    public void givenAValidCommand_whenCallCreateCategory_thenShouldReturnCategoryId() {
        final var expectedName = "Movies";
        final var expectedDescription = "A new movies category.";
        final var expectedIsActive = true;

        final var aCommand = CreateCategoryCommand.with(expectedName, expectedDescription, expectedIsActive);

        final CategoryGateway categoryGateway = Mockito.mock(CategoryGateway.class);
        Mockito.when(categoryGateway.create(Mockito.any()))
            .thenAnswer(returnsFirstArg());

        final var useCase = new DefaultCreateCategoryUseCase(categoryGateway);

        final var actualOutput = useCase.execute(aCommand);

        Assertions.assertNotNull(actualOutput);
        Assertions.assertNotNull(actualOutput.id() );

        Mockito.verify(categoryGateway, Mockito.times(1)).create(Mockito.argThat(
            aCategory -> {
                return Objects.equals(expectedName, aCategory.getName())
                        && Objects.equals(expectedDescription, aCategory.getDescription())
                        && Objects.equals(expectedIsActive, aCategory.isActive())
                        && Objects.nonNull(aCategory.getId())
                        && Objects.nonNull(aCategory.getCreatedAt())
                        && Objects.nonNull(aCategory.getUpdatedAt())
                        && Objects.isNull(aCategory.getDeletedAt());
            }
        ));
    }
}
