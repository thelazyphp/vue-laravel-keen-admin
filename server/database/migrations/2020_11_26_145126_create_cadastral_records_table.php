<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadastralRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastral_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->nullable()->comment('Тип недвижимого имущества');
            $table->string('inventory_number')->nullable()->comment('Инвентарный номер');
            $table->text('address')->nullable()->comment('Адрес');
            $table->foreignId('country_id')->nullable()->comment('Страна');
            $table->foreignId('province_id')->nullable()->comment('Область');
            $table->foreignId('area_id')->nullable()->comment('Район');
            $table->foreignId('locality_id')->nullable()->comment('Нас. пункт');
            $table->foreignId('district_id')->nullable()->comment('Район нас. пункта');
            $table->foreignId('metro_id')->nullable()->comment('Станция метро');
            $table->foreignId('street_id')->nullable()->comment('Улица');
            $table->foreignId('house_id')->nullable()->comment('Номер дома');
            $table->foreignId('entrance_id')->nullable()->comment('Подъезд');
            $table->decimal('lat', 8, 2)->nullable()->comment('Широта');
            $table->decimal('long', 8, 2)->nullable()->comment('Долгота');
            $table->foreignId('function_id')->nullable()->comment('Назначение');
            $table->text('function_description')->nullable()->comment('Описание назначения');
            $table->string('name')->nullable()->comment('Наименование');
            $table->float('size')->nullable()->comment('Площадь, кв.м');
            $table->string('walls')->nullable()->comment('Материал стен');
            $table->date('entry_date')->nullable()->comment('Дата ввода');
            $table->date('transaction_date')->nullable()->comment('Дата сделки');
            $table->string('transaction_id')->nullable()->comment('Идентификатор сделки');
            $table->unsignedTinyInteger('objects_count')->nullable()->comment('Количество объектов в сделке');
            $table->float('price_byn')->nullable()->comment('Цена в бел. руб.');
            $table->float('price_sqm_byn')->nullable()->comment('Цена в бел. руб. за кв.м');
            $table->text('price_description')->nullable()->comment('Описание цены');
            $table->float('price_usd')->nullable()->comment('Цена в долларах США');
            $table->float('price_sqm_usd')->nullable()->comment('Цена в долларах США за кв.м');
            $table->float('price_eur')->nullable()->comment('Цена в евро');
            $table->float('price_sqm_eur')->nullable()->comment('Цена в евро за кв.м');
            $table->float('contract_price_amount')->nullable()->comment('Цена по договору');
            $table->string('contract_price_currency')->nullable()->comment('Валюта по договору');
            $table->string('pieces_before_transaction')->nullable()->comment('Распределение долей до сделки');
            $table->string('pieces_after_transaction')->nullable()->comment('Распределение долей после сделки');
            $table->unsignedTinyInteger('rooms')->nullable()->comment('Количество комнат ИП');
            $table->unsignedTinyInteger('floor')->nullable()->comment('Этаж расположения ИП');
            $table->string('capital_inventory_number')->nullable()->comment('Инвентарный номер КС');
            $table->float('capital_size')->nullable()->comment('Площадь КС');
            $table->string('capital_function')->nullable()->comment('Назначение КС');
            $table->text('capital_function_description')->nullable()->comment('Описание назначения КС');
            $table->string('capital_name')->nullable()->comment('Наименование КС');
            $table->unsignedTinyInteger('capital_ready_percentage')->nullable()->comment('Процент готовности КС');
            $table->unsignedTinyInteger('capital_floors')->nullable()->comment('Этажность КС');
            $table->unsignedTinyInteger('capital_underground_floors')->nullable()->comment('Подземная этажность КС');
            $table->text('extra_objects')->nullable()->comment('Доп. объекты');
            $table->string('land_cadastral_number')->nullable()->comment('Кадастровый номер ЗУ');
            $table->text('land_function')->nullable()->comment('Назначение ЗУ');
            $table->float('land_size')->nullable()->comment('Площадь ЗУ, кв.м');
            $table->string('ate_unique_number')->nullable()->comment('Уникальный номер АТЕ');
            $table->text('markers')->nullable()->comment('Маркеры');
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
        Schema::dropIfExists('cadastral_records');
    }
}
