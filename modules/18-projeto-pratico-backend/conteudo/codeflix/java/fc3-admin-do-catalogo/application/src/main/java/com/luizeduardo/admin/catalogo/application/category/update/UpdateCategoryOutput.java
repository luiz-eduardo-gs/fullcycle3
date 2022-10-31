package com.luizeduardo.admin.catalogo.application.category.update;

import com.luizeduardo.admin.catalogo.domain.category.Category;
import com.luizeduardo.admin.catalogo.domain.category.CategoryID;

public record UpdateCategoryOutput(
        CategoryID id
) {
//    public static UpdateCategoryOutput from(final String anId) {
//        return new UpdateCategoryOutput(anId);
//    }

    public static UpdateCategoryOutput from(final Category aCategory) {
        return new UpdateCategoryOutput(aCategory.getId());
    }
}
