<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNcaRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nca_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('type_id')->nullable()->comment('Тип недвижимого имущества');
            $table->string('inventory_number')->nullable()->comment('Инвентарный номер');
            $table->unsignedBigInteger('address_country_id')->nullable()->comment('Адрес (страна)');
            $table->unsignedBigInteger('address_province_id')->nullable()->comment('Адрес (область)');
            $table->unsignedBigInteger('address_area_id')->nullable()->comment('Адрес (район)');
            $table->unsignedBigInteger('address_locality_id')->nullable()->comment('Адрес (нас. пункт)');
            $table->unsignedBigInteger('address_district_id')->nullable()->comment('Адрес (район нас. пункта)');
            $table->unsignedBigInteger('address_metro_id')->nullable()->comment('Адрес (станция метро)');
            $table->unsignedBigInteger('address_street_id')->nullable()->comment('Адрес (улица)');
            $table->unsignedBigInteger('address_house_id')->nullable()->comment('Адрес (номер дома)');
            $table->unsignedBigInteger('address_entrance_id')->nullable()->comment('Адрес (подъезд)');
            $table->unsignedBigInteger('address_coordinates_id')->nullable()->comment('Адрес (координаты)');
            $table->unsignedBigInteger('function_id')->nullable()->comment('Назначение');
            $table->text('function_description')->nullable()->comment('Описание назначения');
            $table->string('name')->nullable()->comment('Наименование');
            $table->float('size')->nullable()->comment('Площадь, кв.м');
            $table->string('walls')->nullable()->comment('Материал стен');
            $table->timestamp('entry_date')->nullable()->comment('Дата ввода');
            $table->timestamp('transaction_date')->nullable()->comment('Дата сделки');
            $table->string('transaction_id')->nullable()->comment('Идентификатор сделки');
            $table->unsignedTinyInteger('objects_count')->nullable()->comment('Количество объектов в сделке');
            $table->float('price_byn')->nullable()->comment('Цена в бел. руб.');
            $table->float('price_sq_m_byn')->nullable()->comment('Цена в бел. руб. за кв.м');
            $table->text('price_description')->nullable()->comment('Описание цены');
            $table->float('price_usd')->nullable()->comment('Цена в долларах США');
            $table->float('price_sq_m_usd')->nullable()->comment('Цена в долларах США за кв.м');
            $table->float('price_eur')->nullable()->comment('Цена в евро');
            $table->float('price_sq_m_eur')->nullable()->comment('Цена в евро за кв.м');
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nca_records');
    }
}
