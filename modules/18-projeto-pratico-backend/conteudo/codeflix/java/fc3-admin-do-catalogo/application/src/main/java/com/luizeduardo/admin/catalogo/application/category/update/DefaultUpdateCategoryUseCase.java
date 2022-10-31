package com.luizeduardo.admin.catalogo.application.category.update;

import com.luizeduardo.admin.catalogo.application.UseCase;
import com.luizeduardo.admin.catalogo.domain.category.Category;
import com.luizeduardo.admin.catalogo.domain.category.CategoryGateway;
import com.luizeduardo.admin.catalogo.domain.category.CategoryID;
import com.luizeduardo.admin.catalogo.domain.exceptions.DomainException;
import com.luizeduardo.admin.catalogo.domain.validation.Error;
import com.luizeduardo.admin.catalogo.domain.validation.handler.Notification;
import io.vavr.API;
import io.vavr.control.Either;
import io.vavr.control.Try;

import java.util.Objects;
import java.util.function.Supplier;

public class DefaultUpdateCategoryUseCase
        extends UseCase<UpdateCategoryCommand, Either<Notification, UpdateCategoryOutput>> {

    private final CategoryGateway categoryGateway;

    public DefaultUpdateCategoryUseCase(final CategoryGateway categoryGateway) {
        this.categoryGateway = Objects.requireNonNull(categoryGateway);
    }

    @Override
    public Either<Notification, UpdateCategoryOutput> execute(final UpdateCategoryCommand aCommand) {
        final var anId = CategoryID.from(aCommand.id());
        final var aCategory = this.categoryGateway.findById(anId)
                .orElseThrow(notFound(anId));

        final var notification = Notification.create();

        aCategory.update(aCommand.name(), aCommand.description(), aCommand.isActive())
                .validate(notification);

        return notification.hasError() ? API.Left(notification) : update(aCategory);
    }

    private static Supplier<DomainException> notFound(CategoryID anId) {
        return () ->
                DomainException.with(
                        new Error("Category with ID %s was not found".formatted(anId.getValue()))
                );
    }

    private Either<Notification, UpdateCategoryOutput> update(final Category aCategory) {
        return API.Try(() -> this.categoryGateway.update(aCategory))
                .toEither()
                .bimap(Notification::create, UpdateCategoryOutput::from);
    }
}
