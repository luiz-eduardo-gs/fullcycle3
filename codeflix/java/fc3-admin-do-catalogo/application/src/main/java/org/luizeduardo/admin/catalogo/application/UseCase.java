package org.luizeduardo.admin.catalogo.application;

import org.luizeduardo.admin.catalogo.domain.Category;

public class UseCase {
    public Category execute() {
        return new Category();
    }
}