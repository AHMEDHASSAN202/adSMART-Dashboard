<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;


use Illuminate\Support\Facades\Cache;
use App\Repositories\OptionRepository;
use App\Models\Visitor;

class VisitorsInformationRepository
{
    private $optionRepository;


    public function __construct(OptionRepository $optionRepository)
    {
        $this->optionRepository = $optionRepository;
    }

    /**
     * Update Or Create Visitor Info
     *
     * @param $ip_address
     * @param $data
     * @return Visitor
     */
    public function updateOrCreate($ip_address, $data)
    {
        $visitor = Visitor::where('ip_address', $ip_address)->first();
        if (!$visitor) {
            $visitor = new Visitor();
            $visitor->ip_address = $ip_address;
        }
        foreach ($data as $key => $value) {
            $visitor->{$key} = $value;
        }
        $visitor->save();

        return $visitor;
    }

    /**
     * Get IP address
     *
     * @return null|string
     */
    public function getIp()
    {
        return request()->ip();
    }

    /**
     * Get Visitor Info and Cached it
     *
     * @return mixed
     */
    public function getVisitorInformation()
    {
        //check if visitor is cached
        //get visitor info from cache
        //if not cached get visitor from db and cache it
        $ip = $this->getIp();
        $cacheName = 'visitor_' . $ip;
        return Cache::rememberForever($cacheName, function () use ($ip){
            if (!Visitor::where('ip_address', $ip)->exists()) {
                //visitor is not exists in db
                $this->initialVisitor($ip);
            }

            return $this->getVisitor($ip);
        });
    }

    /**
     * Get Visitor Of Ip address
     *
     * @param $ip
     * @return mixed
     */
    public function getVisitor($ip)
    {
        $info = Visitor::select('*', 'languages.*')
                ->where('ip_address', $ip)
                ->join('languages', 'language_code', '=', 'default_lang')
                ->first();
        $info->language_image_path = _flagSvg($info->language_image);

        return $info;
    }

    /**
     * Initial Basic Visitor Info
     *
     * @param $ip
     */
    public function initialVisitor($ip)
    {
        $defaultLang = $this->optionRepository->getOption('default_lang');

        $this->updateOrCreate($ip, ['default_lang' => $defaultLang->option_value]);
    }

}
