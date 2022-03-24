<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Plat;
use App\Models\Etiquette;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DateTime;

class MainController extends Controller
{
    public function index()
    {
        return view ('main.index',[
       
        ]);
    }

    public function test1()
    {
        return view('main.reservation');
    }

    public function contact()
    {
        $message = 'foo bar baz';

        return view ('main.contact',[
        'message' => $message,
        ]);
    }
    public function carte()
    {
        $message = 'foo bar baz';

        return view ('main.carte',[
        'message' => $message,
        ]);
    }


    public function test()
    {

        //on recupere tt les plats 
        //$plats = Plat::all();        

        //on recupere tous les plats par ordre alphabetique de la colonne nom
       $plats = Plat::select()->orderBy('nom')->get();

       foreach($plats as $plat){
           dump('plat');
            dump($plat->id);
            dump($plat->nom);
            dump($plat->prix);
            
            $categorie = $plat->categorie()->first();

            dump($categorie->id);
            dump($categorie->nom);
            dump($categorie->description);
            dump('##la categorie');
            $etiquettes = $plat->etiquettes()->get();

            foreach($etiquettes as $etiquette){
                dump($etiquette->id);
                dump($etiquette->nom);
                dump($etiquette->description);
            }

       }
        

        $etiquettes = Etiquette::select()->orderBy('nom')->get();


        foreach ($etiquettes as $etiquette){
            dump($etiquette->id);
            dump($etiquette->nom);
            dump($etiquette->description);

            $plats = $etiquette->plats()->get();

            foreach($plats as $plat){
                dump($plat->id);
                dump($plat->nom);
                dump($plat->description);
                dump($plat->prix);
            }
        }


        //  $categories = Categorie::all();
        //on recupere tous les plats par ordre alphabetique de la colonne nom
        $categories = Categorie::select()->orderBy('nom')->get();

        foreach ($categories as $categorie){
            //enregistre des données log dans le fichier test logs/laravel.log
        log::debug($categories);
        dump($categorie->id);
        dump($categorie->nom);
        dump($categorie->description);

        $plats = $categorie->plats()->get();

        foreach ($plats as $plat){
            dump($plat->id);
            dump($plat->nom);
            dump($plat->description);
            dump($plat->prix);
        }

    }
        exit();
    }
    public function testReservation()
    {
        $reservation = new Reservation();
        $reservation->nom ='toto';
        $reservation->tel ='0683935688';
        $reservation->date ='2022-04-01';
        $reservation->heure ='18:00';
        $reservation->couverts ='200';
        //attention il ne faut pas definir la confirmation
        
        //enregistrement des données
        $reservation->save();


        //recupere la reservation dont l'id=1
       $reservation = Reservation::find(1);
       //modif des données
       $reservation->confirmation = false;
       //enregistrement des données
       $reservation->save();

       $reservation = Reservation::select()->orderBy('id','desc')->first();

       //suppression de l'élément
        $reservation->delete();

        //Recupere ttes les réservation en les triant par date puis par heure 
       $reservations = Reservation::select()->orderBy('date')->orderBy('heure')->get();

       foreach($reservations as $reservation) {
           dump('#reservation');
            dump($reservation->id);
            dump($reservation->nom);
            dump($reservation->tel);
            dump($reservation->date);
            dump($reservation->heure);
            dump($reservation->couverts);
            dump($reservation->confirmation);
            dump($reservation->created_at);
       }
       echo 'toto';

    }

    public function reservation(Reservation $reservation)
    {
        $reservation = new Reservation();
        // @fixme les valeurs par défaut doivent être définies dans le modèle
        $now = new DateTime();
        $reservation->date = $now->format('Y-m-d');
        $reservation->heure = $now->format('H:i');
        $reservation->confirmation = 'null';

        return view('main.reservation', [
            'reservation' => $reservation,
            'now' => $now,
        ]);
    }

    public function formToModel(array $validated, Reservation $reservation): Reservation
    {
        $reservation->nom = $validated['nom'];
        $reservation->tel = $validated['tel'];
        $reservation->date = $validated['date'];
        $reservation->heure = $validated['heure'];
        $reservation->couverts = $validated['couverts'];
        if (empty($validated['commentaires'])) {
            $reservation->commentaires = '';
        } else {
            $reservation->commentaires = $validated['commentaires'];
        }

        if ($validated['confirmation'] == '0') {
            // annulé
            $reservation->confirmation = 0;
        } elseif ($validated['confirmation'] == '1') {
            // confirmé
            $reservation->confirmation = 1;
        } else {
            // en attente
            $reservation->confirmation = null;
        }

        return $reservation;
    }

    public function store(Request $request)
    {
        $rules = $this->getRules();
        $validated = $request->validate($rules);

        $reservation = new Reservation();
        $reservation = $this->formToModel($validated, $reservation);
        $reservation->save();

        return redirect()->route('main.reservation', [
           
        ]);
    }

    public function getRules()
    {
        $today = new DateTime();
        // on fixe l'heure et les minutes à zéro
        $today->setTime(0, 0);

        // @fixme dans les messages d'erreurs, c'est le nom du champ dans la BDD qui est utilisé
        return [
            // interdiction d'utiliser des chiffres 'not_regex:/[0-9]+/'
            'nom' => ['required', 'min:2', 'max:190', 'not_regex:/[0-9]+/'],
            // obligation d'utiliser des chiffres, parenthèses, des plus ou des espaces 'regex:/^\+?[0-9() ]+$/'
            'tel' => ['required', 'max:190', 'regex:/^\+?[0-9() ]+$/'],
            // @fixme dans le message d'erreur, le mot clé today n'est pas traduit
            // 'date' => ['required', 'date', 'after_or_equal:today'],
            'date' => ['required', 'date', 'after_or_equal:'.$today->format('Y-m-d')],
            'heure' => ['required'],
            'couverts' => ['required', 'integer', 'between:1,12'],
            'commentaires' => ['nullable', 'max:500'],
            'confirmation' => ['required', 'in:null,0,1'],
        ];
    }



    
}
