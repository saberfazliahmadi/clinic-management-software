<?php
namespace AppEHR\Http\Controller ;

use App\Http\Controllers\Controller ;
use AppEHR\Http\PrepareData;
use AppEHR\Interfaces\EHRRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Responses\Responses ;
use phpDocumentor\Reflection\Types\InterfaceString;
use AppEHR\MessageSender;
use AppEHR\MessageSenderFacade;

/** In this controller according to Single Responsibility and Open-Closed Principles of SOLID
 we validate user inputs by Middlewares **/
class PatientsEHRDocumentController extends Controller
{
    private $EHRRepository ;
    public function __construct(EHRRepositoryInterface $EHRRepository)
    {
        $this->EHRRepository = $EHRRepository ;
    }

    public function show_patients_ehr_document_page( Request $request )
    {
        try
        {
            $decrypted_request_patient_id = encrypt_decrypt('decrypt' , $request->patient_id ) ;

            $result_of_show_patients_general_infos = $this->EHRRepository->fetch_info_of_this_patient_id( $decrypted_request_patient_id ) ;
            $result_of_patients_photo              = $this->EHRRepository->result_of_patient_ehr_photo( $decrypted_request_patient_id ) ;
            $result_of_patients_ehr_document       = $this->EHRRepository->result_of_patients_ehr_document( $decrypted_request_patient_id ) ;

            return Responses::view('EHR::show_patients_ehr_document_page' ,
            [
                'title_of_page'                             => 'EHR of Patient' ,
                'EHR_document_patient_related_id'           => $request->patient_id ,
                'EHR_document_dr_related_id'                => find_admin_id_from_users_table() ,
                'EHR_document_related_appointment_id'       => $request->related_appointment_id ,
                'EHR_document_related_clinic_doctor_name'   => $request->child_dr_related_name ,
                'result_of_patients_photo'                  => $result_of_patients_photo ,
                'count_result_of_patients_photo'            => $result_of_patients_photo->count() ,
                'result_of_patients_ehr_document'           => $result_of_patients_ehr_document ,
                'count_result_of_patients_ehr_document'     => $result_of_patients_ehr_document->count() ,
                'result_of_patients_general_infos'          => $result_of_show_patients_general_infos ,
                'admin_id_from_users_table'                 => find_admin_id_from_users_table()
            ]) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'home' , '' , '<span style="color:blue;">Can not display this EHR!</span>' , $exception ) ;
        }
    }

    public function store_patients_ehr_document_page( Request $request , PrepareData $PrepareData )
    {
        try
        {
            $decrypted_request_patient_id = encrypt_decrypt('decrypt', $request->patient_id ) ;

            $patient_more_description = $PrepareData->prepare_patient_more_description_variable($request->patient_more_description, $request->typed_keyboard_savabegh, $request->common_hypersensitivity_2311) ;

            $result_update_this_patient_general_info = $this->EHRRepository->update_this_patient_general_info_from_ehr_page($decrypted_request_patient_id, $patient_more_description, $request->post('patient_surgery_history'), $request->post('patient_disease_background'), $request->post('patient_medication_history'), $request->post('patient_allergies_history') ) ;
            if ( ! $result_update_this_patient_general_info )
            {
                return Responses::Failed( 'home', '' , '<span style="color:blue;">New information of patient DOES NOT updated! <br> So the New Photo and new EHR information of patient did not save also</span>' ) ;
            }

            $common_drug        = $PrepareData->prepare_common_drug_variable($request->all()) ;
            $common_diet        = $PrepareData->prepare_common_diet_variable($request->all()) ;
            $common_return_date = $PrepareData->prepare_common_return_date_variable($request->all()) ;
            $EHR_document_related_appointment_id_trick     = $PrepareData->prepare_EHR_document_related_appointment_id_variable($request->post('EHR_document_related_appointment_id')) ;
            $EHR_document_related_clinic_doctor_name_trick = $PrepareData->prepare_EHR_document_related_clinic_doctor_name($request->post('EHR_document_related_clinic_doctor_name'));

            $result_store_new_ehr_doc = $this->EHRRepository->store_new_ehr_doc($common_drug, $common_diet, $common_return_date, $decrypted_request_patient_id, $EHR_document_related_appointment_id_trick, $EHR_document_related_clinic_doctor_name_trick) ;
            if ( ! $result_store_new_ehr_doc->exists )
            {
                return Responses::Failed( 'home' , '' , '<span style="color:blue;">New EHR information did not Save! <br> So the New Photo of patient did not save also if you inserted it!</span>' ) ;
            }

            // If an image was sent by user
            if ( $request->hasFile('image') )
            {
                $store_patient_photo_from_ehr_page = App()->call('App\Http\Controllers\PatientsPhotoController@preparation_file_process_and_upload_image' , [ "request" => $request , "request_keyboard_paraclinic_file_title" => $request->keyboard_paraclinic_file_title , "decrypted_request_patient_id" => $decrypted_request_patient_id ]) ;
                if ( ! $store_patient_photo_from_ehr_page )
                {
                    return Responses::Failed( 'home' , '' , '<span style="color:blue;">New Photo of patient did not save but the other new EHR information have been saved successfully!</span>' ) ;
                }
            }
            return Responses::Success('show_new_saved_ehr' , array( 'EHR_document_id' => encrypt_decrypt('encrypt', $result_store_new_ehr_doc->EHR_document_id ) , 'patient_name' => $request->patient_name ) , '' ) ;
        }
        catch ( QueryException $exception )
        {
            return Responses::FailedWithException('home', '' , '<span style="color:blue;">Can not Save new EHR information!</span>' , $exception ) ;
        }
    }

    public function show_new_saved_ehr( Request $request )
    {
        try
        {
            $result_show_new_saved_ehr = $this->EHRRepository->show_new_saved_ehr( encrypt_decrypt('decrypt', $request->EHR_document_id) ) ;

            /** Use Facade and Strategy Design Pattern to switch between different drivers
            driver->('Telegram') or driver->('SMS') or driver->('Email') to send message to patient **/
            // Strategy Design Pattern With Facade
            // MessageSenderFacade::driver('SmsSenderKavehNegar')->send( $result_show_new_saved_ehr->EHR_document_patient_related_id , $result_show_new_saved_ehr->EHR_document_prescribed_common_drug );
            // Strategy Design Pattern With app() method
            // app(MessageSender::class)->driver('Mailtrap')->send( $result_show_new_saved_ehr->EHR_document_patient_related_id , $result_show_new_saved_ehr->EHR_document_prescribed_common_drug );
            // resolve('', '' ) ;
            // dd(app()->make('PatientsGeneralInfoController')->hello());
            // app()->extend();

            // use Illuminate\Support\Facades\Event;
            //Event::listen('a' , static function ($data)
            //{
            //    dd($data);
            //});
            //
            //Event::dispatch('a' , 'Hello saber') ;

            return Responses::view('EHR::show_new_saved_ehr' ,
            [
                'title_of_page'                            => 'a new EHR information of <b>'.encrypt_decrypt('decrypt',$request->patient_name).'</b> <br> successfully saved at date '.date("Y/m/d") ,
                'show_ehr_report'                          => 'true' ,
                'EHR_document_patient_related_id'          => $result_show_new_saved_ehr->EHR_document_patient_related_id ,
                'EHR_document_prescribed_common_drug'      => $result_show_new_saved_ehr->EHR_document_prescribed_common_drug ,
                'EHR_document_prescribed_common_diet'      => $result_show_new_saved_ehr->EHR_document_prescribed_common_diet ,
                'EHR_document_prescribed_next_appointment' => $result_show_new_saved_ehr->EHR_document_prescribed_next_appointment ,
                'EHR_document_related_clinic_doctor_name'  => $result_show_new_saved_ehr->EHR_document_related_clinic_doctor_name ,
                'EHR_document_dr_related_id'               => find_admin_id_from_users_table() ,
            ] ) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'home' , '' , '<span style="color:blue;">Can not show new saved EHR!</span>' , $exception);
        }
    }

}