<?php

//Visitor routes
Route::put('visitors/information', ['uses' => 'VisitorsInformationController@updateOrCreateVisitorInformation', 'as' => 'visitors.updateInformation'])->middleware(['web']);
