<?php
namespace AppEHR\Database\Factories;

use AppEHR\Models\PatientsEHRDocument;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class PatientsEHRDocumentFactory extends Factory
{
    protected $model = PatientsEHRDocument::class ;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $User = array(Event::dispatch('InSeederOfEhrModuleProvideUserModel' , ''));
        /** we need to be login here because when we want to create EHR doc in database
        with $EHR_document_prescribed_common_drug and $EHR_document_prescribed_common_diet we need to use encryptDecrypt() method
        which this method needs logged-in user in its encryption method from helper.php file **/
        Auth::loginUsingId($User[0][0]['id']);
        $array_user_common_return_date       = explode("," , $User[0][0]['common_return_date']);
        $array_user_clinic_doctors_name      = explode("," , $User[0][0]['clinic_doctors_name']);
        $EHR_document_prescribed_common_drug = explode("," , $User[0][0]['common_drug']);
        $random_drugs                        = $EHR_document_prescribed_common_drug[rand(0,count($EHR_document_prescribed_common_drug)-1)].','.$EHR_document_prescribed_common_drug[rand(0,count($EHR_document_prescribed_common_drug)-1)] ;
        $EHR_document_prescribed_common_diet = explode("," , $User[0][0]['common_diet']);
        $random_diets                        = $EHR_document_prescribed_common_diet[rand(0,count($EHR_document_prescribed_common_diet)-1)].','.$EHR_document_prescribed_common_diet[rand(0,count($EHR_document_prescribed_common_diet)-1)] ;

        $patients_general_info = array(Event::dispatch('InSeederOfEhrModuleProvidePatientGeneralInfoModel' , $User[0][0]['id']));

        return
        [
            'EHR_document_patient_related_id'           => $patients_general_info[0][0]['patient_id'] ,
            'EHR_document_dr_related_id'                => $patients_general_info[0][0]['patient_dr_related_id'] ,
            'EHR_document_related_appointment_id'       => NULL ,
            'EHR_document_prescribed_common_drug'       => $random_drugs ,
            'EHR_document_prescribed_common_diet'       => $random_diets ,
            'EHR_document_prescribed_next_appointment'  => $array_user_common_return_date[rand(0,count($array_user_common_return_date)-1)] ,
            'EHR_document_related_clinic_doctor_name'   => $array_user_clinic_doctors_name[rand(0,count($array_user_clinic_doctors_name)-1)] ,
        ];
    }
}