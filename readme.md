##1 - API application

# Create a RESTful API that can do 2 basic operations: POST​ and GET​. (https://github.com/TanvirAlam/rest-api)

- Route:
  https://github.com/TanvirAlam/rest-api/blob/master/routes/api.php

  ```
      Route::get('offers', 'Api\OfferController@index');
      Route::get('offers/{offer}', 'Api\OfferController@show');
      Route::post('offers', 'Api\OfferController@store');
      Route::put('offers/{offer}', 'Api\OfferController@update');
      Route::delete('offers/{offer}', 'Api\OfferController@delete');
  ```

- OfferController:
  https://github.com/TanvirAlam/rest-api/blob/master/app/Http/Controllers/Api/OfferController.php

# For the POST​ endpoint, the following content must be created:

- Title, Description, Email, Image URL, Creation Date

  ```
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
  ```

##2 - Administrator Panel application (https://github.com/TanvirAlam/rest-api-admin)

## API Bonus

- HTTP methods (PUT, DELETE)
- Validatio
- Unit tests
- Documentation (Api Readme.md and phpdoc)
- Github
