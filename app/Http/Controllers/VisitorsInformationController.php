<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller;
use App\Http\Requests\UpdateOrCreateVisitorInformationRequest;
use App\Repositories\VisitorsInformationRepository;

class VisitorsInformationController extends Controller
{
    private $visitorsInformationRepository;


    public function __construct(VisitorsInformationRepository $visitorsInformationRepository)
    {
        $this->visitorsInformationRepository = $visitorsInformationRepository;
    }

    public function updateOrCreateVisitorInformation(
        UpdateOrCreateVisitorInformationRequest
        $updateOrCreateVisitorInformationRequest
    )
    {
        //validate data
        $data = $updateOrCreateVisitorInformationRequest->validated();
        //get visitor ip
        $ip = $this->visitorsInformationRepository->getIp();
        //update query
        $visitor = $this->visitorsInformationRepository->updateVisitorData($ip, $data);

        if ($updateOrCreateVisitorInformationRequest->ajax()) {
            return ['visitor' => $visitor, 'reload' => true];
        }

        return redirect()->back();
    }
}
