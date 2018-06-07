<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    /**
     * Show all Offers
     *
     * @return Array
     */
    public function index()
    {
        return Offer::all();
    }

    /**
     * Show single offer
     *
     * @param int $id
     * 
     * @return array
     */
    public function show($id)
    {
        $offer = Offer::find($id);

        if (is_null($offer)) {
            return $this->sendError('Offer not found.');
        }

        return $this->sendResponse($offer->toArray(), 'Offer retrieved successfully.');
    }

    /**
     * Save offers with proper validation
     *
     * @param Request $request
     * 
     * @return void
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'email' => 'required|string|email|max:255',
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $offer = Offer::create($request->all());

        return response()->json($offer, 201);
    }

    /**
     * Update offers
     *
     * @param Request $request
     * @param Offer $offer
     * 
     * @return void
     */
    public function update(Request $request, Offer $offer)
    {
        $offer->update($request->all());

        return response()->json($offer, 200);
    }

    /**
     * Delete offers
     *
     * @param Offer $offer
     * 
     * @return void
     */
    public function delete(Offer $offer)
    {
        $offer->delete();

        return response()->json(null, 204);
    }
}
