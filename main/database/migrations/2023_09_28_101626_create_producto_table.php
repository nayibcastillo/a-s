<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Producto', function (Blueprint $table) {
            $table->bigIncrements('Id_Producto');
            $table->string('Principio_Activo', 500)->nullable();
            $table->string('Presentacion', 500)->nullable();
            $table->string('Concentracion', 500)->nullable();
            $table->mediumText('Nombre_Comercial')->nullable();
            $table->string('Embalaje', 500)->nullable();
            $table->string('Laboratorio_Generico', 500)->nullable();
            $table->string('Laboratorio_Comercial', 500)->nullable();
            $table->string('Familia', 500)->nullable();
            $table->string('Codigo_Cum', 500)->nullable()->index('Codigo_Cum');
            $table->integer('Cantidad_Minima')->nullable();
            $table->integer('Cantidad_Maxima')->nullable();
            $table->string('ATC', 500)->nullable();
            $table->string('Descripcion_ATC', 500)->nullable();
            $table->string('Invima', 500)->nullable();
            $table->date('Fecha_Expedicion_Invima')->nullable();
            $table->date('Fecha_Vencimiento_Invima')->nullable();
            $table->integer('Precio_Minimo')->nullable();
            $table->integer('Precio_Maximo')->nullable();
            $table->string('Tipo_Regulacion', 500)->nullable();
            $table->string('Tipo_Pos', 500)->nullable();
            $table->string('Via_Administracion', 500)->nullable();
            $table->string('Unidad_Medida', 100)->nullable();
            $table->decimal('Cantidad', 10, 0)->nullable();
            $table->enum('Regulado', ['si', 'no'])->nullable();
            $table->string('Tipo', 100)->default('Medicamento');
            $table->string('Peso_Presentacion_Minima', 11)->nullable();
            $table->string('Peso_Presentacion_Regular', 11)->nullable();
            $table->string('Peso_Presentacion_Maxima', 11)->nullable();
            $table->string('Codigo_Barras', 200)->nullable()->index('Codigo_Barras_idx');
            $table->integer('Cantidad_Presentacion')->default(1);
            $table->mediumText('Mantis')->nullable();
            $table->mediumText('Imagen')->nullable();
            $table->integer('Id_Categoria')->nullable();
            $table->string('Nombre_Listado', 200)->nullable();
            $table->string('Referencia', 100)->nullable();
            $table->enum('Gravado', ['si', 'no'])->default('No');
            $table->enum('RotativoC', ['si', 'no'])->nullable();
            $table->enum('RotativoD', ['si', 'no'])->nullable();
            $table->integer('Tolerancia')->default(0);
            $table->enum('Actualizado', ['si', 'no'])->default('No');
            $table->string('Unidad_Empaque', 20)->nullable()->comment("Cantidad de unidades por caja");
            $table->string('Porcentaje_Arancel', 20)->nullable()->comment("Esto es un porcentaje representado en valor entero no dividido entre 100");
            $table->string('Forma_Farmaceutica', 250)->nullable();
            $table->enum('Estado', ['activo', 'inactivo'])->default('Activo');
            $table->string('Estado_DIAN_Covid19', 100)->nullable();
            $table->integer('Id_Subcategoria')->nullable();
            $table->integer('CantUnMinDis')->nullable()->comment("Cantidad expresada en unidades mÃ­nimas de Dispensacion");
            $table->integer('Producto_Dotation_Type_Id')->nullable();
            $table->string('Tipo_Catalogo', 50)->nullable();
            $table->string('Producto_Dotacion_Tipo', 50)->nullable();
            $table->string('Id_Tipo_Activo_Fijo', 50)->nullable();
            $table->tinyInteger('Orden_Compra')->nullable();
            $table->boolean('Ubicar')->default(0);
            $table->integer('company_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Producto');
    }
}
