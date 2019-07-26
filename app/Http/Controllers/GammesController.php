<?php

namespace App\Http\Controllers;

use App\Gamme;
use App\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GammesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gammes = Gamme::all();
        return view('gammes.index',compact('gammes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gammes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$request->validate([
    		'nom' => 'required|unique:gammes'
	    ]);

        Gamme::create([
        	'nom' => $request->nom
        ]);

        return redirect(route('gammes.index'))->with('message','Gamme créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gamme $gamme)
    {
	    $submissions = Submission::whereIn('item_id',$gamme->items->pluck('id'))->get();
	    $data = DB::table('submissions')
	              ->selectRaw('value as label , COUNT() as data')
	              ->join('items','submissions.item_id','=','items.id')
	              ->whereIn('item_id',$gamme->items->pluck('id'))
	              ->groupBy('label')
	              ->get() ;
		return view('gammes.show',compact('gamme','submissions','data'));
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
        //
    }

    public function addItem(Gamme $gamme,Request $request)
    {
    	$gamme->items()->create([
    		'nom' => $request->nom
	    ]);

    	return back()->with('message','Item ajouté a la gamme');
    }

    public function showForm(Gamme $gamme)
    {
    	return view('gammes.form',compact('gamme'));
    }

    public function submitForm(Request $request,Gamme $gamme)
    {
	    $dataArray = [];
	    foreach($request['item_id'] as $key => $value){
		    // create new empty object
		    $ob = new \stdClass;
		    $ob->item_id = $request['item_id'][$key];
		    $ob->value = $request['value'][$key];

		    // push the new object to the array
		    $dataArray[] = $ob;
	    }

	    foreach ($dataArray as $submission)
	    {
	    	Submission::create([
	    		'item_id' => $submission->item_id,
			    'value' => $submission->value,
			    'user_id' => auth()->id()
		    ]);
	    }

	    return redirect(route('gammes.show',$gamme->id))->with('message','Formulaire soumis avec succès');
    }
}
