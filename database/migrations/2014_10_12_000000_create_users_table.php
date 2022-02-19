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
            $table->id();
            $table->integer('parent_id')->nullable()->comment('The "parent_id" should be extended from "id", in addition when a user have a "parent_id" , its "user_type" should be "user" . But if the "parent_id" was "NULL" then "user_type should be "admin" , remember that the "parent_id" by default is "NULL" , You can change it Manually');
            $table->string('name')->collation('utf8_general_ci')->unique();
            $table->string('phone')->collation('utf8_general_ci')->nullable();
            $table->string('gender')->collation('utf8_general_ci')->nullable();
            $table->string('dob')->collation('utf8_general_ci')->nullable();
            $table->string('user_type')->collation('utf8_general_ci')->nullable()->comment('The "user_type" should be "admin" or "user" and by default is "NULL" , You can change it Manually');
            $table->string('email')->collation('utf8_general_ci')->unique();
            $table->timestamp('email_verified_at')->collation('utf8_general_ci')->nullable();
            $table->string('password');
            $table->string('gap_time_between_appointments')->collation('utf8_general_ci')->default('15');
            $table->string('company_name')->collation('utf8_general_ci')->default('MatabeOnline Clinic Management Software');
            $table->string('contact_address', '1000' )->collation('utf8_general_ci')->default('Tehran , Iran');
            $table->string('college')->collation('utf8_general_ci')->nullable();
            $table->string('college_branch')->collation('utf8_general_ci')->nullable();
            $table->string('phone_number')->collation('utf8_general_ci')->default('02166421164');
            $table->string('mobile_number')->collation('utf8_general_ci')->default('09125790902');
            $table->string('website')->collation('utf8_general_ci')->default('https://MatabeOnline.ir');
            $table->string('user_ip')->collation('utf8_general_ci')->nullable();
            $table->string('http_user_agent')->collation('utf8_general_ci')->nullable();
            $table->string('activation_status')->collation('utf8_general_ci')->default('active');
            $table->string('language')->collation('utf8_general_ci')->default('english');
            $table->string('telegram')->collation('utf8_general_ci')->default('true')->comment('if dr enable telegram service');
            $table->string('common_hypersensitivity' , '1000')->collation('utf8_general_ci')->default('DM,HTN,IHD,Fatty Liver,Autoimmune hepatitis,Lung,Thyroid,Allergy,Seizure,RRMS,SPMS-,SPMS+,PPMS-,PPMS+,NMO-,NMO+,Atypical,Overlap,Interesting,RION,Re myelitis,Autoimmune,Aggressive,RIS,DD,CIS,Others');
            $table->string('cms_menu_title' , '1000' )->collation('utf8_general_ci')->default('Previous Case,Paraclinic,Next visit,Recommendations,Medications,Records,6,Patient Sheet 1,Patient Sheet 2,Charts,Chart 1,Chart 2,Chart 3,Chart 4 ,Search Patients,Submit New Patient,Appointments,Welcome,Appointment on a Specific Date,Appointments Reminder by Bot,Financial Management,Submit a Financial Transaction,Financial Transactions Report,Financial Service Types Settings (Just Accessible for Admin),Change Password,Settings of Software,Supporting,Help,Logout');
            $table->string('common_drug' , '1000')->collation('utf8_general_ci')->default('Cinnovex,Avonex,Recigen,Rebif,Ziferon,Betaferon,Cinnotec,Diphosel,Tebazio,Fingolimod,Tysabri,Rituximab,Novantrone,Cyclophosphamide,Dalfyra,Dexamethasone,Methylprednisolone,Progio,Ocrelizumab,Azaram,Cellcept,IVIG,Ammorel,Modafinil,Lcarnitine,Gabapentin');
            $table->string('common_diet' , '1000')->collation('utf8_general_ci')->default('Regular use of drugs,exercise,non-smoking of tobacco and hookah,regular use of vitamin D,avoidance of stress,counseling,low-salt diet,physiotherapy,occupational therapy,physical medicine,sports medicine,nutrition');
            $table->string('common_return_date' , '1000')->collation('utf8_general_ci')->default('One Week,Two Weeks,Three Weeks,One Month,Two Months,Three Months,Four Months,Five Months,Six Months,Seven Months,Eight Months,Nine Months,Ten Months,Eleven Months,Twelve Months,After Answering Experiments');
            $table->string('clinic_doctors_name' , '1000')->collation('utf8_general_ci')->default('Dr James,Dr Alex,Dr Saber');
            $table->string('notif_sms_credit')->collation('utf8_general_ci')->default('100');
            $table->string('financial_management', '1000' )->collation('utf8_general_ci')->default('Visit Patient 1: 5000,Visit Type 2: 0,Treatment Type 1: 100000,Treatment Type 2: 80000,Treatment Type 3: 70000,Treatment Type 4: 30000,Treatment Type 5: 0,Packages Treatment: 18000000,Laser: 40000');
            $table->string('options_for_user' , '1000' )->collation('utf8_general_ci')->default('a:1:{i:0;s:1:"t";}');
            $table->rememberToken();
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
