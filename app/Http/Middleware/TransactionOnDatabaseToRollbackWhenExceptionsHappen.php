<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionOnDatabaseToRollbackWhenExceptionsHappen
{
    /** a Middleware to be ensured all cascade transactions work properly
     and if one of the transactions does not work properly (has an exception) rollback all the previous transactions
     Remember: When you want to use this middleware on a route you have to add ->withException($exception)
     at the end of anything that you have in your try{...} Catch{ ...->withException($exception) } **/
    public function handle( Request $request, Closure $next)
    {
        DB::beginTransaction();
        $response = $next($request);
        /* If the response on database transaction has exception
         it means one of the transactions does not work properly,
         So rollback anything done on database and then return response */
        if ($response->exception) {
            DB::rollBack();
            return $response;
        }
        DB::commit();
        return $response;
    }
}
