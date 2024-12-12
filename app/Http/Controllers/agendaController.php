<?php

namespace App\Http\Controllers;

use App\Models\agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\slots;
use App\Models\User;
use App\Models\pending;

class agendaController extends Controller
{
    public function agendaIndex() {
        //request alle agenda data
        $unsorted = agenda::all();
        //sorteer data op tijd
        $agenda = $unsorted->sortBy("begin");
        $image = User::with('media')->get();

        return view('agendaIndex')->with('agenda', $agenda)->with('image', $image);
    }

    public function store(Request $request) {
        //validation van agenda aanamken
        $request->validate([
            'begin' => 'required',
            'eind' => 'required',
            'slots' => 'required',
            'titel' => 'required|max: 20',
        ]);
        //reest alle velden en maak nieuwe data aan voor agenda
        $agenda = new agenda;
        $agenda->begin = $request->input('begin');
        $agenda->eind = $request->input('eind');
        $agenda->slots = $request->input('slots');
        $agenda->titel = $request->input('titel');
        $agenda->save();
        return redirect('/agendaIndex');
    }
    public function index() {
        return view('agendaCreate');
    }

    public function adduser($id, $agendaId) {
        //aanmelding agenda punt
        $slot = new slots;
        $user = user::find($id);
        $slot->userId = $user->id;
        $slot->username = $user->name;
        $slot->agendaId = $agendaId;

        //als user al eerder heeft proberen aan te melden
        $double = slots::where('agendaId', $agendaId)->where('userid', $id)->get();
        //in geval eerste keer aanmelden saven
        if($double->isEmpty()){
            $slot->save();
            return redirect()->back();
        }
        //al een bestaande slot voor agenda
        else {
            return redirect()->back();
        }
    }

    public function pending($id) {
        //pending pagina schuur admin

        $slot = slots::where('agendaId', $id)->get();

        return view("agendaPending")->with('slot', $slot);
    }

    public function accept($id, $us) {
        //accepteren van user naar chillings
        //zoek aanmeldings slot en agenda punt
        $slot = slots::find($id);
        $agenda = agenda::find($slot->agendaId);
        $pend = pending::where('agendaId', $slot->agendaId)->get();
        $pending = new pending;
        $pending->username = $us;
        $pending->agendaId = $slot->agendaId;
        $double = pending::where('agendaId', $slot->agendaId)->where('username', $pending->username)->get();
        //als user al een slot gevuld heeft in agenda of al vol zit redirect->back()
        $i = 0;
        foreach($pend as $penda) {
            $i++;
            if($i == $agenda->slots){
                return redirect('/agendaIndex')->with('agenda', $agenda);
            }
        }
        if($double->isEmpty()){
            $slot->delete();
            $pending->save();
            return redirect('/agendaIndex')->with('agenda', $agenda);
        }
        else {
            return redirect('/agendaIndex')->with('agenda', $agenda);
        }
    }

    public function decline($id) {
        $agenda = agenda::all();
        $slot = slots::find($id);

        $slot->delete();

        return redirect('/agendaIndex')->with('agenda', $agenda);
    }

    public function kick($us, $id) {
        //het kicken van user die al geaccepteerd is
        $pending = pending::where('username', $us)->where('agendaId', $id);
        $pending->delete();
        return redirect()->back();
    }
}
