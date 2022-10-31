package com.luizeduardo.admin.catalogo.application;

import com.luizeduardo.admin.catalogo.domain.category.Category;

public abstract class UseCase<IN,OUT> {
    public abstract OUT execute(IN anIN);
}