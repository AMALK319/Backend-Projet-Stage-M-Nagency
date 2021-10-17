<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Requests\CompanyRepresentative\StoreCompanyRepresentativeRequest;
use App\Mail\EmailVerification;
use App\Models\Company;
use App\Models\CompanyRepresentative;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class CompanyRepresentativeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
            $representatives = CompanyRepresentative::all();


    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(StoreCompanyRepresentativeRequest $request)
    {

        try {

            DB::beginTransaction();
            $attributes = $request->validated();

            unset($attributes['email']);
            unset($attributes['password']);
            $newCompanyRepresentative = CompanyRepresentative::create($attributes);

            $newUser = User::create([
                'email'             =>  $request->email,
                'token'             =>  (string) Str::uuid(),
                'password'          =>  bcrypt($request->password),
                'userable_type'     =>  'App\Models\CompanyRepresentative',
                'userable_id'       =>  $newCompanyRepresentative->id,
                'status' => 1,
                'email_verified_at' => now(),
            ]);

            $token = $newUser->createToken('API Token')->accessToken;




            $newCompany = Company::create([
                'company_address' => $request->company_address,
                'company_name' =>  $request->company_name,
                'representative_id' => $newCompanyRepresentative->id,
                
            ]);

            /* Mail::to($request->get('email'))->send(new EmailVerification($newUser)); */

            DB::commit();
            return response()->json([
                'companyRepresentative' => $newCompanyRepresentative,
                'user' => $newUser,
                'company' => $newCompany,
                'token' => $token,

                'message' => 'CompanyRepresentative and Company created'
            ], 201);



           /*  $newUser->sendEmailVerificationNotification(); */

        } catch (\Throwable $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companyRepresentative = CompanyRepresentative::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
