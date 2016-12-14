<?php
/*
 * 
 * per https://laravel.com/docs/master/upgrade#upgrade-5.3.0 - John Lawrie
 *
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AlterTableJobsDropReservedColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::table('jobs', function (Blueprint $table) {
        
        $table->dropColumn('reserved');

    });
    
       Schema::table('failed_jobs', function (Blueprint $table) {
 +        $table->longText('exception')->after('payload');
 +    });

}

public function down()
{
    Schema::table('jobs', function (Blueprint $table) {
        $table->tinyInteger('reserved')->unsigned();

       
    });

    Schema::table('failed_jobs', function (Blueprint $table) {
 +        $table->dropColumn('exception');
 +    });
 
}
}
