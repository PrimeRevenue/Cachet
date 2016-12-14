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
        $table->dropIndex('jobs_queue_reserved_reserved_at_index');
        $table->dropColumn('reserved');
        $table->index(['queue', 'reserved_at']);
    });

    Schema::table('failed_jobs', function (Blueprint $table) {
        $table->longText('exception')->after('payload');
    });
}

public function down()
{
    Schema::table('jobs', function (Blueprint $table) {
        $table->tinyInteger('reserved')->unsigned();
        $table->index(['queue', 'reserved', 'reserved_at']);
        $table->dropIndex('jobs_queue_reserved_at_index');
    });

    Schema::table('failed_jobs', function (Blueprint $table) {
        $table->dropColumn('exception');
    });
}
}
