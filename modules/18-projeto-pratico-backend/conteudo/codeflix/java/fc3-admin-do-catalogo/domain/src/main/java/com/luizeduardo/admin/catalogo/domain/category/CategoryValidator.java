package com.luizeduardo.admin.catalogo.domain.category;

import com.luizeduardo.admin.catalogo.domain.validation.Error;
import com.luizeduardo.admin.catalogo.domain.validation.ValidationHandler;
import com.luizeduardo.admin.catalogo.domain.validation.Validator;

public class CategoryValidator extends Validator {

    public static final int NAME_MIN_LENGTH = 3;
    public static final int NAME_MAX_LENGTH = 255;
    private final Category category;

    public CategoryValidator(final Category aCategory, final ValidationHandler aHandler) {
        super(aHandler);
        this.category = aCategory;
    }

    @Override
    public void validate() {
        checkNameConstraints();
    }

    private void checkNameConstraints() {
        final var name = this.category.getName();
        if (name == null) {
            this.validationHandler().append(new Error("'name' should not be null"));
            return;
        }

        if (name.isBlank()) {
            this.validationHandler().append(new Error("'name' should not be empty"));
            return;
        }

        final int length = name.trim().length();
        if (length < NAME_MIN_LENGTH || length > NAME_MAX_LENGTH) {
            this.validationHandler()
                    .append(
                        new Error("'name' must be between " + NAME_MIN_LENGTH + " and " + NAME_MAX_LENGTH + " characters")
                    );
        }
    }
}
