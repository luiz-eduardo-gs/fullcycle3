package com.luizeduardo.admin.catalogo.application.category.update;

import com.luizeduardo.admin.catalogo.application.category.create.DefaultCreateCategoryUseCase;
import com.luizeduardo.admin.catalogo.domain.category.Category;
import com.luizeduardo.admin.catalogo.domain.category.CategoryGateway;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.mockito.InjectMocks;
import org.mockito.Mock;
import org.mockito.Mockito;
import org.mockito.junit.jupiter.MockitoExtension;

import java.util.Objects;
import java.util.Optional;

import static org.mockito.AdditionalAnswers.returnsFirstArg;

@ExtendWith(MockitoExtension.class)
public class UpdateCategoryUseCaseTest {

    @InjectMocks
    private DefaultUpdateCategoryUseCase useCase;

    @Mock
    private CategoryGateway categoryGateway;

    @Test
    public void givenAValidCommand_whenCallsCategoryUpdate_thenShouldReturnCategoryId() {
        final var expectedName = "Movie";
        final var expectedDescription = "Movies description";
        final var expectedIsActive = true;

        // An existent category
        final var aCategory = Category.newCategory("Movi",null,true);
        final var expectedId = aCategory.getId();

        final var aCommand = UpdateCategoryCommand.with(
                expectedId.getValue(),
                expectedName,
                expectedDescription,
                expectedIsActive
        );

        Mockito.when(categoryGateway.findById(Mockito.eq(expectedId)))
                .thenReturn(Optional.of(Category.clone(aCategory)));

        Mockito.when(categoryGateway.update(Mockito.any())).thenAnswer(returnsFirstArg());

        final var actualOutput = useCase.execute(aCommand).get();

        Assertions.assertNotNull(actualOutput);
        Assertions.assertNotNull(actualOutput.id());

        Mockito.verify(categoryGateway, Mockito.times(1)).findById(Mockito.eq(expectedId));

        Mockito.verify(categoryGateway, Mockito.times(1)).update(Mockito.argThat(
                aUpdatedCategory ->
                        Objects.equals(expectedName, aUpdatedCategory.getName())
                            && Objects.equals(expectedDescription, aUpdatedCategory.getDescription())
                            && Objects.equals(expectedIsActive, aUpdatedCategory.isActive())
                            && Objects.equals(expectedId, aUpdatedCategory.getId())
                            && aCategory.getUpdatedAt().isBefore(aUpdatedCategory.getUpdatedAt())
                            && Objects.isNull(aUpdatedCategory.getDeletedAt())
        ));
    }
}
