
<?php

use App\Http\Controllers\ProductosController;
use App\Http\Controllers\TipoProductosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Ruta inicial
Route::get('/', function () {
    return view('welcome');
})->name('inicio');

// Rutas de autenticación
Auth::routes();
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Función de verificación de admin
$checkAdmin = function () {
    if (Auth::check() || Auth::user()->is_admin !== true) {
        return redirect('/')->with('error', 'Acceso no autorizado');
    }
};

// Rutas de administrador
Route::prefix('admin')->group(function() use ($checkAdmin) {
    Route::get('/', function() use ($checkAdmin) {
        if ($response = $checkAdmin()) return $response;
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Grupo de rutas para gestión de Productos bajo prefijo /admin
    // Usamos closures que llaman a los métodos del controlador para mantener el checkAdmin inline.
    Route::controller(ProductosController::class)->group(function() use ($checkAdmin) {
        Route::get('productos', function() use ($checkAdmin) {
            if ($response = $checkAdmin()!==true) return $response;
            return app(ProductosController::class)->index();
        })->name('admin.productos.index');
        // Rutas REST completas para productos
        // Mostrar formulario de creación de producto
        Route::get('productos/create', function() use ($checkAdmin) {
            if ($response = $checkAdmin()!==true) return $response;
            return app(ProductosController::class)->create();
        })->name('admin.productos.create');

        // Guardar nuevo producto
        Route::post('productos', function() use ($checkAdmin) {
            if ($response = $checkAdmin()!==true) return $response;
            return app(ProductosController::class)->store(request());
        })->name('admin.productos.store');

        // Ver detalle de producto (route-model binding asegura que $producto es instancia del modelo o 404)
        Route::get('productos/{producto}', function(\App\Models\productos $producto) use ($checkAdmin) {
            if ($response = $checkAdmin() !==true) return $response;
            return app(ProductosController::class)->show($producto);
        })->name('admin.productos.show');

        // Formulario de edición (no contiene select de tipo; la reasignación se hace desde Admin->Tipos)
        Route::get('productos/{producto}/edit', function(\App\Models\productos $producto) use ($checkAdmin) {
            if ($response = $checkAdmin()!==true) return $response;
            return app(ProductosController::class)->edit($producto);
        })->name('admin.productos.edit');

        // Actualizar producto (puede actualizar tipo_productos_id si viene en la petición desde la vista de Tipos)
        Route::put('productos/{producto}', function(\App\Models\productos $producto) use ($checkAdmin) {
            if ($response = $checkAdmin()!==true) return $response;
            return app(ProductosController::class)->update(request(), $producto);
        })->name('admin.productos.update');

        // Eliminar producto
        Route::delete('productos/{producto}', function(\App\Models\productos $producto) use ($checkAdmin) {
            if ($response = $checkAdmin()!==true) return $response;
            return app(ProductosController::class)->destroy($producto);
        })->name('admin.productos.destroy');
    });

    Route::controller(TipoProductosController::class)->group(function() use ($checkAdmin) {
        // Path should be 'tipo_productos' under the 'admin' prefix. Name the route so views can use route('admin.tipo_productos.index').
        Route::get('tipo_productos', function() use ($checkAdmin) {
            if ($response = $checkAdmin()!==true) return $response;
            return app(TipoProductosController::class)->index();
        })->name('admin.tipo_productos.index');

        // Crear nuevo tipo
        Route::post('tipo_productos', function() use ($checkAdmin) {
            if ($response = $checkAdmin()!==true) return $response;
            return app(TipoProductosController::class)->store(request());
        })->name('admin.tipo_productos.store');

        // Formulario de edición
        Route::get('tipo_productos/{tipo_productos}/edit', function(\App\Models\tipo_productos $tipo_productos) use ($checkAdmin) {
            if ($response = $checkAdmin()!==true) return $response;
            return app(TipoProductosController::class)->edit($tipo_productos);
        })->name('admin.tipo_productos.edit');

        // Actualizar tipo
        Route::put('tipo_productos/{tipo_productos}', function(\App\Models\tipo_productos $tipo_productos) use ($checkAdmin) {
            if ($response = $checkAdmin()!==true) return $response;
            return app(TipoProductosController::class)->update(request(), $tipo_productos);
        })->name('admin.tipo_productos.update');

        // Eliminar tipo
        Route::delete('tipo_productos/{tipo_productos}', function(\App\Models\tipo_productos $tipo_productos) use ($checkAdmin) {
            if ($response = $checkAdmin()!==true) return $response;
            return app(TipoProductosController::class)->destroy($tipo_productos);
        })->name('admin.tipo_productos.destroy');
    });
});
