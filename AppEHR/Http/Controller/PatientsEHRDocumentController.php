<?php
namespace AppEHR\Http\Controller ;

use App\Http\Controllers\Controller ;
use App\Http\Requests\PatientsEHRDocumentStoreRequest;
use AppEHR\Services\PatientsEHRDocumentsService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Responses\Responses ;
use phpDocumentor\Reflection\Types\InterfaceString;
use AppEHR\MessageSender;
use AppEHR\MessageSenderFacade;

/** In this controller, according to the Single Responsibility and Open-Closed Principles of SOLID We validate user inputs by using middleware.
 Furthermore, we use DB::transaction via middleware for some methods like store() in this controller.
 In addition, to have a cleaner controller, all logic is transferred into the Services Layer.

 Remember that, when in a controller using a method from a Service class, you should pass all the required variable parameters one by one
 It means you should never use Illuminate\Http\Request; in your Service class,
 Because if you do not do this, you will face some problems when you want to write a PHPUnitTest/Job/Que/ArtisanCommand and call a method of this Service class from anywhere else in the future.
 In fact, your Service's methods should be callable from wherever you will need them in the future.
 By definition, a service should take some variables from wherever they come, apply some logic to them, and finally return them.
 So, imagine that your service class is a separate unit, which should be able to deal with variables in the future that will be passed into that form wherever. */

class PatientsEHRDocumentController extends Controller
{
    private $PatientsEHRDocumentsService ;
    public function __construct( PatientsEHRDocumentsService $PatientsEHRDocumentsService )
    {
        $this->PatientsEHRDocumentsService = $PatientsEHRDocumentsService ;
    }

    public function create(Request $request)
    {
        try
        {
            $decrypted_request_patient_id    = encryptDecrypt('decrypt',$request->encrypted_patient_id) ;
            $result_of_patients_photo        = $this->PatientsEHRDocumentsService->resultOfPatientsEHRPhoto($decrypted_request_patient_id)    ;
            $result_of_patients_ehr_document = $this->PatientsEHRDocumentsService->resultOfPatientsEHRDocument($decrypted_request_patient_id) ;

            return Responses::view('EHR::ehr_create' ,
            [
                'title_of_page'                             => 'EHR of Patient'                          ,
                'EHR_document_patient_related_id_encrypted' => $request->encrypted_patient_id            ,
                'EHR_document_dr_related_id'                => findAdminIdFromUsersTable()               ,
                'EHR_document_related_appointment_id'       => $request->appointment_id                  ,
                'EHR_document_related_clinic_doctor_name'   => $request->child_dr_related_name           ,
                'result_of_patients_photo'                  => $result_of_patients_photo                 ,
                'count_result_of_patients_photo'            => $result_of_patients_photo->count()        ,
                'result_of_patients_ehr_document'           => $result_of_patients_ehr_document          ,
                'count_result_of_patients_ehr_document'     => $result_of_patients_ehr_document->count() ,
                'result_of_patients_general_infos'          => $this->PatientsEHRDocumentsService->fetchInfoOfThisPatientId($decrypted_request_patient_id) ,
                'admin_id_from_users_table'                 => findAdminIdFromUsersTable()
            ]) ;
        }
        catch (QueryException $exception)
        {
            return Responses::failedWithException( 'home' , '' , '<span style="color:blue;">Can not display this EHR!</span>' , $exception ) ;
        }
    }

    public function store(PatientsEHRDocumentStoreRequest $request)
    {
        try
        {
            $request_validated            = $request->validated() ;
            $decrypted_request_patient_id = encryptDecrypt('decrypt', $request->encrypted_patient_id ) ;

            if ( ! $this->PatientsEHRDocumentsService->updateThisPatientGeneralInfoFromEHRPage($decrypted_request_patient_id , $request_validated) )
            {
                return Responses::failed( 'home', '' , '<b style="color:blue;">New personal information of patient DOES NOT updated!<br>So, the New Photo and new EHR document information of patient DID NOT save!</b>' ) ;
            }

            $result_store_new_ehr_doc = $this->PatientsEHRDocumentsService->storeNewEHRDoc($request_validated , $decrypted_request_patient_id , $request->all() ) ;
            if ( ! $result_store_new_ehr_doc->exists() )
            {
                return Responses::Failed( 'home' , '' , '<b style="color:blue;">New EHR document information and Photo of patient DID NOT save!<br>But New personal information of patient UPDATED successfully!</b>' ) ;
            }

            $is_photo_uploaded = '';
            // If an image was sent from form
            if ( $request->hasFile('image') )
            {
                $result_upload_photo = $this->PatientsEHRDocumentsService->storePatientPhotoFromEHRPage( $request , $decrypted_request_patient_id ) ;
                if($result_upload_photo->exists)
                {
                    $is_photo_uploaded = 'true';
                }
                else
                {
                    return Responses::Failed('home', '', '<b style="color:blue;">New Photo of patient DID NOT save!<br>But the new EHR document information and New personal information have been saved successfully!</b>');
                }
            }

            return Responses::Success('ehr.show' , [ 'encrypted_ehr_id' => encryptDecrypt('encrypt', $result_store_new_ehr_doc->EHR_document_id ) , 'encrypted_patient_name' => $request_validated['encrypted_patient_name'] , 'is_photo_uploaded' => $is_photo_uploaded ] , '' ) ;
        }
        catch ( QueryException $exception )
        {
            return Responses::failedWithException('home', '' , '<b style="color:blue;">Because of an error, we CAN NOT save the new EHR information, new personal information and new photo of this patient!</b>' , $exception ) ;
        }
    }

    public function show(Request $request)
    {
        try
        {
            $result_show_new_saved_ehr = $this->PatientsEHRDocumentsService->resultOfShowNewSavedEHR($request->encrypted_ehr_id) ;
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

            return Responses::view('EHR::ehr_show' ,
            [
                'title_of_page'                            => 'a new EHR information of <b>'.encryptDecrypt('decrypt', $request->encrypted_patient_name).'</b> <br> successfully saved at date '.date("Y/m/d") ,
                'EHR_document_patient_related_id'          => $result_show_new_saved_ehr->EHR_document_patient_related_id ,
                'EHR_document_prescribed_common_drug'      => $result_show_new_saved_ehr->EHR_document_prescribed_common_drug ,
                'EHR_document_prescribed_common_diet'      => $result_show_new_saved_ehr->EHR_document_prescribed_common_diet ,
                'EHR_document_prescribed_next_appointment' => $result_show_new_saved_ehr->EHR_document_prescribed_next_appointment ,
                'EHR_document_related_clinic_doctor_name'  => $result_show_new_saved_ehr->EHR_document_related_clinic_doctor_name ,
                'EHR_document_dr_related_id'               => findAdminIdFromUsersTable() ,
                'is_photo_uploaded'                        => $request->is_photo_uploaded
            ] ) ;
        }
        catch (QueryException $exception)
        {
            return Responses::failedWithException( 'home' , '' , '<span style="color:blue;">Can not show new saved EHR!</span>' , $exception);
        }
    }
}