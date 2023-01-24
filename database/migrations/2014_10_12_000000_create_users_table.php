<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // $table->id();
            // $table->boolean('status')->default(1); // 1- Active, 2- Pending, 0- Suspended
            // $table->boolean('admin_read')->default(2);
            // $table->string('type', 55)->default('customer'); // admin, customer
            // $table->string('role', 55)->default('customer');
            // $table->string('first_name')->nullable();
            // $table->string('last_name');
            // $table->string('designation')->nullable();
            // $table->string('company_name')->nullable();
            // $table->string('username', 191)->nullable()->unique();
            // $table->string('mobile_number', 191)->nullable();
            // $table->string('email', 191)->unique();
            // $table->string('gender')->nullable();
            // $table->timestamp('dob')->nullable();
            // $table->string('street')->nullable();
            // $table->string('apartment')->nullable();
            // $table->string('city')->nullable();
            // $table->string('state')->nullable();
            // $table->string('zip')->nullable();
            // $table->string('country')->nullable();
            // $table->string('profile')->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->text('bio')->nullable();
            // $table->longText('address')->nullable(); // Json data
            // $table->rememberToken();
            // $table->softDeletes();
            // $table->timestamps();

            $table->id();
            $table->string('type', 55)->default('member'); // admin, member
            $table->string('role', 55)->default('Volunteer'); // Associate, Volunteer, Donor, Organizer, Admin
            $table->string('status', 55)->default('pending'); // pending, canceled, approved, before_submit
            $table->string('payment_status', 55)->default('unpaid'); // unpaid, paid

            // Personal Information
            $table->string('first_name')->nullable();
            $table->string('last_name');
            $table->string('nick_name')->nullable();
            $table->string('email', 191)->unique();
            $table->unsignedBigInteger('member_type_id')->nullable();
            $table->string('mobile_number')->nullable();
            $table->timestamp('dob')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('father_name')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('spouse_name')->nullable();
            $table->timestamp('spouse_dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('profile_image')->nullable();

            // Mailing Address
            $table->string('mailing_address')->nullable();
            $table->string('mailing_city')->nullable();
            $table->string('mailing_district')->nullable();
            $table->string('mailing_post_code')->nullable();
            $table->string('mailing_country')->nullable();
            $table->string('contact_no_res')->nullable();

            // Permanent Address
            $table->string('permanent_address')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_district')->nullable();
            $table->string('permanent_post_code')->nullable();
            $table->string('permanent_country')->nullable();

            // Others
            $table->longText('address')->nullable(); // Json data
            $table->string('password');
            $table->string('payment_method')->nullable();
            $table->string('payment_trx_number')->nullable();
            $table->text('update_note')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
