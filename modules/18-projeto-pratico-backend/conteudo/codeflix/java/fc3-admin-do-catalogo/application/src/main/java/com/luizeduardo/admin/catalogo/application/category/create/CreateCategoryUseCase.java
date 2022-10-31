package com.luizeduardo.admin.catalogo.application.category.create;

import com.luizeduardo.admin.catalogo.application.UseCase;
import com.luizeduardo.admin.catalogo.domain.validation.handler.Notification;
import io.vavr.control.Either;

public abstract class CreateCategoryUseCase
        extends UseCase<CreateCategoryCommand, Either<Notification, CreateCategoryOutput>> {

}
