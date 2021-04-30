import {useContext, useEffect} from 'react';
import Layout from "./../../Layout/Layout";
import Content from "./../../Layout/Content";
import CardComponent from "../../Components/CardComponent";
import CardTab from "../../Components/CardTab";
import InvalidFeedBack from "../../Components/InvalidFeedback";
import {AppContext} from "../../AppContext";
import { useForm } from '@inertiajs/inertia-react'
import AccordionsComponent from "../../Components/AccordionsComponent";
import OneImageUploaderComponent from "../../Components/OneImageUploaderComponent";
import LanguagesSelectComponent from "../../Components/LanguagesSelectComponent";
import PrimaryButton from "../../Components/PrimaryButton";
import Checkbox from "../../Components/Checkbox";
import Topbar from "../../Layout/Topbar";
import {assets, isTrue} from "../../helpers";
import Permissions from "../../Components/Permissions";

const tabs = [
    {id: 'general', title: translations['general']},
    {id: 'contact_us', title: translations['contact_us']},
    {id: 'dashboard', title: translations['dashboard']},
];

const generateSettingsFields = (languages, fields, translationsFields, options) => {
    let inputsFields = [];
    languages.forEach((language) => {
        fields.forEach((field) => {
            if (!translationsFields.includes(field)) {
                return inputsFields[field] = options[field];
            }
            return inputsFields[field + ':' + language.language_code] = options[field + ':' + language.language_code] || '';
        })
    });
    return inputsFields;
}

const GeneralSettingsLanguageArea = ({language, generalData, generalDataErrors, setGeneralData}) => (
    <>
        <div className="form-group">
            <label>{translations['logo']}</label>
            <div>
                <OneImageUploaderComponent defaultImage={{dataURL: assets(generalData['logo:'+language.language_code])}} onImagesChange={(image) => setGeneralData('logo:'+language.language_code, image['file'])} acceptType={['png', 'jpg', 'jpeg']}/>
                <span className="form-text text-muted">Allowed file types:  png, jpg, jpeg.</span>
                <InvalidFeedBack msg={generalDataErrors['logo:'+language.language_code]}/>
            </div>
        </div>

        <div className="form-group">
            <label>{translations['sitename']}</label>
            <input type="text" onChange={(e) => setGeneralData('site_name:'+language.language_code, e.target.value)} value={generalData['site_name:'+language.language_code]} className={'form-control'} />
            <InvalidFeedBack msg={generalDataErrors['site_name:'+language.language_code]}/>
        </div>

        <div className="form-group">
            <label>{translations['keywords']}</label>
            <input type="text" onChange={(e) => setGeneralData('keywords:'+language.language_code, e.target.value)} value={generalData['keywords:'+language.language_code]} className={'form-control'} />
            <InvalidFeedBack msg={generalDataErrors['keywords:'+language.language_code]}/>
        </div>

        <div className="form-group">
            <label>{translations['description']}</label>
            <textarea onChange={(e) => setGeneralData('description:'+language.language_code, e.target.value)} value={generalData['description:'+language.language_code]} className={'form-control'} />
            <InvalidFeedBack msg={generalDataErrors['description:'+language.language_code]}/>
        </div>
    </>
)

const DashboardSettingsLanguageArea = ({language, dashboardData, setDashboardData, dashboardDataErrors}) => (
    <>
        <div className="form-group">
            <label>{translations['dashboard_title']}</label>
            <input type="text" onChange={(e) => setDashboardData('dashboard_title:'+language.language_code, e.target.value)} value={dashboardData['dashboard_title:'+language.language_code]} className={'form-control'} />
            <InvalidFeedBack msg={dashboardDataErrors['dashboard_title:'+language.language_code]}/>
        </div>
    </>
)

const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    }
];

const Index = (props) => {
    const {data: {languages}} = useContext(AppContext);
    const {options} = props

    const generalFields = generateSettingsFields(languages, ['site_name', 'logo', 'keywords', 'description', 'default_lang'], ['site_name', 'logo', 'keywords', 'description'], options);
    const {
        data:generalData,
        setData:setGeneralData,
        post:sendGeneralData,
        processing:generalDataProcessing,
        errors:generalDataErrors,
        transform: generalDataTransform
    } = useForm({
        ...generalFields,
        _method: 'PUT'
    })
    const items = languages.map((language) => {
        return {
            title: language.language_name,
            body: <GeneralSettingsLanguageArea language={language} generalData={generalData} generalDataErrors={generalDataErrors} setGeneralData={setGeneralData}/>
        }
    });


    const {
        data:contactUsData,
        setData:setContactUsData,
        put:sendContactUsData,
        processing:contactUsDataProcessing,
        errors:contactUsDataErrors
    } = useForm({
        contact_email: options.contact_email,
        contact_phone: options.contact_phone,
        contact_address: options.contact_address
    })


    const dashboardFields = generateSettingsFields(languages, ['dashboard_title', 'default_avatar', 'users_must_verify_email', 'display_must_verify_email_msg'], ['dashboard_title'], options);
    const {
        data:dashboardData,
        setData:setDashboardData,
        post:sendDashboardData,
        processing:dashboardDataProcessing,
        errors:dashboardDataErrors,
        transform: dashboardDataTransform
    } = useForm({...dashboardFields, _method: 'PUT'})
    const dashboardItems = languages.map((language) => {
        return {
            title: language.language_name,
            body: <DashboardSettingsLanguageArea language={language} dashboardData={dashboardData} setDashboardData={setDashboardData} dashboardDataErrors={dashboardDataErrors}/>
        }
    });


    generalDataTransform((data) => {
        languages.map((language) => {
            if (!(data['logo:'+language.language_code] instanceof File)) {
                data['logo:'+language.language_code] = null;
            }
        })
        return {...data};
    })

    dashboardDataTransform((data) => {
        if (!(data['default_avatar'] instanceof File)) {
            data['default_avatar'] = null;
        }
        return {...data};
    })

    useEffect(() => {
        return () => {
            setGeneralData({});
            setContactUsData({});
            setDashboardData({});
        }
    }, [])

    return (
        <>
            <Content>
                <Topbar title={translations['settings']} breadcrumb={breadcrumb}/>
                <CardComponent title={translations['settings_description']} tabs={tabs}>

                    <CardTab id={'general'}>

                        <Permissions hasPermissions={['settings-update']}>
                            <div className="d-flex justify-content-end mb-8">
                                <PrimaryButton
                                    classes={generalDataProcessing ? 'spinner spinner-white spinner-left spinner-sm float-left' : ''}
                                    disabled={generalDataProcessing}
                                    onClick={() => sendGeneralData(route('dashboard.settings.general.data.update'))}
                                >
                                    {translations['save']}
                                </PrimaryButton>
                            </div>
                        </Permissions>

                        <div className="row">

                            <div className="col-md-7">
                                <AccordionsComponent items={items} id={'general'}/>
                            </div>

                            <div className='col-md-5'>
                                <div className='form-group'>
                                    <label>{translations['default_lang']}</label>
                                    <LanguagesSelectComponent
                                        value={languages.filter(language => language.language_code == generalData.default_lang)}
                                        options={languages}
                                        onChange={(e) => setGeneralData('default_lang', e.language_code)}
                                    />
                                    <InvalidFeedBack msg={generalDataErrors['default_lang']}/>
                                </div>
                            </div>

                        </div>

                    </CardTab>


                    <CardTab id={'contact_us'}>
                        <Permissions hasPermissions={['settings-update']}>
                            <div className="d-flex justify-content-end mb-8">
                                <PrimaryButton
                                    classes={contactUsDataProcessing ? 'spinner spinner-white spinner-left spinner-sm float-left' : ''}
                                    disabled={contactUsDataProcessing}
                                    onClick={() => sendContactUsData(route('dashboard.settings.contactus.data.update'))}
                                >
                                    {translations['save']}
                                </PrimaryButton>
                            </div>
                        </Permissions>


                        <div className="row">
                            <div className='col-md-7'>
                                <div className='form-group'>
                                    <label>{translations['email']}</label>
                                    <input type="email" onChange={(e) => setContactUsData('contact_email', e.target.value)} value={contactUsData.contact_email} className={'form-control'} />
                                    <InvalidFeedBack msg={contactUsDataErrors.contact_email}/>
                                </div>
                                <div className='form-group'>
                                    <label>{translations['phone']}</label>
                                    <input type="text" onChange={(e) => setContactUsData('contact_phone', e.target.value)} value={contactUsData.contact_phone} className={'form-control'} />
                                    <InvalidFeedBack msg={contactUsDataErrors.contact_phone}/>
                                </div>
                                <div className='form-group'>
                                    <label>{translations['address']}</label>
                                    <input type="text" onChange={(e) => setContactUsData('contact_address', e.target.value)} value={contactUsData.contact_address} className={'form-control'} />
                                    <InvalidFeedBack msg={contactUsDataErrors.contact_address}/>
                                </div>
                            </div>
                        </div>

                    </CardTab>


                    <CardTab id={'dashboard'}>
                        <Permissions hasPermissions={['settings-update']}>
                            <div className="d-flex justify-content-end  mb-8">
                                <PrimaryButton
                                    classes={dashboardDataProcessing ? 'spinner spinner-white spinner-left spinner-sm float-left' : ''}
                                    disabled={dashboardDataProcessing}
                                    onClick={() => sendDashboardData(route('dashboard.settings.dashboard.data.update'))}
                                >
                                    {translations['save']}
                                </PrimaryButton>
                            </div>
                        </Permissions>

                        <div className="row">

                            <div className="col-md-7">
                                <AccordionsComponent items={dashboardItems} id={'dashboard'}/>
                            </div>

                            <div className='col-md-5'>
                                <div className="form-group">
                                    <label>{translations['default_avatar']}</label>
                                    <div>
                                        <OneImageUploaderComponent defaultImage={{dataURL: assets(dashboardData.default_avatar)}} onImagesChange={(image) => setDashboardData('default_avatar', image['file'])} acceptType={['png', 'jpg', 'jpeg']}/>
                                        <span className="form-text text-muted">Allowed file types:  png, jpg, jpeg.</span>
                                        <InvalidFeedBack msg={dashboardDataErrors['default_avatar']}/>
                                    </div>
                                </div>
                                <div className='form-group d-flex justify-content-between'>
                                    <label>{translations['users_must_verify_email']}</label>
                                    <Checkbox checked={isTrue(dashboardData.users_must_verify_email)} onChange={(e) => setDashboardData('users_must_verify_email', e.target.checked)}/>
                                    <InvalidFeedBack msg={dashboardDataErrors['users_must_verify_email']}/>
                                </div>
                                <div className='form-group d-flex justify-content-between'>
                                    <label>{translations['display_must_verify_email_msg']}</label>
                                    <Checkbox checked={isTrue(dashboardData.display_must_verify_email_msg)} onChange={(e) => setDashboardData('display_must_verify_email_msg', e.target.checked)}/>
                                    <InvalidFeedBack msg={dashboardDataErrors['display_must_verify_email_msg']}/>
                                </div>
                            </div>

                        </div>

                    </CardTab>

                </CardComponent>
            </Content>
        </>
    );
}


Index.layout = page => <Layout children={page}/>

export default Index;
