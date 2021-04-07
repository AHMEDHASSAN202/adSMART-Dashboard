<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;


use Illuminate\Support\Facades\Cache;
use App\Repositories\OptionRepository;

class VisitorsInformationRepository
{
    private $optionRepository;
    private $localizationRepository;

    public function __construct(
        OptionRepository $optionRepository,
        LocalizationRepository $localizationRepository
    )
    {
        $this->optionRepository = $optionRepository;
        $this->localizationRepository = $localizationRepository;
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
     * Get Visitor Information From Cache
     *
     * @return mixed
     */
    public function getVisitorInformation()
    {
        $cacheName = $this->getVisitorCacheName($this->getIp());

        return Cache::rememberForever($cacheName, function () {

            return $this->initialVisitor();

        });
    }

    /**
     * Initial Basic Visitor Info
     *
     * @param array $data
     * @return array
     */
    public function initialVisitor($data=[])
    {
        $defaultData = [
            'languageCode' => isset($data['default_lang']) ? $data['default_lang'] : $this->optionRepository->getOption('default_lang')->option_value,
        ];

        return [
            'language'  => $this->localizationRepository->getLanguage($defaultData['languageCode'])
        ];
    }

    public function updateVisitorData($ip, $data)
    {
        $cacheName = $this->getVisitorCacheName($ip);

        Cache::forget($cacheName);

        return Cache::rememberForever($cacheName, function () use ($data) {

            return $this->initialVisitor($data);

        });
    }

    private function getVisitorCacheName($ip)
    {
        return 'visitor_' . $ip;
    }
}
