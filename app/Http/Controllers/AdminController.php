<?php

namespace App\Http\Controllers;

use App\Notifications\SendEmailToAdminAfterRegistrationNotification;
use App\Http\Requests\storeAdminRequest;
use App\Http\Requests\updateAdminRequest;
use App\Http\Requests\submitDefineAccessRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Models\ResetCodePassord;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request){
        //$admins = User::paginate(10);
        //return view('admins/index',compact('admins'));

        // Récupérer le mot-clé de recherche
        $search = $request->input('search');

        // Chercher dans la table des utilisateurs (par exemple, selon le nom ou l'email)
        $admins = User::query()
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })
        ->paginate(10);

        return view('admins.index', compact('admins', 'search'));
    }
    public function create(){
        return view('admins/create');
    }
    public function edit(User $user){
        return view('admins/edit',compact('user'));
    }

    //Enregistrer un administrateur en BD et envoyer un mail
    public function store(storeAdminRequest $request){
        try {
            //logique de creation de compte
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('default');
            $user->save();

            //Envoyer un email pour que l'utilisateur puisse confirmer son compte

            //Envoyer le code par email pour vérification
            if($user){
                try {
                    ResetCodePassord::where('email', $user->email)->delete();
                    $code = rand(1000, 4000);
                    $data = [
                        'code'=>$code,
                        'email'=>$user->email
                    ];
                    ResetCodePassord::create($data);
                    Notification::route('mail',$user->email)->notify(new SendEmailToAdminAfterRegistrationNotification($code, $user->email));

                    //Rediriger l'utilistaeur vers une URL
                    return redirect()->route('administrateurs')->with('success_message','Administrateur ajouté avec succès');
                } catch (Exception $e) {
                    dd($e);
                    //throw new Exception('Une erreur est survenue lors de l\'envoie du mail');
                }
            }
        } catch (Exception $e) {
            //dd($e);
            throw new Exception('Une erreur est survenue lors de la création de cet administrateur');
        }
    }
    public function update(updateAdminRequest $request, User $user){
        try {
            //logique de mise à jour de compte
        } catch (Exception $e ) {
            //dd($e);
            throw new Exception('Une erreur est survenue lors de la mise à jour des informations de cet administrateur');
        }
    }
    public function delete(User $user){
        try {
            //logique de suppression de compte
            $connectedAdminId = Auth::user()->id;
            if($connectedAdminId!==$user->id){
                $user->delete();
                return redirect()->back()->with('success_message','L\'administrateur a été suprimé avec succès');
            }else{
                return redirect()->back()->with('error_msg','Vous ne pouvez pas supprimer votre compte administrateur');
            }
            //L'admin connécté ne puisse pas supprimer son compte
        } catch (Exception $e ) {
            //dd($e);
            throw new Exception('Une erreur est survenue lors de la suppression du compte de cet administrateur');
        }
    }

    public function defineAccess($email){ 
        $checkUserExist = User::where('email', $email)->first();
        if($checkUserExist){
            return view('auth.validate-account',compact('email'));
        }else{
            //Rediriger sur une route 404  
            //return redirect()->route('login');
        };
    }

    public function submitDefineAccess(submitDefineAccessRequest $request){
        try {
            $user = User::where('email', $request->email)->first();
            if($user){
                $user->password = Hash::make($request->password);
                $user->email_verified_at = Carbon::now();
                $user->update();
                return redirect()->route('login')->with('success_msg','Vos accès ont été correctement défini');
            }else{
                //404
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
