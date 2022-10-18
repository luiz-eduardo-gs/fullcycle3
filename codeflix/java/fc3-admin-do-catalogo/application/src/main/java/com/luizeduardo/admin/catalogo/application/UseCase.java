package com.luizeduardo.admin.catalogo.application;

import com.luizeduardo.admin.catalogo.domain.Category;

public class UseCase {
    public Category execute() {
        return new Category();
    }
}