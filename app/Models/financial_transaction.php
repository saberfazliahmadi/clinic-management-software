<?php
namespace App\Models;

use Database\Factories\FinancialTransactionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class financial_transaction extends Model
{
    use SoftDeletes , HasFactory ;
    protected $primaryKey = 'financial_transaction_id';
    protected $fillable =
        [
            'financial_dr_related_id',
            'financial_patient_related_id',
            'financial_appointment_related_id',
            'financial_transaction_type',
            'financial_transaction_date',
            'financial_transaction_time',
            'financial_transaction_title',
            'financial_transaction_amount',
            'financial_transaction_child_dr_related_name'
        ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return new FinancialTransactionFactory;
    }

    public static function destroyThisFinancialTransaction($delete_this_financial_id)
    {
        return self::
        select(['financial_transaction_id', 'financial_dr_related_id'])
        ->where('financial_transaction_id', $delete_this_financial_id)
        ->equalThisToAdminIdFromUserTable('financial_dr_related_id')
        ->limit('1')
        ->delete();
    }

    public static function resultFetchLast10Transactions()
    {
        return self::
        equalThisToAdminIdFromUserTable('financial_dr_related_id')
        ->latest('financial_transaction_id')
        ->SimplePaginate('10');
    }

    public static function storeShowSubmitFinancialTransactionForm($medical_document_number_of_patient, $financial_transaction_type, $financial_transaction_date, $financial_transaction_time, $title_of_payment, $amount_of_payment, $financial_transaction_child_dr_related_name )
    {
        return self::create(
        [
            'financial_dr_related_id'      => findAdminIdFromUsersTable() ,
            'financial_patient_related_id' => $medical_document_number_of_patient ,
            'financial_transaction_type'   => $financial_transaction_type ,
            'financial_transaction_date'   => $financial_transaction_date ,
            'financial_transaction_time'   => $financial_transaction_time ,
            'financial_transaction_title'  => $title_of_payment ,
            'financial_transaction_amount' => $amount_of_payment ,
            'financial_transaction_child_dr_related_name' => $financial_transaction_child_dr_related_name
        ] ) ;
    }

    public static function resultFetchReceiveOrPayTransactionsFromDateToDate($financial_transaction_type = '+' , $sign_trick_1 , $financial_transaction_child_dr_related_name_text_trick , $sign_trick_2 , $financial_transaction_title_text_trick , $financial_report_from_date , $financial_report_to_date )
    {
        return self::
        where( [ 'financial_dr_related_id'    => findAdminIdFromUsersTable() ,
                 'financial_transaction_type' => $financial_transaction_type
                 ] )
        ->where('financial_transaction_child_dr_related_name' , $sign_trick_1 , $financial_transaction_child_dr_related_name_text_trick )
        ->where('financial_transaction_title'                 , $sign_trick_2 , $financial_transaction_title_text_trick )
        ->whereBetween('financial_transaction_date', [$financial_report_from_date, $financial_report_to_date])
        ->latest('financial_transaction_id')
        ->get() ;
    }

    public static function storeNewFinancialTransactionForThisAppointment($admin_id_from_users_table, $appointment_patient_related_id, $request_appointment_id, $show_all_appointments_on_this_date, $show_all_appointments_on_this_time, $appointment_service_type, $money_receive_header_console, $appointment_child_dr_related_name)
    {
        return self::create(
        [
            'financial_dr_related_id'          => $admin_id_from_users_table ,
            'financial_patient_related_id'     => $appointment_patient_related_id ,
            'financial_appointment_related_id' => $request_appointment_id ,
            'financial_transaction_type'       => '+' ,
            'financial_transaction_date'       => $show_all_appointments_on_this_date ,
            'financial_transaction_time'       => $show_all_appointments_on_this_time ,
            'financial_transaction_title'      => $appointment_service_type ,
            'financial_transaction_amount'     => $money_receive_header_console ,
            'financial_transaction_child_dr_related_name' => $appointment_child_dr_related_name
        ]) ;
    }
}
