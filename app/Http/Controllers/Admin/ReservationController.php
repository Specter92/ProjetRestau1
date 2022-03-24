<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use DateTime;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        // récupère toutes les réservations, en les triant par jour puis par heure
        $today = new DateTime();
        // on fixe l'heure et les minutes à zéro
        $today->setTime(0, 0);
        // récupère les réservations à partir d'aujourd'hui et plus tard, en les triant par jour puis par heure
        $reservations = Reservation::select()
            ->where('date', '>=', $today->format('Y-m-d'))
            ->orderBy('date')
            ->orderBy('heure')
            ->get();

           return view ('admin.reservation.index', [
               'reservations' => $reservations,
           ]);
    }

    public function edit(int $id)
    {

        $reservation = Reservation::find($id);

        if (!$reservation) {
            $message = "La réservation {$id} n'existe pas";
            return response()->view('non trouvé', [
                'message'=>$message, 
            ], 404);
        }

            $now = new DateTime();

            if ($reservation->confirmation === 0) {
                //annulé
                $reservation->confirmation = '0';
            } elseif ($reservation->confirmation === 1) {
                //confirmé
                $reservation->confirmation = '1';
            } else {
                //en attente
                $reservation->confirmation = 'null';
            }

            return view('admin.reservation.edit', [
                'reservation' => $reservation,
                'now' => $now,
            ]);
    }

    public function update (Request $request, int $id)
    {
       $reservation = Reservation::find($id);
       if (!$reservation) {
        $message = "La réservation {$id} n'existe pas";
        return response()->view('non trouvé', [
            'message'=>$message,
        ], 404);
    }
    $rules = $this->getRules();
    $validated = $request->validate($rules);

    $reservation = $this->formToModel($validated, $reservation);
    $reservation->save();

    return redirect()->route('admin.reservation.edit',[
        'id' => $reservation->id,
    ]);

    } 

    public function create()
    {
        $reservation = new Reservation();
        $now = new DateTime();
        $reservation->date = $now->format('Y-m-d');
        $reservation->heure = $now->format('H:i');
        $reservation->confirmation = "null";

        return view('admin.reservation.create', [
            'reservation' => $reservation,
            'now' => $now,
        ]);
    }

    public function store(Request $request)
    {
       
        // @fixme messages en anglais, utiliser laravel-lang, c'est le nom du champ qui apparait
        $rules = $this->getRules();
        $validated = $request->validate($rules);

        $reservation = new Reservation();
        $reservation = $this->formToModel($validated, $reservation);
        $reservation->save();

        return redirect()->route('admin.reservation.edit',[
            'id' => $reservation->id,
        ]);
    }
    public function destroy(int $id)
    {
        $reservation = Reservation::find($id);
       if (!$reservation) {
        $message = "La réservation {$id} n'existe pas";
        return response()->view('non trouvé', [
            'message'=>$message,
        ], 404);
        }

    $reservation->delete();

    return redirect()->route('admin.reservation.index');
    }

    public function getRules()
    {
        $today = new DateTime();
        //on fixe l'heure et les minutes a zéro
        $today->setTime(0, 0);

        return [
            //interdit d'utiliser des chiffres'not_regex:/[0-9]+/'
            'nom' => ['required', 'max:190', 'not_regex:/[0-9]+/'],
            // @todo valider le tél avec une regex /^[0-9+() ]+$/, Obligation d'utiliser des chiffres 'regex:/^\+?[0-9() ]+$/'
            'tel' => ['required', 'max:190', 'regex:/^\+?[0-9() ]+$/'],
            // @fixme date non valide, utiliser DateTime::setTime()
            //'date' => ['required', 'date', 'after_or_equal:today'],
            'date' => ['required', 'date', 'after_or_equal:'.$today->format('Y-m-d')],
            'heure' => ['required'],
            'couverts' => ['required', 'integer', 'between:1,12'],
            // @todo commentaires, utiliser nullable
            'commentaires' => ['nullable', 'max:500'],
            'confirmation' => ['required', 'in:null,0,1'],
        ];
    }

    public function formToModel(array $validated, Reservation $reservation): Reservation
   
    {
        $reservation->nom = $validated['nom'];
        $reservation->tel = $validated['tel'];
        $reservation->date = $validated['date'];
        $reservation->heure = $validated['heure'];
        $reservation->couverts = $validated['couverts'];
        if (empty($validated['commentaires'])) {
            $reservation->commentaires = "";
        } else {
        $reservation->commentaires = $validated['commentaires'];
    }
        if ($validated['confirmation'] == '0') {
            //annulé
            $reservation->confirmation = 0;
        } elseif ($validated['confirmation'] == '1') {
            //confirmé
            $reservation->confirmation = 1;
        } else {
            // en attente
            $reservation->confirmation = null;
        }

        return $reservation;
    }
}