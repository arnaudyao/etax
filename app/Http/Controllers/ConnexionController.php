<?php

namespace App\Http\Controllers;

use App\Helpers\Crypt;
use App\Helpers\Email;
use App\Helpers\Envoisms;
use App\Helpers\GenerateCode as Gencode;
use App\Helpers\Menu;
use App\Helpers\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Session;
use DB;
use Carbon\Carbon;
use Hash;


class ConnexionController extends Controller
{
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function login(Request $request)
    {

        $logo = Menu::get_logo();

        $key = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required',
            ], [
                'username.required' => 'Veuillez saisir votreidentifiant.',
                'password.required' => 'Veuillez saisir le mot de passe.',
            ]);
            $data = $request->input();

            $pass = $key . '+' . $data['password'];
//dd($data);die();
            if (Auth::attempt(['email' => $data['username'], 'password' => $data['password']])) {
                // echo "succes";die;

                $dbinfo = DB::table('users')->where([['email', '=', $data['username']]])->first();
                $flag = $dbinfo->flag_mdp;
                if ($flag == true) {
                    Session::put('userSession', $data['username']);
                } else {
                    return redirect('/modifiermotdepasse')->with('success', 'Succès:  Modifier votre mot de passe à la première connexion.');
                }

                return redirect('/dashboard')->with('success', 'Bonjour ' . Auth::user()->name . ' ' . Auth::user()->prenom_users . ',  Bienvenue sur le portail de ' . @$logo->mot_cle);

            } elseif (Auth::attempt(['cel_users' => $data['username'], 'password' => $data['password']])) {

                //  echo "succes";die;

                $dbinfo = DB::table('users')->Where([['cel_users', '=', $data['username']]])->first();
                $flag = $dbinfo->flag_mdp;
                if ($flag == true) {
                    Session::put('userSession', $data['username']);
                } else {
                    return redirect('/modifiermotdepasse');
                }

                return redirect('/dashboard')->with('success', 'Bonjour ' . Auth::user()->name . ' ' . Auth::user()->prenom_users . ',  Bienvenue sur le portail de ' . @$logo->mot_cle);

            } elseif (Auth::attempt(['login_users' => $data['username'], 'password' => $data['password']])) {
                // echo "succes";die;
                $dbinfo = DB::table('users')->where([['login_users', '=', $data['username']]])->first();
                $flag = $dbinfo->flag_mdp;
                if ($flag == true) {
                    Session::put('userSession', $data['username']);
                } else {
                    return redirect('/modifiermotdepasse')->with('success', 'Info: Veuillez modifier votre mot de passe à la première connexion.');
                }
                return redirect('/dashboard')->with('success', 'Bonjour ' . Auth::user()->name . ' ' . Auth::user()->prenom_users . ',  Bienvenue sur le portail de ' . @$logo->mot_cle);
            } else {

                return redirect('/connexion')->with('error', 'Mot de passe ou email incorrect');

            }
        }

        return view('connexion.login');
    }

    public function dashboard()
    {

        if (Session::has('userSession')) {
        } else {
            return redirect('/login')->with('error', 'Veuillez-vous identifier');
        }

        $idutil = Auth::user()->id;
        $idutilClient = Auth::user()->id_partenaire;
        $naroles = Menu::get_menu_profil($idutil);
        $nacodes = Menu::get_code_menu_profil($idutil);
        $dataUser = User::where([['flag_actif_users', '=', true], ['flag_demission_users', '=', false], ['flag_admin_users', '=', false]])->get();
        $ResultContrib = \Illuminate\Support\Facades\DB::table('vm_contribuable', 'vf')
            ->select([
                DB::raw('count(vf.ncc) as nccnb')
            ])
            ->first();

        $ResultPaiement = \Illuminate\Support\Facades\DB::table('vm_paiements', 'vf')
            ->select([
                DB::raw('SUM(vf.montant_fpc_regle) as montant_fpc_regle'),
                DB::raw('SUM(vf.montant_tap_regle) as montant_tap_regle')
            ])
            ->first();

        // Vérifiez que les données existent
        $montant_fpc = $ResultPaiement->montant_fpc_regle ?? 0;
        $montant_tap = $ResultPaiement->montant_tap_regle ?? 0;

        $labels = ['FPC', 'TAP'];
        $series = [$montant_fpc, $montant_tap];
       // dd(json_encode($series))
        // ---------------------------------

        $ResultPaiementAnnee = DB::table('vm_paiements as vf')
            ->select([
                'vf.exercice_imposition',
                DB::raw('SUM(vf.montant_fpc_regle + vf.montant_tap_regle) as montant_total')
            ])
            ->groupBy('vf.exercice_imposition')
            ->orderBy('vf.exercice_imposition')
            ->get();
        // Préparer les données pour le graphique
        $categories = $ResultPaiementAnnee->pluck('exercice_imposition')->toArray(); // Années
        $montants = $ResultPaiementAnnee->pluck('montant_total')->toArray();


        // -----Liste des paiements par années (20 dernières lignes)----------------------
        $ResultPaiement20 = \Illuminate\Support\Facades\DB::table('vm_declarations as vd')
            ->leftJoin('vm_paiements as vf', 'vd.impot_id', '=', 'vf.impot_id')
            ->leftJoin('vm_contribuable as vc', 'vd.ncc', '=', 'vc.ncc')
            ->select([
                'vc.ncc',
                'vf.exercice_imposition',
                'vc.raison_sociale',
                'vf.periode_imposition',
                'vf.montant_fpc_regle',
                'vf.montant_tap_regle',
                'vd.montant_fpc',
                'vd.montant_tap',
                'vd.impot_origine_id',
                'vf.date_paiement'
            ])
            ->where([
                ['vf.date_paiement', '<>', null],
                ['vf.paiement_statut_id', '=', '3']
            ])
            ->orderBy('vf.date_paiement', 'desc') // Trier par période d'imposition (par exemple)
            ->take(20) // Prendre uniquement les 20 dernières lignes
            ->get();


        return view('dashboard.dashboard')->with(
            compact('naroles',
                'dataUser',
                'idutilClient',
                'nacodes',
                'ResultPaiement',
                'ResultContrib',
                'categories', 'montants',
                'series','labels','ResultPaiement20'
            )
        );
    }


    public function motdepasseoublie(Request $request)
    {

        $logo = Menu::get_logo();

        if ($request->isMethod('post')) {


            $this->validate($request, [
                'username' => 'required',
            ]);

            $data = $request->input();

            $resultat = DB::table('users')->where([['email', '=', $data['username']]])->orwhere([['cel_users', '=', $data['username']]])->first();

            //dd($resultat);die();

            if (isset($resultat)) {

                //dd($resultat->id);die();

                $passwordCli = Crypt::MotDePasse();// '123456789';
                $password = Hash::make($passwordCli);

                User::where([['id', '=', $resultat->id]])->update(['password' => $password, 'flag_mdp' => 0]);

                if (isset($resultat->email)) {

                    $messages = 'Bonjour ' . $resultat->name . ' ' . $resultat->prenom_users . ', Votre compte sur la plateforme de Olympe group est disponible. ' . chr(13) . chr(10) . 'Voici vos acces: ' . chr(13) . chr(10) . 'Identifiant : ' . $resultat->email . ' ' . chr(13) . chr(10) . 'Mot de passe : ' . $passwordCli . ' ' . chr(13) . chr(10) . 'Lien :  ';

                }

                if (isset($resultat->cel_users)) {

                    $messages = 'Bonjour ' . $resultat->name . ' ' . $resultat->prenom_users . ', Votre compte sur la plateforme de Olympe group est disponible. ' . chr(13) . chr(10) . 'Voici vos acces: ' . chr(13) . chr(10) . 'Identifiant : ' . $resultat->cel_users . ' ' . chr(13) . chr(10) . 'Mot de passe : ' . $passwordCli . ' ' . chr(13) . chr(10) . 'Lien :  ';

                }

                if (isset($resultat->email) and isset($resultat->cel_users)) {

                    $messages = 'Bonjour ' . $resultat->name . ' ' . $resultat->prenom_users . ', Votre compte sur la plateforme de Olympe group est disponible. ' . chr(13) . chr(10) . 'Voici vos acces: ' . chr(13) . chr(10) . 'Identifiant : ' . $resultat->email . ' ' . chr(13) . chr(10) . 'Mot de passe : ' . $passwordCli . ' ' . chr(13) . chr(10) . 'Lien :  ';

                }


                $message = $messages;
                $contactClient = str_replace(' ', '', $resultat->cel_users);

                if (isset($contactClient) and !isset($resultat->email)) {

                    Envoisms::get_envoisms($resultat->indicatif_cel_users . $contactClient, $message);
                }

                if (isset($resultat->email) and !isset($resultat->cel_users)) {

                    $sujet = "Renouvellement des acces";
                    $titre = "Bienvenue sur " . @$logo->mot_cle . " ";
                    $messageMail = "<b>Bonjour  $resultat->name   $resultat->prenom_users ,</b>
                            <br><br>Veuillez trouver ci-après, vos accès à la plateforme de '. $logo->mot_cle .' .
                            <br><br>
                            <br><b>Identifiant : </b> $resultat->email
                            <br><b>Mot de passe : </b> $passwordCli
                            <br><br><br>
                            -----
                            Ceci est un mail automatique, Merci de ne pas y répondre.
                            -----
                            ";


                    $messageMailEnvoi = Email::get_envoimailTemplate($resultat->email, $resultat->name, $messageMail, $sujet, $titre);

                }

                if (isset($resultat->email) and isset($resultat->cel_users)) {

                    $sujet = "Renouvellement des acces";
                    $titre = "Bienvenue sur " . @$logo->mot_cle . " ";
                    $messageMail = "<b>Bonjour  $resultat->name  $resultat->prenom_users  ,</b>
                            <br><br>Veuillez trouver ci-après, vos accès à la plateforme de '. $logo->mot_cle .' .
                            <br><br>
                            <br><b>Identifiant : </b>  $resultat->email
                            <br><b>Mot de passe : </b>  $passwordCli
                            <br><br><br>
                            -----
                            Ceci est un mail automatique, Merci de ne pas y répondre.
                            -----
                            ";


                    $messageMailEnvoi = Email::get_envoimailTemplate($resultat->email, $resultat->name, $messageMail, $sujet, $titre);

                    Envoisms::get_envoisms($resultat->indicatif_cel_users . $contactClient, $message);

                    //dd($messageMailEnvoi);
                }

                return redirect('motdepasseoublie')->with('success', 'Vos acces ont été envoyés par SMS et Email');

            } else {
                return redirect('motdepasseoublie')->with('error', 'Erreur nous avons pas trouvé votre compte');
            }
        }

        return view('connexion.motdepasseoublie');
    }
}
