<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use App\Models\RaffleType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View
    {
        $raffle_types = RaffleType::all();
        $raffles = Raffle::all();

        return view('raffle.index', compact('raffle_types'), compact('raffles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View
    {
        $raffle_types = RaffleType::all();

        return view('raffle.create', compact('raffle_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:raffles,name',
            'phone' => 'required',
            'raffle_type_id' => 'required|exists:raffle_types,id',
        ]);

        $raffle = new Raffle();
        $raffle->fill($request->only($raffle->getFillable()));
        $raffle->save();

        $notification = array(
            'message' => 'The Raffle for ' . $raffle->name . ' was successfully created!',
            'alert-type' => 'success'
        );

        return redirect()->route('raffle.index')->with($notification);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Raffle $raffle
     * @return Application|Factory|View
     */
    public function edit(Raffle $raffle): View
    {
        $raffle_types = RaffleType::all();

        return view('raffle.edit', compact('raffle_types'), compact('raffle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Raffle $raffle
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Raffle $raffle): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:raffles,id,'.$raffle->id,
            'phone' => 'required',
            'raffle_type_id' => 'required|exists:raffle_types,id',
        ]);

        $raffle->update($request->only($raffle->getFillable()));
        $raffle->save();

        $notification = array(
            'message' => 'The Raffle for ' . $raffle->name . ' was successfully created!',
            'alert-type' => 'success'
        );

        return redirect()->route('raffle.index')->with($notification);
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

    /**
     * Pick Raffle winners
     *
     * @return Application|Factory|View
     */
    public function pick(): View
    {
        $raffle_types = RaffleType::all();

        return view('raffle.pick', compact('raffle_types'));
    }

    /**
     * Pick Raffle winners
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function winners(Request $request): \Illuminate\Http\JsonResponse
    {
        $raffle_type_id = $request->post('raffle_type_id');
        $how_many_winners = $request->post('how_many_winners');

        $winners = Raffle::where('raffle_type_id', $raffle_type_id)->inRandomOrder()->limit($how_many_winners)->get();

        return response()->json([ $winners ]);
    }
}
