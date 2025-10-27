<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // id_card_settings
        if (Schema::hasTable('id_card_settings')) {
            Schema::table('id_card_settings', function (Blueprint $table) {
                if (!Schema::hasColumn('id_card_settings', 'prefix')) {
                    $table->string('prefix')->nullable();
                }
            });
        }

        // print_settings
        if (Schema::hasTable('print_settings')) {
            Schema::table('print_settings', function (Blueprint $table) {
                if (!Schema::hasColumn('print_settings', 'prefix')) {
                    $table->string('prefix')->nullable();
                }
            });
        }

        // students
        if (Schema::hasTable('students')) {
            Schema::table('students', function (Blueprint $table) {
                foreach (['school_transcript', 'school_certificate', 'collage_transcript', 'collage_certificate'] as $col) {
                    if (!Schema::hasColumn('students', $col)) {
                        $table->string($col)->nullable();
                    }
                }
            });
        }

        // applications
        if (Schema::hasTable('applications')) {
            Schema::table('applications', function (Blueprint $table) {
                foreach (
                    [
                        'school_transcript' => 'string',
                        'school_certificate' => 'string',
                        'collage_transcript' => 'string',
                        'collage_certificate' => 'string',
                    ] as $col => $type
                ) {
                    if (!Schema::hasColumn('applications', $col)) {
                        $table->$type($col)->nullable();
                    }
                }

                if (!Schema::hasColumn('applications', 'fee_amount')) {
                    $table->double('fee_amount', 10, 2)->nullable();
                }
                if (!Schema::hasColumn('applications', 'pay_status')) {
                    $table->tinyInteger('pay_status')->default('0')->comment('0 Unpaid, 1 Paid, 2 Cancel');
                }
                if (!Schema::hasColumn('applications', 'payment_method')) {
                    $table->integer('payment_method')->nullable();
                }
            });
        }

        // application_settings
        if (Schema::hasTable('application_settings')) {
            Schema::table('application_settings', function (Blueprint $table) {
                if (!Schema::hasColumn('application_settings', 'fee_amount')) {
                    $table->double('fee_amount', 10, 2)->nullable();
                }
                if (!Schema::hasColumn('application_settings', 'pay_online')) {
                    $table->boolean('pay_online')->default('1')->comment('0 No, 1 Yes');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // id_card_settings
        if (Schema::hasTable('id_card_settings')) {
            Schema::table('id_card_settings', function (Blueprint $table) {
                if (Schema::hasColumn('id_card_settings', 'prefix')) {
                    $table->dropColumn('prefix');
                }
            });
        }

        // print_settings
        if (Schema::hasTable('print_settings')) {
            Schema::table('print_settings', function (Blueprint $table) {
                if (Schema::hasColumn('print_settings', 'prefix')) {
                    $table->dropColumn('prefix');
                }
            });
        }

        // students
        if (Schema::hasTable('students')) {
            Schema::table('students', function (Blueprint $table) {
                foreach (['school_transcript', 'school_certificate', 'collage_transcript', 'collage_certificate'] as $col) {
                    if (Schema::hasColumn('students', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }

        // applications
        if (Schema::hasTable('applications')) {
            Schema::table('applications', function (Blueprint $table) {
                foreach (
                    [
                        'school_transcript',
                        'school_certificate',
                        'collage_transcript',
                        'collage_certificate',
                        'fee_amount',
                        'pay_status',
                        'payment_method',
                    ] as $col
                ) {
                    if (Schema::hasColumn('applications', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }

        // application_settings
        if (Schema::hasTable('application_settings')) {
            Schema::table('application_settings', function (Blueprint $table) {
                foreach (['fee_amount', 'pay_online'] as $col) {
                    if (Schema::hasColumn('application_settings', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }
    }
};
