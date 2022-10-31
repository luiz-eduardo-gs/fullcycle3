package com.luizeduardo.admin.catalogo.application.category.update;

import com.luizeduardo.admin.catalogo.application.UseCase;
import com.luizeduardo.admin.catalogo.domain.validation.handler.Notification;
import io.vavr.control.Either;

public abstract class UpdateCategoryUseCase
        extends UseCase<UpdateCategoryCommand, Either<Notification, UpdateCategoryOutput>> {
}
