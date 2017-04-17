<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOsAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('os_addresses', function (Blueprint $table) {
            $table->decimal('X',9,7);
            $table->decimal('Y',9,7);
            $table->string('gml_id', 29);
            $table->bigInteger('uprn');
            $table->string('udprn', 8);
            $table->string('changeType', 1);
            $table->string('state', 1);
            $table->string('stateDate', 10);
            $table->string('class', 6);
            $table->integer('rpc');
            $table->integer('localCustodianCode');
            $table->string('country', 1);
            $table->string('laStartDate', 10);
            $table->string('lastUpdateDate', 10);
            $table->string('entryDate', 10);
            $table->string('buildingNumber', 3);
            $table->string('paoStartNumber', 3);
            $table->integer('usrn');
            $table->integer('usrnMatchIndicator');
            $table->string('officialFlag', 1);
            $table->string('osAddressTOID', 20);
            $table->string('osAddressTOIDVersion', 2);
            $table->string('osRoadLinkTOID', 20);
            $table->integer('osRoadLinkTOIDVersion');
            $table->string('osTopoTOID', 20);
            $table->integer('osTopoTOIDVersion');
            $table->string('voaCTRecord', 10);
            $table->string('streetDescription', 91);
            $table->string('thoroughfare', 32);
            $table->string('townName', 10);
            $table->string('administrativeArea', 10);
            $table->string('postTown', 10);
            $table->string('postcode', 7);
            $table->string('postcodeLocator', 7);
            $table->string('postcodeType', 1);
            $table->string('deliveryPointSuffix', 2);
            $table->string('addressbasePostal', 1);
            $table->integer('wardCode');
            $table->string('rmStartDate', 10);
            $table->integer('multiOccCount');
            $table->string('parentUPRN', 12);
            $table->string('subBuildingName', 27);
            $table->string('buildingName', 32);
            $table->string('saoText', 50);
            $table->string('paoText', 90);
            $table->string('paoStartSuffix', 1);
            $table->string('paoEndNumber', 3);
            $table->string('voaNDRRecord', 10);
            $table->string('voaNDRPDescCode', 4);
            $table->string('voaNDRScatCode', 3);
            $table->string('dependentLocality', 13);
            $table->string('rmOrganisationName', 58);
            $table->string('saoStartNumber', 3);
            $table->string('dependentThoroughfare', 28);
            $table->string('saoStartSuffix', 1);
            $table->string('laOrganisation', 46);
            $table->string('level', 24);
            $table->string('saoEndNumber', 2);
            $table->string('locality', 16);
            $table->string('doubleDependentLocality', 25);
            $table->string('paoEndSuffix', 1);
            $table->string('poBoxNumber', 3);
            $table->string('departmentName', 31);
            $table->string('saoEndSuffix', 1);

            $table->primary('gml_id');
            $table->index('osTopoTOID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('os_addresses');
    }
}
