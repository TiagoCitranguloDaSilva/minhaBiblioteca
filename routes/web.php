<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\CategoriaController;


Route::get('/', [LivroController::class, "showActive"]);


Route::get("admin/novoLivro", [CategoriaController::class, "index"]);

Route::view("admin/novaCategoria", "admin/novaCategoria");

Route::post("/storeCategoria", [CategoriaController::class, "store"]);

Route::post("/storeBook", [LivroController::class, "store"]);

Route::get("admin", [LivroController::class, "index"]);

Route::get("admin/editarLivro/{id}", [LivroController::class, "pickAdmValue"]);

Route::get("admin/editarCategoria/{id}", [CategoriaController::class, "pickAdmValue"]);

Route::post("/updateLivro", [LivroController::class, "update"]);

Route::post("/updateCategoria", [CategoriaController::class, "update"]);

Route::get("/excluirLivro/{id}", [LivroController::class, "excluir"]);

Route::get("/excluirCategoria/{id}", [CategoriaController::class, "excluir"]);

Route::get("detalhes/{id}", [LivroController::class, "pickValue"]);


